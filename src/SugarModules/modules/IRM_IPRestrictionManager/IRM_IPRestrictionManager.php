<?PHP

require_once('modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager_sugar.php');

use Sugarcrm\Sugarcrm\custom\Symfony\Component\HttpFoundation\IpUtils;

class IRM_IPRestrictionManager extends IRM_IPRestrictionManager_sugar
{
    public $prefix = "IRM :: ";

    /**
     * IRM_IPRestrictionManager constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Validates the ip against a range syntax.
     *
     * @param $ip
     * @param $range
     * Network ranges can be specified as:
     *   1. Specific: 1.2.3.4
     *   2. Wildcard: 1.2.3.*
     *   3. IP/Netmask: 1.2.3.4/255.255.255.0
     *   4. CIDR: 1.2.3.4/32
     *   5. Start-End: 1.2.3.4-1.2.3.5
     *
     * @return bool
     */
    public function validateRange($ip, $range)
    {
        if ($range == '*' || $range == '*.*.*.*') {
            return true;
        }

        //handle wildcard addresses
        if ($this->hasString('*', $range)) {
            $range = str_replace('*', '0', $range) . '-' . str_replace('*', '255', $range);
        }

        //handle ranges
        if ($this->hasString('-', $range)) {
            list($lower, $upper) = explode('-', $range, 2);
            $lowerConverted = (float)sprintf("%u", ip2long($lower));
            $upperConverted = (float)sprintf("%u", ip2long($upper));
            $ipConverted = (float)sprintf("%u", ip2long($ip));
            return (($ipConverted >= $lowerConverted) && ($ipConverted <= $upperConverted));
        }

        //handle ip-netmask
        if ($this->hasString('/', $range)) {
            list($range, $netmask) = explode('/', $range, 2);
            if ($this->hasString('.', $netmask)) {
                $netmaskConverted = ip2long($netmask);
                return ((ip2long($ip) & $netmaskConverted) == (ip2long($range) & $netmaskConverted));
            }
        }

        //else validate ip4/ip6/CIDR
        return IpUtils::checkIp($ip, $range);
    }

    /**
     * Fetches the current users ip address.
     *
     * @return string
     */
    /**
     * Fetches the current users ip address.
     *
     * @return string
     */
    public function getIpAddress()
    {
        $ip = '';

        $headerKeys = array(
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        );

        foreach ($headerKeys as $headerKey) {
            $replacedKey = str_replace('_', '-', ltrim($headerKey, 'HTTP_'));
            if (isset($_SERVER[$headerKey]) && !empty($_SERVER[$headerKey])) {
                $ip = $_SERVER[$headerKey];
                break;
            } elseif (isset($_SERVER[$replacedKey]) && !empty($_SERVER[$replacedKey])) {
                $ip = $_SERVER[$replacedKey];
                break;
            }
        }

        return $ip;
    }

    /**
     * Fetches the restrictions for a given user id.
     *
     * @param $userId
     * @return array
     */
    public function getUserRestrictions($userId)
    {
        $userObj = \BeanFactory::getBean('Users', $userId);
        $restrictions = array();

        $GLOBALS['log']->info($this->prefix . "Fetching restrictions for {$userObj->id}/{$userObj->user_name}");

        //Fetch related 'Enabled' restrictions
        $filter = array(
            'where' => array(
                'lhs_field' => 'status',
                'operator' => '=',
                'rhs_value' => 'Enabled',
            ),
        );

        //get restrictions specific to the user
        if ($userObj->load_relationship('irm_iprestrictionmanager_users')) {
            $userRestrictions = $userObj->irm_iprestrictionmanager_users->getBeans($filter);
            $restrictions = array_merge($restrictions, $userRestrictions);
        }

        //get restrictions specific to the users roles
        if ($userObj->load_relationship('aclroles')) {
            $roles = $userObj->aclroles->getBeans();

            foreach ($roles as $roleObj) {
                if ($roleObj->load_relationship('irm_iprestrictionmanager_aclroles')) {
                    $roleRestrictions = $roleObj->irm_iprestrictionmanager_aclroles->getBeans($filter);
                    $restrictions = array_merge($restrictions, $roleRestrictions);
                }
            }
        }

        //get restrictions specific to the users teams - we do not want reporting roll ups
        if ($userObj->load_relationship('team_link')) {
            $teams = $userObj->team_link->getBeans();

            //add private team
            $privateId = $userObj->getPrivateTeam();
            if (!empty($privateId)) {
                $teams[$privateId] = \BeanFactory::getBean("Teams", $privateId);
            }

            foreach ($teams as $teamObj) {
                if ($teamObj->load_relationship('irm_iprestrictionmanager_teams')) {
                    $teamRestrictions = $teamObj->irm_iprestrictionmanager_teams->getBeans($filter);
                    $restrictions = array_merge($restrictions, $teamRestrictions);
                }
            }
        }

        return $restrictions;
    }

    /**
     * Validates a users allowed IP range.
     *
     * @param $username
     * @param $platform
     * @param bool $allowLocal
     * @param bool $ip
     * @return bool
     * @throws SugarQueryException
     */
    public function validateUser($username, $platform, $allowLocal = true, $ip = false)
    {
        //all users are validated unless we find restrictions for them
        $isValidated = true;

        if ($ip == false) {
            $ip = $this->getIpAddress();
        }

        //always allow local server access
        if ($allowLocal && ($ip == '::1' || $ip == '127.0.0.1')) {
            $GLOBALS['log']->info($this->prefix . "Ignoring restrictions on localhost.");
            return $isValidated;
        }

        $sugarQuery = new \SugarQuery();
        $userObj = \BeanFactory::newBean('Users');

        //find user
        $sugarQuery->select(array('id'));
        $sugarQuery->from($userObj);
        $sugarQuery->where()->equals('user_name', $username);
        $sugarQuery->limit(1);

        $userId = false;
        foreach ($sugarQuery->execute() as $row) {
            $userId = $row['id'];
        }

        if ($userId !== false) {
            $restrictions = $this->getUserRestrictions($userId);

            //if we find restrictions, we need to see if any ranges are matched
            if (count($restrictions) > 0) {
                $isValidated = false;
            }

            foreach ($restrictions as $restriction) {
                //if restriction is enabled and platform is valid
                if ($this->hasString(array('^All^', '^' . $platform . '^'), $restriction->platforms)) {
                    if (!$this->validateRange($ip, $restriction->ip_range)) {
                        $GLOBALS['log']->info($this->prefix . "{$restriction->id} :: Validating ip '{$ip}' against range '{$restriction->ip_range}' failed.");
                    } else {
                        $GLOBALS['log']->info($this->prefix . "{$restriction->id} :: Validating ip '{$ip}' against range '{$restriction->ip_range}' succeeded.");
                        $isValidated = true;
                    }
                } else {
                    $GLOBALS['log']->info($this->prefix . "{$restriction->id} :: The platform '{$platform}'' did not have a match in {$restriction->platforms}");
                }
            }

        } else {
            $GLOBALS['log']->fatal($this->prefix . "{$username} is not a valid user.");
        }

        return $isValidated;
    }

    /**
     * Validates the api request
     *
     * @param $api
     * @param $username
     * @param $platform
     * @param bool $allowLocal
     * @param bool $ip
     */
    public function validateAPI($api, $username, $platform, $allowLocal = true, $ip = false)
    {
        if ($ip == false) {
            $ip = $this->getIpAddress();
        }

        //check IP range for user
        $isValidRange = $this->validateUser($username, $platform, $allowLocal, $ip);

        if (!$isValidRange) {
            //expire cookie
            if (isset($response['access_token'])) {
                parent::logout($api, array(
                    'token' => $response['access_token']
                ));
            }

            $beginning = translate("LBL_ERROR_BEGINNING", 'IRM_IPRestrictionManager');
            $join = translate("LBL_ERROR_JOIN", 'IRM_IPRestrictionManager');

            $e = new SugarApiExceptionNeedLogin("{$beginning} ({$ip}) {$join} ({$platform}).");
            $api->needLogin($e);
        }
    }

    /**
     * Find function to identify if a string contains a substring. Can handle multiple needles for a haystack search.
     *
     * @param $needles
     * @param $haystack
     * @return bool
     */
    private function hasString($needles, $haystack)
    {
        if (!is_array($needles)) {
            $needles = array($needles);
        }

        $found = false;
        foreach ($needles as $needle) {
            $position = stripos($haystack, $needle);

            if ($position !== false) {
                $found = true;
                break;
            }
        }

        return $found;
    }

}

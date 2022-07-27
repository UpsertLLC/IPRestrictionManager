<?php

/*
 * IP Restriction Manager is an open source module developed by SugarCRM, Inc
 * Copyright (C) SugarCRM, Inc.
 *
 * "Upsert® IP Restriction Manager" is an extension to "IP Restriction Manager" developed by Upsert, LLC.
 * Copyright (C) Upsert, LLC.
 *
 * Project: https://github.com/upsertllc/IPRestrictionManager
 * Support: https://github.com/UpsertLLC/IPRestrictionManager/issues
 *
 * Licensed by SugarCRM, Inc under the Apache 2.0 license.
 */

use \Sugarcrm\Sugarcrm\custom\Upsert\IPRestrictionManager\Settings;
use \Sugarcrm\Sugarcrm\custom\Upsert\IPRestrictionManager\Helpers\Str;
use \Sugarcrm\Sugarcrm\custom\Upsert\IPRestrictionManager\Helpers\IpUtils;

class upsert_IPRestrictions extends Basic
{
    public $new_schema = true;
    public $module_dir = 'upsert_IPRestrictions';
    public $object_name = 'upsert_IPRestrictions';
    public $table_name = 'upsert_iprestrictions';
    public $importable = true;
    public $tag;
    public $tag_link;
    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $activities;
    public $following;
    public $following_link;
    public $my_favorite;
    public $favorite_link;
    public $commentlog;
    public $commentlog_link;
    public $locked_fields;
    public $locked_fields_link;
    public $sync_key;
    public $disable_row_level_security = true;
    
    /**
     * @inheritDoc
     *
     * @param string $interface
     */
    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL': return true;
        }
        return false;
    }
    
    /**
     * Returns a cache key
     *
     * @param string $userId
     * @param string $platform
     *
     * @return string
     */
    public static function getCacheConfigKey(string $userId, string $platform)
    {
        return "upsert_IPRestrictionManager__{$userId}__{$platform}";
    }
    
    /**
     * Fetches the restrictions for a given user id.
     * - modified from origin modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php::getUserRestrictions
     *
     * @param string $userId
     * @param string $platform
     *
     * @return array
     */
    public static function getUserRestrictions(string $userId, string $platform)
    {
        $cacheKey = static::getCacheConfigKey($userId, $platform);

        $restrictions = null;
        $cacheRestrictions = Settings::fetchConfig('cache_restrictions');
        if ($cacheRestrictions == 'Enabled') {
            $restrictions = sugar_cache_retrieve($cacheKey);
        }

        $refetch = false;
        if (is_null($restrictions) || ! is_array($restrictions)) {
            $refetch = true;
        }

        if ($refetch) {
            $bean = \BeanFactory::newBean('upsert_IPRestrictions');

            $union = new \SugarQuery();
            $usersQuery = new \SugarQuery();
    
            $fields = ['id', 'name', 'ip_range', 'platforms'];
            $usersQuery->select($fields);
            $usersQuery->from($bean, ['team_security' => false]);
            $joinUsers = $usersQuery->join('upsert_iprestrictions_users', ['team_security' => false]);
            $usersQuery->where()
                ->equals($joinUsers->joinName() . '.id', $userId)
                ->equals('status', 'Enabled')
                ->queryOr()
                    ->contains('platforms', '^all^')
                    ->contains('platforms', "^{$platform}^");
            $union->union($usersQuery, false);
    
            $rolesQuery = new \SugarQuery();
            $rolesQuery->select($fields);
            $rolesQuery->from($bean, ['team_security' => false]);
            $joinRoles = $rolesQuery->join('upsert_iprestrictions_aclroles', ['team_security' => false]);
            $joinUsers = $rolesQuery->join('users', ['relatedJoin' => $joinRoles->joinName(), 'team_security' => false]);
            $rolesQuery->where()
                ->equals($joinUsers->joinName() . '.id', $userId)
                ->equals('status', 'Enabled')
                ->queryOr()
                    ->contains('platforms', '^all^')
                    ->contains('platforms', "^{$platform}^");
            $union->union($rolesQuery, false);
    
            $teamsQuery = new \SugarQuery();
            $teamsQuery->select($fields);
            $teamsQuery->from($bean, ['team_security' => false]);
            $joinTeams = $teamsQuery->join('upsert_iprestrictions_teams', ['team_security' => false]);
            $joinUsers = $teamsQuery->join('users', ['relatedJoin' => $joinTeams->joinName(), 'team_security' => false]);
            $teamsQuery->where()
                ->equals($joinUsers->joinName() . '.id', $userId)
                ->equals('status', 'Enabled')
                ->queryOr()
                    ->contains('platforms', '^all^')
                    ->contains('platforms', "^{$platform}^");
            $union->union($teamsQuery, false);
    
            $union->distinct(true);
    
            // \Sugarcrm\Sugarcrm\custom\Upsert\Upsertifiable\Libraries\Sugar\Classes\Helpers\Logger::log($union);
    
            $restrictions = $union->execute();

            if ($cacheRestrictions == 'Enabled') {
                sugar_cache_put($cacheKey, $restrictions, 0);
            }
        }

        return $restrictions;
    }

    /**
     * Validates a users allowed IP range.
     * - modified from origin modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php::validateUser
     *
     * @param string $userId
     * @param string $platform
     * @param Mixed  $ip       ipstring | false
     *
     * @throws SugarQueryException
     *
     * @return bool
     */
    public static function validateUser(string $userId, string $platform, string $ip)
    {
        $logMessage = '';

        //all users are validated unless we find restrictions for them
        $isValidated = true;

        $status = Settings::fetchConfig('status');
        if ($status != 'Enabled') {
            return $isValidated;
        }

        $allowLocal = true;
        $localAccess = Settings::fetchConfig('allow_local_access');
        if ($localAccess != 'Enabled') {
            $allowLocal = false;
        }

        //always allow local server access
        if ($allowLocal && ($ip == '::1' || $ip == '127.0.0.1')) {
            $log->name = isset($_REQUEST['__sugar_url']) ? $_REQUEST['__sugar_url'] : 'CLI';
            $log->status = 'Failure';
            $log->assigned_user_id = $userId;
            $log->description = 'Ignoring restrictions on localhost.';
            $log->save(false);

            return $isValidated;
        }

        $restrictions = static::getUserRestrictions($userId, $platform);

        //if we find restrictions, we need to see if any ranges are matched
        if (count($restrictions) > 0) {
            $isValidated = false;

            foreach ($restrictions as $restriction) {
                if ( ! IpUtils::validateRange($ip, $restriction['ip_range'])) {
                    $logMessage .= "- {$restriction['name']} ({$restriction['id']}) :: Validating ip '{$ip}' against range '{$restriction['ip_range']}' failed.\n";
                } else {
                    $logMessage .= "- {$restriction['name']} ({$restriction['id']}) :: Validating ip '{$ip}' against range '{$restriction['ip_range']}' succeeded.\n";
                    $isValidated = true;
                }
            }
        } else {
            $logMessage = "- User does not have any ip restrictions\n";
        }

        $isLogged = false;
        $loggerStatus = Settings::fetchConfig('log');
        if ($loggerStatus == 'All') {
            $isLogged = true;
        } elseif ($isValidated && $loggerStatus == 'Success') {
            $isLogged = true;
        } elseif ( ! $isValidated && $loggerStatus == 'Failure') {
            $isLogged = true;
        }

        if ($isLogged) {
            $log = \BeanFactory::newBean('upsert_IPRestrictionLogs');
            $log->name = isset($_REQUEST['__sugar_url']) ? $_REQUEST['__sugar_url'] : '';
            $log->status = ($isValidated) ? 'Success' : 'Failure';
            $log->assigned_user_id = $userId;
            $log->description = $logMessage;
            $log->save(false);
        }

        return $isValidated;
    }

    /**
     * logic hook for REST endpoints to verify IP.
     *
     * @param string $event
     * @param array  $args
     */
    public static function checkForIPRestriction($event, $args)
    {
        $userId = '';
        if (isset($GLOBALS['current_user']) && ! empty($GLOBALS['current_user']->id)) {
            $userId = $GLOBALS['current_user']->id;
        }

        $ip = IpUtils::getIpAddress();

        if ($event == 'before_respond') {
            $serverVars = [
                'REQUEST_URI',
                'SCRIPT_URL',
                'REDIRECT_URL',
            ];
    
            $matched = false;
            foreach ($serverVars as $serverVar) {
                if (isset($_SERVER[$serverVar]) && preg_match('/^\/rest\/v[0-9]+[^\/]+\/oauth2\/token$/', $_SERVER[$serverVar])) {
                    $matched = true;
                    break;
                }
            }
    
            if ($matched) {
                if ( ! empty($userId)) {
                    //clear users cache when authenticating
                    sugar_cache_clear(static::getCacheConfigKey($userId, $GLOBALS['service']->platform));
                    static::validateAPIResponse($args, $GLOBALS['service'], $userId, $ip, false);
                }
            }
        } elseif ($event == 'after_routing') {
            if ( ! empty($userId)) {
                static::validateAPI($args['api'], $userId, $ip, false);
            }
        }
    }

    /**
     * Validates the api request
     * - modified from origin modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php::validateAPI
     *
     * @param $api
     * @param $userId
     * @param $platform
     * @param bool $ip
     */
    public static function validateAPI(\ServiceBase $api, string $userId, string $ip)
    {
        //check IP range for user
        $isValidRange = static::validateUser($userId, $api->platform, $ip);

        if ( ! $isValidRange) {
            $e = new \SugarApiExceptionNeedLogin(static::getErrorString($ip, $api->platform));
            $api->needLogin($e);
        }
    }

    /**
     * Returns the ip restriction message
     * - modified from origin modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php::validateAPI error exception
     *
     * @param string $ip
     * @param string $platform
     *
     * @return void
     */
    public static function getErrorString(string $ip, string $platform)
    {
        $beginning = translate('LBL_ERROR_BEGINNING', 'upsert_IPRestrictions');
        $join = translate('LBL_ERROR_JOIN', 'upsert_IPRestrictions');
        return "{$beginning} ({$ip}) {$join} ({$platform}).";
    }

    /**
     * Validates an api response
     *
     * @param $api
     * @param $userId
     * @param $platform
     * @param bool $ip
     */
    public static function validateAPIResponse(\RestResponse $response, \ServiceBase $api, string $userId, string $ip)
    {
        //check IP range for user
        $isValidRange = static::validateUser($userId, $api->platform, $ip);

        if ( ! $isValidRange) {
            $data = $response->getBody();
            $response->setStatus(401);
            $response->setContent([
                'error' => 'need_login',
                'error_message' => static::getErrorString($ip, $api->platform),
            ]);
        }
    }
}

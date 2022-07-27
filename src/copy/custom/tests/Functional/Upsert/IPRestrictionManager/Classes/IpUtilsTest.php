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

namespace Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Classes;

use PHPUnit\Framework\TestCase;
use Sugarcrm\Sugarcrm\custom\Upsert\IPRestrictionManager\Helpers\IpUtils;
use Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities\SugarTestSupportUserUtilities;
use Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities\SugarTestSupportTeamsUtilities;
use Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities\SugarTestSupportACLRolesUtilities;
use Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities\SugarTestSupportUpsertIPRestrictionsUtilities;

/**
 * @group iputils
 * @group iprestrictionmanager
 * @group upsert
 * @coversNothing
 */
class IpUtilsTest extends TestCase
{
    private $ipRestrictionManagerUtils = null;
    private $userUtils = null;
    private $roleUtils = null;
    private $teamUtils = null;

    public function setUp() : void
    {
        parent::setUp();

        \SugarTestHelper::setUp('beanList');
        \SugarTestHelper::setUp('beanFiles');
        \SugarTestHelper::setUp('current_user');

        $GLOBALS['current_user']->is_admin = 1;
        $GLOBALS['app_list_strings'] = return_app_list_strings_language('en_us');

        $this->ipRestrictionManagerUtils = new SugarTestSupportUpsertIPRestrictionsUtilities();
        $this->userUtils = new SugarTestSupportUserUtilities();
        $this->roleUtils = new SugarTestSupportACLRolesUtilities();
        $this->teamUtils = new SugarTestSupportTeamsUtilities();
    }

    public function tearDown() : void
    {
        $this->ipRestrictionManagerUtils->deleteAll();
        $this->userUtils->deleteAll();
        $this->roleUtils->deleteAll();
        $this->teamUtils->deleteAll();
        parent::tearDown();
    }

    public function testValidateRange()
    {
        $bean = \BeanFactory::newBean('upsert_IPRestrictions');

        //Any
        $this->assertTrue(IpUtils::validateRange('1.2.3.4', '*'));
        $this->assertTrue(IpUtils::validateRange('1.2.3.4', '*.*.*.*'));

        //Specific
        $this->assertTrue(IpUtils::validateRange('1.2.3.4', '1.2.3.4'));
        $this->assertFalse(IpUtils::validateRange('1.2.3.4', '1.2.3.5'));

        //Wildcard
        $this->assertTrue(IpUtils::validateRange('1.2.3.4', '1.2.3.1-1.2.3.5'));
        $this->assertFalse(IpUtils::validateRange('1.2.3.4', '1.2.3.1-1.2.3.3'));

        //IP/Netmask
        $this->assertTrue(IpUtils::validateRange('1.2.3.4', '1.2.3.4/255.255.255.0'));
        $this->assertFalse(IpUtils::validateRange('1.2.3.4', '1.3.3.4/255.255.255.0'));

        //CIDR
        $this->assertTrue(IpUtils::validateRange('1.2.3.4', '1.2.3.4/32'));
        $this->assertFalse(IpUtils::validateRange('1.2.3.4', '1.3.3.4/32'));

        //Range
        $this->assertTrue(IpUtils::validateRange('1.2.3.4', '1.2.3.*'));
        $this->assertFalse(IpUtils::validateRange('1.2.3.4', '1.2.2.*'));

        //Range mid wildcard
        $this->assertTrue(IpUtils::validateRange('1.2.3.4', '1.2.*.*'));
        $this->assertFalse(IpUtils::validateRange('1.*.3.4', '1.2.*.*'));
    }
}

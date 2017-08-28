<?php
// Copyright 2017 SugarCRM Inc.  Licensed by SugarCRM under the Apache 2.0 license.

/**
 * @group support
 * @group ip
 */
class IPTest extends Sugar_PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();
        SugarTestHelper::setUp("current_user");
        $GLOBALS['current_user']->is_admin = 1;
        $GLOBALS['app_list_strings'] = return_app_list_strings_language('en_us');
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();
    }

    public function testValidate()
    {
        $bean = \BeanFactory::newBean("IRM_IPRestrictionManager");

        //Any
        $this->assertTrue($bean->validateRange('1.2.3.4', '*'));
        $this->assertTrue($bean->validateRange('1.2.3.4', '*.*.*.*'));

        //Specific
        $this->assertTrue($bean->validateRange('1.2.3.4', '1.2.3.4'));
        $this->assertFalse($bean->validateRange('1.2.3.4', '1.2.3.5'));

        //Wildcard
        $this->assertTrue($bean->validateRange('1.2.3.4', '1.2.3.1-1.2.3.5'));
        $this->assertFalse($bean->validateRange('1.2.3.4', '1.2.3.1-1.2.3.3'));

        //IP/Netmask
        $this->assertTrue($bean->validateRange('1.2.3.4', '1.2.3.4/255.255.255.0'));
        $this->assertFalse($bean->validateRange('1.2.3.4', '1.3.3.4/255.255.255.0'));

        //CIDR
        $this->assertTrue($bean->validateRange('1.2.3.4', '1.2.3.4/32'));
        $this->assertFalse($bean->validateRange('1.2.3.4', '1.3.3.4/32'));

        //Range
        $this->assertTrue($bean->validateRange('1.2.3.4', '1.2.3.*'));
        $this->assertFalse($bean->validateRange('1.2.3.4', '1.2.2.*'));
    }
}

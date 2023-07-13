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

namespace Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Modules\upsert_IPRestrictions;

use PHPUnit\Framework\TestCase;
use Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities\SugarTestSupportUserUtilities;
use Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities\SugarTestSupportTeamsUtilities;
use Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities\SugarTestSupportACLRolesUtilities;
use Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities\SugarTestSupportUpsertIPRestrictionsUtilities;

/**
 * @group support
 * @group iprestrictionmanager
 * @group upsert
 * @coversNothing
 */
class upsert_IPRestrictionsTest extends TestCase
{
    private $ipRestrictionManagerUtils = null;
    private $userUtils = null;
    private $roleUtils = null;
    private $teamUtils = null;

    public function setUp() : void
    {
        parent::setUp();

        \SugarTestHelper::init();
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

        \SugarTestUserUtilities::removeAllCreatedAnonymousUsers();
        \SugarTestHelper::tearDown();

        parent::tearDown();
    }

    public function testGetUserRestrictions()
    {
        $ipRestriction1 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP1',
                'ip_range' => '1.2.3.1-1.2.3.5',
            ]
        );

        $ipRestriction2 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP2',
                'ip_range' => '1.2.4.1-1.2.4.5',
                'platforms' => '^mobile^',
            ]
        );

        $ipRestriction3 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP3',
                'ip_range' => '1.2.5.1-1.2.5.5',
                'platforms' => '^mobile^',
            ]
        );

        $ipRestriction4 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP4',
                'ip_range' => '1.2.6.1-1.2.6.5',
                'platforms' => '^mobile^',
            ]
        );

        $ipRestriction5 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP5',
                'ip_range' => '1.2.7.1-1.2.7.5',
                'platforms' => '^mobile^',
            ]
        );

        $ipRestriction6 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP6',
                'ip_range' => '1.2.8.1-1.2.8.5',
                'platforms' => '^mobile^',
            ]
        );

        $user = $this->userUtils->create();

        if ($user->load_relationship('upsert_iprestrictions_users')) {
            //add directly to users
            $user->upsert_iprestrictions_users->add([
                $ipRestriction1,
                $ipRestriction2,
            ]);
        }

        $role = $this->roleUtils->create();

        //add restrictions to role
        if ($role->load_relationship('upsert_iprestrictions_aclroles')) {
            $role->upsert_iprestrictions_aclroles->add(
                [
                    $ipRestriction3,
                    $ipRestriction4,
                ]
            );
        }

        //add role to user
        if ($user->load_relationship('aclroles')) {
            $user->aclroles->add([
                $role,
            ]);
        }

        $team = $this->teamUtils->create();

        if ($ipRestriction5->load_relationship('upsert_iprestrictions_teams')) {
            $ipRestriction5->upsert_iprestrictions_teams->add(
                [
                    $team,
                ]
            );
        }

        if ($ipRestriction6->load_relationship('upsert_iprestrictions_teams')) {
            $ipRestriction6->upsert_iprestrictions_teams->add(
                [
                    $team,
                ]
            );
        }
        
        if ($user->load_relationship('teams')) {
            $team->add_user_to_team($user->id);
        }

        $restrictions = \upsert_IPRestrictions::getUserRestrictions($user->id, 'mobile');

        $this->assertEquals(6, count($restrictions));
    }

    public function testValidateSupportUser()
    {
        $ipRestriction1 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP1',
                'ip_range' => '1.2.3.1-1.2.3.5',
            ]
        );

        $ipRestriction2 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP2',
                'ip_range' => '1.2.4.1-1.2.4.5',
                'platforms' => '^mobile^',
            ]
        );

        //create support user
        $user = $this->userUtils->create([
            'user_name' => \User::SUPPORT_USER_NAME,
        ]);

        $user->load_relationship('upsert_iprestrictions_users');

        $user->upsert_iprestrictions_users->add([
            $ipRestriction1,
            $ipRestriction2,
        ]);

        $user->save(false);

        //verify all tests pass
        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'mobile', '1.2.4.1'));
        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'mobile', '1.2.4.0'));

        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'mobile', '1.2.3.1'));
        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'mobile', '1.2.3.0'));

        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'base', '1.2.3.1'));
        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'base', '1.2.3.0'));
    }


    public function testValidateUser()
    {
        $ipRestriction1 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP1',
                'ip_range' => '1.2.3.1-1.2.3.5',
            ]
        );

        $ipRestriction2 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP2',
                'ip_range' => '1.2.4.1-1.2.4.5',
                'platforms' => '^mobile^',
            ]
        );

        $user = $this->userUtils->create();
        $user->load_relationship('upsert_iprestrictions_users');

        $user->upsert_iprestrictions_users->add([
            $ipRestriction1,
            $ipRestriction2,
        ]);

        $user->save(false);

        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'mobile', '1.2.4.1'));
        $this->assertFalse(\upsert_IPRestrictions::validateUser($user->id, 'mobile', '1.2.4.0'));

        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'mobile', '1.2.3.1'));
        $this->assertFalse(\upsert_IPRestrictions::validateUser($user->id, 'mobile', '1.2.3.0'));

        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'base', '1.2.3.1'));
        $this->assertFalse(\upsert_IPRestrictions::validateUser($user->id, 'base', '1.2.3.0'));

        //validate global sugar ips
        $this->assertTrue(\upsert_IPRestrictions::validateUser($user->id, 'base', '54.153.90.191'));
        $this->assertFalse(\upsert_IPRestrictions::validateUser($user->id, 'base', '54.153.90.190'));
    }

    public function testValidateAPI()
    {
        $ipRestriction1 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP1',
                'ip_range' => '1.2.3.1-1.2.3.5',
            ]
        );

        $ipRestriction2 = $this->ipRestrictionManagerUtils->create(
            [
                'name' => 'IP2',
                'ip_range' => '1.2.4.1-1.2.4.5',
                'platforms' => '^mobile^',
            ]
        );

        $user = $this->userUtils->create();
        $user->load_relationship('upsert_iprestrictions_users');

        $user->upsert_iprestrictions_users->add([
            $ipRestriction1,
            $ipRestriction2,
        ]);

        $user->save();

        $bean = \BeanFactory::newBean('upsert_IPRestrictions');

        $api = new \RestService();
        $api->user = $GLOBALS['current_user'];
        $api->platform = 'mobile';

        $message =  false;
        try {
            $bean->validateAPI($api, $user->id, '1.2.4.1');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertFalse($message);

        $message =  false;
        try {
            $bean->validateAPI($api, $user->id, '1.2.4.0');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertEquals('You are attempting to authenticate from an invalid IP (1.2.4.0) or platform (mobile).', $message);

        $message =  false;
        try {
            $bean->validateAPI($api, $user->id, '1.2.3.1');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertFalse($message);

        $message =  false;
        try {
            $bean->validateAPI($api, $user->id, '1.2.3.0');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertEquals('You are attempting to authenticate from an invalid IP (1.2.3.0) or platform (mobile).', $message);

        $message =  false;
        try {
            $bean->validateAPI($api, $user->id, '1.2.3.1');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertFalse($message);

        $api->platform = 'base';
        $message =  false;
        try {
            $bean->validateAPI($api, $user->id, '1.2.3.0');
        } catch (\Exception $e) {
            $message = $e->getMessage();
        }

        $this->assertEquals('You are attempting to authenticate from an invalid IP (1.2.3.0) or platform (base).', $message);
    }
}

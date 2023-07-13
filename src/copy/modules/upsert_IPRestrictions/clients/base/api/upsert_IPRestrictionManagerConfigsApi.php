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

if ( ! defined('sugarEntry') || ! sugarEntry) {
    die('Not A Valid Entry Point');
}

use \Sugarcrm\Sugarcrm\custom\Upsert\IPRestrictionManager\Settings;
use \Sugarcrm\Sugarcrm\custom\Upsert\IPRestrictionManager\Helpers\Str;

class upsert_IPRestrictionManagerConfigsApi extends SugarApi
{
    public function registerApiRest()
    {
        return [
            'upsert_IPRestrictionManagerSettingsPOST' => [
                'reqType' => 'POST',
                'path' => ['upsert_IPRestrictionManager', 'settings'],
                'pathVars' => ['', ''],
                'method' => 'saveConfigs',
                'shortHelp' => 'Updates configuration settings',
                'longHelp' => 'custom/src/Upsert/upsert_IPRestrictions/Help/API/POST_upsert_iprestrictionmanager_configs_settings.html',
                'ignoreMetaHash' => true,
            ],
            'upsert_IPRestrictionManagerSettingsGET' => [
                'reqType' => 'GET',
                'path' => ['upsert_IPRestrictionManager', 'settings'],
                'pathVars' => ['', ''],
                'method' => 'fetchConfigs',
                'shortHelp' => 'Fetches the configuration settings',
                'longHelp' => 'custom/src/Upsert/upsert_IPRestrictions/Help/API/GET_upsert_iprestrictionmanager_configs_settings.html',
                'ignoreMetaHash' => true,
            ],
        ];
    }

    /**
     * Saves config settings.
     *
     * @param ServiceBase $api
     * @param array       $args
     */
    public function saveConfigs(ServiceBase $api, array $args)
    {
        if ( ! $api->user->isAdmin()) {
            throw new \SugarApiExceptionNotAuthorized();
        }

        $administration = new \Administration();
        foreach ($args as $field => $value) {
            if (Str::startsWith($field, 'upsert_IPRestrictionManager')) {
                $administration->saveSetting('upsert_IPRestrictionManager', str_replace('upsert_IPRestrictionManager_', '', $field), $value, 'base');
            }
        }

        sugar_cache_clear(Settings::getCacheKey());

        return true;
    }

    /**
     * Fetches config settings.
     *
     * @param ServiceBase $api
     * @param array       $args
     */
    public function fetchConfigs(ServiceBase $api, array $args)
    {
        if ( ! $api->user->isAdmin()) {
            throw new \SugarApiExceptionNotAuthorized();
        }

        return Settings::fetchConfigs();
    }
}

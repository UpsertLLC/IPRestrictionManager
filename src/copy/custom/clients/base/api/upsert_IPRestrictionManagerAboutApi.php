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

class upsert_IPRestrictionManagerAboutApi extends SugarApi
{
    public function registerApiRest()
    {
        return [
            'UpsertIPRestrictionManagerAbout' => [
                'reqType' => 'GET',
                'noLoginRequired' => false,
                'path' => ['upsert_IPRestrictionManager', 'about'],
                'pathVars' => ['', ''],
                'method' => 'about',
                'shortHelp' => 'Returns plugin information',
                'longHelp' => 'custom/src/Upsert/IPRestrictionManager/Help/API/GET_upsert_iprestrictionmanager_about.html',
            ],
        ];
    }

    /**
     * Returns plugin information
     *
     * @param ServiceBase $api
     * @param array       $args
     */
    public function about(ServiceBase $api, array $args)
    {
        $upsertPluginVersions = [];
        require 'custom/Extension/application/Ext/UpsertPluginVersions/UpsertIPRestrictionManagerLicensingServer.php';

        if (isset($upsertPluginVersions['eula'])) {
            unset($upsertPluginVersions['eula']);
        }

        if (isset($upsertPluginVersions['license_version'])) {
            unset($upsertPluginVersions['license_version']);
        }
        
        return $upsertPluginVersions['UpsertIPRestrictionManager'];
    }
}

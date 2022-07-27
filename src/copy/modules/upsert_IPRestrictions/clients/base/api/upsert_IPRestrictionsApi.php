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

class upsert_IPRestrictionsApi extends SugarApi
{
    /**
     * @inheritDoc
     *
     * @return array
     */
    public function registerApiRest()
    {
        return [
            'getPlatformsList' => [
                'reqType' => 'GET',
                'path' => ['upsert_IPRestrictions', 'enum', 'platforms'],
                'pathVars' => ['module', 'enum', 'field'],
                'method' => 'getPlatforms',
                'ignoreMetaHash' => true,
                'shortHelp' => 'Return list of platforms',
                'longHelp' => 'custom/src/Upsert/IPRestrictionManager/Help/API/GET_upsert_iprestrictions_platforms_list.html',
            ],
        ];
    }

    /**
     * Returns a list of platforms
     *
     * @param \ServiceBase $api  the REST API object
     * @param array        $args REST API arguments
     *
     * @return array of of name => name
     */
    public function getPlatforms(\ServiceBase $api, array $args)
    {
        $list = [
            'all' => translate('LBL_UPSERT_IPRESTRICTIONMAMANGER_ALL_PLATFORMS'),
        ];

        $platforms = \MetaDataManager::getPlatformList();
        foreach ($platforms as $platform) {
            if (strlen($platform) == 3) {
                $list[$platform] = strtoupper($platform);
            } else {
                $list[$platform] = ucwords($platform);
            }
        }

        return $list;
    }
}

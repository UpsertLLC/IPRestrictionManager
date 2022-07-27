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

$module_name = 'upsert_IPRestrictions';
$viewdefs[$module_name]['base']['filter']['default'] = [
    'default_filter' => 'all_records',
    'fields' => [
        'name' => [],
        'tag' => [],
        '$favorite' => [
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ],
    ],
];

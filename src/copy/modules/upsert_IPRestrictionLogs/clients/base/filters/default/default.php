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

$viewdefs['upsert_IPRestrictionLogs']['base']['filter']['default'] = [
    'default_filter' => 'all_records',
    'fields' => [
        'name' => [
        ],
        'modified_by_name' => [
        ],
        'description' => [
        ],
        'created_by_name' => [
        ],
        'date_modified' => [
        ],
        'assigned_user_name' => [
        ],
        'date_entered' => [
        ],
        '$owner' => [
            'predefined_filter' => true,
            'vname' => 'LBL_CURRENT_USER_FILTER',
        ],
        '$favorite' => [
            'predefined_filter' => true,
            'vname' => 'LBL_FAVORITES_FILTER',
        ],
    ],
];

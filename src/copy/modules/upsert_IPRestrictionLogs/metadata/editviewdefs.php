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

$module_name = 'upsert_IPRestrictionLogs';
$viewdefs[$module_name] = [
    'EditView' => [
        'templateMeta' => [
            'maxColumns' => '2',
            'widths' => [
                0 => [
                    'label' => '10',
                    'field' => '30',
                ],
                1 => [
                    'label' => '10',
                    'field' => '30',
                ],
            ],
        ],
        'panels' => [
            'default' => [
                0 => [
                    0 => 'name',
                    1 => 'assigned_user_name',
                ],
                1 => [
                ],
                2 => [
                    0 => 'description',
                ],
            ],
        ],
    ],
];

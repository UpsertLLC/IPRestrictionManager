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
    'mobile' => [
        'view' => [
            'edit' => [
                'templateMeta' => [
                    'maxColumns' => '1',
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
                    0 => [
                        'label' => 'LBL_PANEL_DEFAULT',
                        'name' => 'LBL_PANEL_DEFAULT',
                        'columns' => '1',
                        'placeholders' => 1,
                        'fields' => [
                            0 => 'name',
                            1 => 'assigned_user_name',
                        ],
                    ],
                ],
            ],
        ],
    ],
];

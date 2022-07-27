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
$viewdefs[$module_name] = [
    'base' => [
        'view' => [
            'list' => [
                'panels' => [
                    0 => [
                        'label' => 'LBL_PANEL_1',
                        'fields' => [
                            0 => [
                                'name' => 'name',
                                'label' => 'LBL_NAME',
                                'default' => true,
                                'enabled' => true,
                                'link' => true,
                            ],
                            1 => [
                                'name' => 'status',
                                'label' => 'LBL_STATUS',
                                'enabled' => true,
                                'default' => true,
                            ],
                            2 => [
                                'name' => 'ip_range',
                                'label' => 'LBL_IP_RANGE',
                                'enabled' => true,
                                'default' => true,
                            ],
                            3 => [
                                'name' => 'platforms',
                                'label' => 'LBL_PLATFORMS',
                                'enabled' => true,
                                'default' => true,
                            ],
                            4 => [
                                'name' => 'date_modified',
                                'enabled' => true,
                                'default' => true,
                            ],
                            5 => [
                                'name' => 'date_entered',
                                'enabled' => true,
                                'default' => true,
                            ],
                            6 => [
                                'name' => 'description',
                                'label' => 'LBL_DESCRIPTION',
                                'enabled' => true,
                                'sortable' => false,
                                'default' => true,
                            ],
                            7 => [
                                'name' => 'tag',
                                'label' => 'LBL_TAGS',
                                'enabled' => true,
                                'default' => false,
                            ],
                            8 => [
                                'name' => 'created_by_name',
                                'label' => 'LBL_CREATED',
                                'enabled' => true,
                                'readonly' => true,
                                'id' => 'CREATED_BY',
                                'link' => true,
                                'default' => false,
                            ],
                            9 => [
                                'name' => 'modified_by_name',
                                'label' => 'LBL_MODIFIED',
                                'enabled' => true,
                                'readonly' => true,
                                'id' => 'MODIFIED_USER_ID',
                                'link' => true,
                                'default' => false,
                            ],
                        ],
                    ],
                ],
                'orderBy' => [
                    'field' => 'date_modified',
                    'direction' => 'desc',
                ],
            ],
        ],
    ],
];

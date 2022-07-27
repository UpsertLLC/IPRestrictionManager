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
    'base' => [
        'view' => [
            'selection-list' => [
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
                                'name' => 'assigned_user_name',
                                'label' => 'LBL_ASSIGNED_TO_NAME',
                                'default' => true,
                                'enabled' => true,
                                'link' => true,
                            ],
                            2 => [
                                'name' => 'description',
                                'label' => 'LBL_DESCRIPTION',
                                'enabled' => true,
                                'sortable' => false,
                                'default' => true,
                            ],
                            3 => [
                                'label' => 'LBL_DATE_MODIFIED',
                                'enabled' => true,
                                'default' => true,
                                'name' => 'date_modified',
                                'readonly' => true,
                            ],
                            4 => [
                                'name' => 'modified_by_name',
                                'label' => 'LBL_MODIFIED',
                                'enabled' => true,
                                'readonly' => true,
                                'id' => 'MODIFIED_USER_ID',
                                'link' => true,
                                'default' => false,
                            ],
                            5 => [
                                'name' => 'my_favorite',
                                'label' => 'LBL_FAVORITE',
                                'enabled' => true,
                                'default' => false,
                            ],
                            6 => [
                                'name' => 'created_by_name',
                                'label' => 'LBL_CREATED',
                                'enabled' => true,
                                'readonly' => true,
                                'id' => 'CREATED_BY',
                                'link' => true,
                                'default' => false,
                            ],
                            7 => [
                                'name' => 'date_entered',
                                'label' => 'LBL_DATE_ENTERED',
                                'enabled' => true,
                                'readonly' => true,
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

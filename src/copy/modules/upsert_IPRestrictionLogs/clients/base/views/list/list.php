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
            'list' => [
                'panels' => [
                    0 => [
                        'label' => 'LBL_PANEL_1',
                        'fields' => [
                            [
                                'name' => 'name',
                                'label' => 'LBL_NAME',
                                'default' => true,
                                'enabled' => true,
                                'link' => true,
                            ],
                            [
                                'name' => 'assigned_user_name',
                                'label' => 'LBL_ASSIGNED_TO_NAME',
                                'default' => true,
                                'enabled' => true,
                                'link' => true,
                            ],
                            [
                                'name' => 'status',
                            ],
                            [
                                'name' => 'description',
                                'label' => 'LBL_DESCRIPTION',
                                'enabled' => true,
                                'sortable' => false,
                                'default' => false,
                            ],
                            [
                                'name' => 'created_by_name',
                                'label' => 'LBL_CREATED',
                                'enabled' => true,
                                'readonly' => true,
                                'id' => 'CREATED_BY',
                                'link' => true,
                                'default' => false,
                            ],
                            [
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

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

$viewdefs['upsert_IPRestrictions'] = [
    'base' => [
        'view' => [
            'upsert-config' => [
                'buttons' => [
                    0 => [
                        'type' => 'button',
                        'name' => 'cancel_setting_button',
                        'label' => 'LBL_CANCEL_BUTTON_LABEL',
                        'css_class' => 'btn-invisible btn-link',
                        'showOn' => 'edit',
                        'events' => [
                            'click' => 'button:cancel_setting_button:click',
                        ],
                    ],
                    1 => [
                        'type' => 'rowaction',
                        'event' => 'button:save_setting_button:click',
                        'name' => 'save_setting_button',
                        'label' => 'LBL_SAVE_BUTTON_LABEL',
                        'css_class' => 'btn btn-primary',
                        'showOn' => 'edit',
                        'acl_action' => 'edit',
                    ],
                    2 => [
                        'name' => 'sidebar_toggle',
                        'type' => 'sidebartoggle',
                    ],
                ],
                'panels' => [
                    0 => [
                        'name' => 'panel_header',
                        'label' => 'LBL_RECORD_HEADER',
                        'header' => true,
                        'fields' => [
                            [
                                'name' => 'header',
                                'type' => 'varchar',
                                'default' => 'Settings',
                                'dismiss_label' => true,
                                'readonly' => true,
                            ],
                        ],
                    ],
                    1 => [
                        'name' => 'panel_body',
                        'label' => 'LBL_RECORD_BODY',
                        'columns' => 2,
                        'labelsOnTop' => true,
                        'placeholders' => true,
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                        'fields' => [
                            [
                                'name' => 'upsert_IPRestrictionManager_status',
                                'label' => 'LBL_UPSERT_IPRESTRICTIONMANAGER_STATUS',
                                'enabled' => true,
                                'view' => 'edit',
                                'type' => 'enum',
                                'default' => 'Disabled',
                                'required' => false,
                                'options' => 'upsert_iprestrictionmanager_status_list',
                                'source' => 'non-db',
                                'help' => 'LBL_UPSERT_IPRESTRICTIONMANAGER_STATUS_HELP',
                                'span' => 8,
                            ],
                            [
                                'name' => 'upsert_IPRestrictionManager_cache_restrictions',
                                'label' => 'LBL_UPSERT_IPRESTRICTIONMANAGER_CACHE_RESTRICTIONS',
                                'enabled' => true,
                                'view' => 'edit',
                                'type' => 'enum',
                                'default' => 'Enabled',
                                'required' => false,
                                'options' => 'upsert_iprestrictionmanager_cache_status_list',
                                'source' => 'non-db',
                                'help' => 'LBL_UPSERT_IPRESTRICTIONMANAGER_CACHE_RESTRICTIONS_HELP',
                                'span' => 8,
                            ],
                            [
                                'name' => 'upsert_IPRestrictionManager_allow_local_access',
                                'label' => 'LBL_UPSERT_IPRESTRICTIONMANAGER_ALLOW_LOCAL_ACCESS',
                                'enabled' => true,
                                'view' => 'edit',
                                'type' => 'enum',
                                'default' => 'Enabled',
                                'required' => false,
                                'options' => 'upsert_iprestrictionmanager_allow_local_access_status_list',
                                'source' => 'non-db',
                                'help' => 'LBL_UPSERT_IPRESTRICTIONMANAGER_ALLOW_LOCAL_ACCESS_HELP',
                                'span' => 8,
                            ],
                            [
                                'name' => 'upsert_IPRestrictionManager_log',
                                'label' => 'LBL_UPSERT_IPRESTRICTIONMANAGER_LOG',
                                'enabled' => true,
                                'view' => 'edit',
                                'type' => 'enum',
                                'default' => 'Failure',
                                'required' => false,
                                'options' => 'upsert_iprestrictionmanager_log_status_list',
                                'source' => 'non-db',
                                'help' => 'LBL_UPSERT_IPRESTRICTIONMANAGER_LOG_HELP',
                                'span' => 8,
                            ],
                        ],
                    ],
                ],
                'templateMeta' => [
                    'useTabs' => false,
                ],
            ],
        ],
    ],
];

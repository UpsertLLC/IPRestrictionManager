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
            'record' => [
                'buttons' => [
                    0 => [
                        'type' => 'button',
                        'name' => 'cancel_button',
                        'label' => 'LBL_CANCEL_BUTTON_LABEL',
                        'css_class' => 'btn-invisible btn-link',
                        'showOn' => 'edit',
                        'events' => [
                            'click' => 'button:cancel_button:click',
                        ],
                    ],
                    1 => [
                        'type' => 'rowaction',
                        'event' => 'button:save_button:click',
                        'name' => 'save_button',
                        'label' => 'LBL_SAVE_BUTTON_LABEL',
                        'css_class' => 'btn btn-primary',
                        'showOn' => 'edit',
                        'acl_action' => 'edit',
                    ],
                    2 => [
                        'type' => 'actiondropdown',
                        'name' => 'main_dropdown',
                        'primary' => true,
                        'showOn' => 'view',
                        'buttons' => [
                            0 => [
                                'type' => 'rowaction',
                                'event' => 'button:edit_button:click',
                                'name' => 'edit_button',
                                'label' => 'LBL_EDIT_BUTTON_LABEL',
                                'acl_action' => 'edit',
                            ],
                            1 => [
                                'type' => 'shareaction',
                                'name' => 'share',
                                'label' => 'LBL_RECORD_SHARE_BUTTON',
                                'acl_action' => 'view',
                            ],
                            2 => [
                                'type' => 'pdfaction',
                                'name' => 'download-pdf',
                                'label' => 'LBL_PDF_VIEW',
                                'action' => 'download',
                                'acl_action' => 'view',
                            ],
                            3 => [
                                'type' => 'pdfaction',
                                'name' => 'email-pdf',
                                'label' => 'LBL_PDF_EMAIL',
                                'action' => 'email',
                                'acl_action' => 'view',
                            ],
                            4 => [
                                'type' => 'divider',
                            ],
                            5 => [
                                'type' => 'rowaction',
                                'event' => 'button:find_duplicates_button:click',
                                'name' => 'find_duplicates_button',
                                'label' => 'LBL_DUP_MERGE',
                                'acl_action' => 'edit',
                            ],
                            6 => [
                                'type' => 'rowaction',
                                'event' => 'button:duplicate_button:click',
                                'name' => 'duplicate_button',
                                'label' => 'LBL_DUPLICATE_BUTTON_LABEL',
                                'acl_module' => 'upsert_IPRestrictions',
                                'acl_action' => 'create',
                            ],
                            7 => [
                                'type' => 'rowaction',
                                'event' => 'button:audit_button:click',
                                'name' => 'audit_button',
                                'label' => 'LNK_VIEW_CHANGE_LOG',
                                'acl_action' => 'view',
                            ],
                            8 => [
                                'type' => 'divider',
                            ],
                            9 => [
                                'type' => 'rowaction',
                                'event' => 'button:delete_button:click',
                                'name' => 'delete_button',
                                'label' => 'LBL_DELETE_BUTTON_LABEL',
                                'acl_action' => 'delete',
                            ],
                        ],
                    ],
                    3 => [
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
                            0 => [
                                'name' => 'picture',
                                'type' => 'avatar',
                                'width' => 42,
                                'height' => 42,
                                'dismiss_label' => true,
                                'readonly' => true,
                                'size' => 'large',
                            ],
                            1 => 'name',
                            2 => [
                                'name' => 'favorite',
                                'label' => 'LBL_FAVORITE',
                                'type' => 'favorite',
                                'readonly' => true,
                                'dismiss_label' => true,
                            ],
                            3 => [
                                'name' => 'follow',
                                'label' => 'LBL_FOLLOW',
                                'type' => 'follow',
                                'readonly' => true,
                                'dismiss_label' => true,
                            ],
                        ],
                    ],
                    1 => [
                        'name' => 'panel_body',
                        'label' => 'LBL_RECORD_BODY',
                        'columns' => 2,
                        'placeholders' => true,
                        'newTab' => false,
                        'panelDefault' => 'expanded',
                        'fields' => [
                            0 => [
                                'name' => 'ip_range',
                                'label' => 'LBL_IP_RANGE',
                            ],
                            1 => [
                                'name' => 'status',
                                'studio' => 'visible',
                                'label' => 'LBL_STATUS',
                            ],
                            2 => [
                                'name' => 'platforms',
                                'studio' => 'visible',
                                'label' => 'LBL_PLATFORMS',
                                'span' => 12,
                            ],
                            3 => [
                                'name' => 'description',
                                'span' => 12,
                            ],
                            4 => [
                                'name' => 'commentlog',
                                'displayParams' => [
                                    'type' => 'commentlog',
                                    'fields' => [
                                        0 => 'entry',
                                        1 => 'date_entered',
                                        2 => 'created_by_name',
                                    ],
                                    'max_num' => 100,
                                ],
                                'studio' => [
                                    'listview' => false,
                                    'recordview' => true,
                                    'wirelesseditview' => false,
                                    'wirelessdetailview' => true,
                                    'wirelesslistview' => false,
                                    'wireless_basic_search' => false,
                                    'wireless_advanced_search' => false,
                                ],
                                'label' => 'LBL_COMMENTLOG',
                            ],
                            5 => [
                                'name' => 'tag',
                            ],
                            6 => [
                                'name' => 'date_entered_by',
                                'readonly' => true,
                                'inline' => true,
                                'type' => 'fieldset',
                                'label' => 'LBL_DATE_ENTERED',
                                'fields' => [
                                    0 => [
                                        'name' => 'date_entered',
                                    ],
                                    1 => [
                                        'type' => 'label',
                                        'default_value' => 'LBL_BY',
                                    ],
                                    2 => [
                                        'name' => 'created_by_name',
                                    ],
                                ],
                            ],
                            7 => [
                                'name' => 'date_modified_by',
                                'readonly' => true,
                                'inline' => true,
                                'type' => 'fieldset',
                                'label' => 'LBL_DATE_MODIFIED',
                                'fields' => [
                                    0 => [
                                        'name' => 'date_modified',
                                    ],
                                    1 => [
                                        'type' => 'label',
                                        'default_value' => 'LBL_BY',
                                    ],
                                    2 => [
                                        'name' => 'modified_by_name',
                                    ],
                                ],
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

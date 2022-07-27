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

$viewdefs['base'] = [
    'view' => [
        'upsert-ip-restriction-manager-about' => [
            'buttons' => [
                0 => [
                    'type' => 'button',
                    'name' => 'close_info_button',
                    'label' => 'LBL_CLOSE_BUTTON_LABEL',
                    'css_class' => 'btn-invisible btn-link',
                    'showOn' => 'view',
                    'events' => [
                        'click' => 'button:close_info_button:click',
                    ],
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
                            'default' => 'About',
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
                            'name' => 'name',
                            'type' => 'varchar',
                            'label' => 'LBL_UPSERT_IPRESTRICTIONMAMANGER_ABOUT_PLUGIN_NAME',
                            'default' => '',
                            'view' => 'detail',
                            'span' => 12,
                        ],
                        [
                            'name' => 'version',
                            'type' => 'varchar',
                            'label' => 'LBL_UPSERT_IPRESTRICTIONMAMANGER_ABOUT_PLUGIN_VERSION',
                            'default' => '',
                            'view' => 'detail',
                            'span' => 12,
                        ],
                        [
                            'name' => 'project_url',
                            'type' => 'url',
                            'link_target' => '_blank',
                            'label' => 'LBL_UPSERT_IPRESTRICTIONMAMANGER_ABOUT_PROJECT_LINK',
                            'default' => '',
                            'view' => 'detail',
                            'span' => 12,
                        ],
                        [
                            'name' => 'support_url',
                            'type' => 'url',
                            'link_target' => '_blank',
                            'label' => 'LBL_UPSERT_IPRESTRICTIONMAMANGER_SUPPORT_LINK',
                            'default' => '',
                            'view' => 'detail',
                            'span' => 12,
                        ],
                        [
                            'name' => 'third_party_software',
                            'type' => 'upsert-ip-restriction-manager-third-party-software',
                            'label' => 'LBL_UPSERT_IPRESTRICTIONMAMANGER_ABOUT_THIRD_PARTY_SOFTWARE',
                            'default' => '',
                            'view' => 'detail',
                            'span' => 12,
                        ],
                    ],
                ],
            ],
            'templateMeta' => [
                'useTabs' => false,
            ],
        ],
    ],

];

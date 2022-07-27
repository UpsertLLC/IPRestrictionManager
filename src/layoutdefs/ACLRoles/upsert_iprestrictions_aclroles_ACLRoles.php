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

$layout_defs['ACLRoles']['subpanel_setup']['upsert_iprestrictions_aclroles'] = [
    'order' => 100,
    'module' => 'upsert_IPRestrictions',
    'subpanel_name' => 'default',
    'sort_order' => 'asc',
    'sort_by' => 'id',
    'title_key' => 'LBL_UPSERT_IPRESTRICTIONS_ACLROLES_FROM_UPSERT_IPRESTRICTIONS_TITLE',
    'get_subpanel_data' => 'upsert_iprestrictions_aclroles',
    'top_buttons' => [
        0 => [
            'widget_class' => 'SubPanelTopButtonQuickCreate',
        ],
        1 => [
            'widget_class' => 'SubPanelTopSelectButton',
            'mode' => 'MultiSelect',
        ],
    ],
];

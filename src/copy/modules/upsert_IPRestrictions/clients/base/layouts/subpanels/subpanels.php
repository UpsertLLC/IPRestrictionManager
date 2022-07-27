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

$viewdefs['upsert_IPRestrictions']['base']['layout']['subpanels']['components'] = [
    [
        'layout' => 'subpanel',
        'label' => 'LBL_UPSERT_IPRESTRICTIONS_USERS_FROM_USERS_TITLE',
        'context' => [
            'link' => 'upsert_iprestrictions_users',
        ],
    ],
    [
        'layout' => 'subpanel',
        'label' => 'LBL_UPSERT_IPRESTRICTIONS_TEAMS_FROM_TEAMS_TITLE',
        'context' => [
            'link' => 'upsert_iprestrictions_teams',
        ],
    ],
    [
        'layout' => 'subpanel',
        'label' => 'LBL_UPSERT_IPRESTRICTIONS_ACLROLES_FROM_ACLROLES_TITLE',
        'context' => [
            'link' => 'upsert_iprestrictions_aclroles',
        ],
    ],
];

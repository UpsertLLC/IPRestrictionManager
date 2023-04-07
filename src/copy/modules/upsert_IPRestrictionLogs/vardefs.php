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

$dictionary['upsert_IPRestrictionLogs'] = [
    'table' => 'upsert_iprestrictionlogs',
    'audited' => true,
    'activity_enabled' => false,
    'acls' => [
        'SugarACLAdminOnly' => true,
        'SugarACLStatic' => false,
    ],
    'duplicate_merge' => false,
    'duplicate_check' => [
        'enabled' => false,
    ],
    'fields' => [
        'status' => [
            'required' => false,
            'name' => 'status',
            'vname' => 'LBL_STATUS',
            'type' => 'enum',
            'massupdate' => true,
            'default' => 'Enabled',
            'no_default' => false,
            'comments' => '',
            'help' => '',
            'importable' => 'true',
            'duplicate_merge' => 'disabled',
            'duplicate_merge_dom_value' => '0',
            'audited' => false,
            'reportable' => false,
            'unified_search' => false,
            'merge_filter' => 'disabled',
            'calculated' => false,
            'len' => 100,
            'size' => '20',
            'options' => 'upsert_iprestrictionmanager_log_status_list',
            'studio' => 'visible',
            'dependency' => false,
            'readonly' => true,
        ],
    ],
    'relationships' => [],
    'optimistic_locking' => false,
    'unified_search' => false,
    'full_text_search' => false,
];

VardefManager::createVardef('upsert_IPRestrictionLogs', 'upsert_IPRestrictionLogs', ['basic', 'assignable']);

$dictionary['upsert_IPRestrictionLogs']['fields']['name']['readonly'] = true;
$dictionary['upsert_IPRestrictionLogs']['fields']['description']['readonly'] = true;
$dictionary['upsert_IPRestrictionLogs']['fields']['description']['pii'] = true;
$dictionary['upsert_IPRestrictionLogs']['fields']['assigned_user_id']['readonly'] = true;
$dictionary['upsert_IPRestrictionLogs']['fields']['assigned_user_name']['readonly'] = true;

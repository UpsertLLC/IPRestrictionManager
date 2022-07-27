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

$dictionary['upsert_iprestrictions_users'] = [
    'true_relationship_type' => 'many-to-many',
    'relationships' => [
        'upsert_iprestrictions_users' => [
            'lhs_module' => 'upsert_IPRestrictions',
            'lhs_table' => 'upsert_iprestrictions',
            'lhs_key' => 'id',
            'rhs_module' => 'Users',
            'rhs_table' => 'users',
            'rhs_key' => 'id',
            'relationship_type' => 'many-to-many',
            'join_table' => 'upsert_iprestrictions_users_c',
            'join_key_lhs' => 'upsert_iprestrictions_usersupsert_iprestrictions_ida',
            'join_key_rhs' => 'upsert_iprestrictions_usersusers_idb',
        ],
    ],
    'table' => 'upsert_iprestrictions_users_c',
    'fields' => [
        'id' => [
            'name' => 'id',
            'type' => 'id',
        ],
        'date_modified' => [
            'name' => 'date_modified',
            'type' => 'datetime',
        ],
        'deleted' => [
            'name' => 'deleted',
            'type' => 'bool',
            'default' => 0,
        ],
        'upsert_iprestrictions_usersupsert_iprestrictions_ida' => [
            'name' => 'upsert_iprestrictions_usersupsert_iprestrictions_ida',
            'type' => 'id',
        ],
        'upsert_iprestrictions_usersusers_idb' => [
            'name' => 'upsert_iprestrictions_usersusers_idb',
            'type' => 'id',
        ],
    ],
    'indices' => [
        0 => [
            'name' => 'idx_upsert_iprestrictions_users_pk',
            'type' => 'primary',
            'fields' => [
                0 => 'id',
            ],
        ],
        1 => [
            'name' => 'idx_upsert_iprestrictions_users_ida1_deleted',
            'type' => 'index',
            'fields' => [
                0 => 'upsert_iprestrictions_usersupsert_iprestrictions_ida',
                1 => 'deleted',
            ],
        ],
        2 => [
            'name' => 'idx_upsert_iprestrictions_users_idb2_deleted',
            'type' => 'index',
            'fields' => [
                0 => 'upsert_iprestrictions_usersusers_idb',
                1 => 'deleted',
            ],
        ],
        3 => [
            'name' => 'upsert_iprestrictions_users_alt',
            'type' => 'alternate_key',
            'fields' => [
                0 => 'upsert_iprestrictions_usersupsert_iprestrictions_ida',
                1 => 'upsert_iprestrictions_usersusers_idb',
            ],
        ],
    ],
];

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

$viewdefs['upsert_IPRestrictions']['base']['filter']['basic'] = [
    'create'               => true,
    'quicksearch_field'    => ['name'],
    'quicksearch_priority' => 1,
    'quicksearch_split_terms' => false,
    'filters'              => [
        [
            'id'                => 'all_records',
            'name'              => 'LBL_LISTVIEW_FILTER_ALL',
            'filter_definition' => [],
            'editable'          => false,
        ],
        [
            'id'                => 'favorites',
            'name'              => 'LBL_FAVORITES',
            'filter_definition' => [
                '$favorite' => '',
            ],
            'app' => 'base',
            'editable'          => false,
        ],
        [
            'id'                => 'recently_viewed',
            'name'              => 'LBL_RECENTLY_VIEWED',
            'filter_definition' => [
                '$tracker' => '-7 DAY',
            ],
            'app' => 'base',
            'editable'          => false,
        ],
        [
            'id'                => 'recently_created',
            'name'              => 'LBL_NEW_RECORDS',
            'filter_definition' => [
                'date_entered' => [
                    '$dateRange' => 'last_7_days',
                ],
            ],
            'editable'          => false,
        ],
    ],
];

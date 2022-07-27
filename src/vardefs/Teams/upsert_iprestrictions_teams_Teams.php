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

// created: 2022-07-11 16:00:15
$dictionary['Team']['fields']['upsert_iprestrictions_teams'] = [
    'name' => 'upsert_iprestrictions_teams',
    'type' => 'link',
    'relationship' => 'upsert_iprestrictions_teams',
    'source' => 'non-db',
    'module' => 'upsert_IPRestrictions',
    'bean_name' => false,
    'vname' => 'LBL_UPSERT_IPRESTRICTIONS_TEAMS_FROM_TEAMS_TITLE',
    'id_name' => 'upsert_iprestrictions_teamsteams_ida',
    'link-type' => 'many',
    'side' => 'left',
];

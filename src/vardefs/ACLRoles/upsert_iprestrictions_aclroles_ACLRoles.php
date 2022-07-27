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

$dictionary['ACLRole']['fields']['upsert_iprestrictions_aclroles'] = [
    'name' => 'upsert_iprestrictions_aclroles',
    'type' => 'link',
    'relationship' => 'upsert_iprestrictions_aclroles',
    'source' => 'non-db',
    'module' => 'upsert_IPRestrictions',
    'bean_name' => false,
    'vname' => 'LBL_UPSERT_IPRESTRICTIONS_ACLROLES_FROM_UPSERT_IPRESTRICTIONS_TITLE',
    'id_name' => 'upsert_iprestrictions_aclrolesupsert_iprestrictions_ida',
];

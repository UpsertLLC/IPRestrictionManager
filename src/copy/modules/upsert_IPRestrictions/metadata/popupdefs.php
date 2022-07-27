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
$object_name = 'upsert_IPRestrictions';
$_module_name = 'upsert_iprestrictions';
$popupMeta = ['moduleMain' => $module_name,
    'varName' => $object_name,
    'orderBy' => $_module_name.'.name',
    'whereClauses' => ['name' => $_module_name . '.name',
    ],
    'searchInputs'=> [$_module_name. '_number', 'name', 'priority','status'],

];

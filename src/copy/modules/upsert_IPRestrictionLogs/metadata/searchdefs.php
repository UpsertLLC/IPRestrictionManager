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

$module_name = 'upsert_IPRestrictionLogs';
  $searchdefs[$module_name] = [
      'templateMeta' => [
          'maxColumns' => '3',
          'maxColumnsBasic' => '4',
          'widths' => ['label' => '10', 'field' => '30'],
      ],
      'layout' => [
          'basic_search' => [
              'name',
              ['name'=>'current_user_only', 'label'=>'LBL_CURRENT_USER_FILTER', 'type'=>'bool'],
              ['name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool'],
          ],
          'advanced_search' => [
              'name',
              ['name' => 'assigned_user_id', 'label' => 'LBL_ASSIGNED_TO', 'type' => 'enum', 'function' => ['name' => 'get_user_array', 'params' => [false]]],
              ['name' => 'favorites_only','label' => 'LBL_FAVORITES_FILTER','type' => 'bool'],
          ],
      ],
  ];

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
 $metafiles[$module_name] = [
     'detailviewdefs'  => 	'modules/' . $module_name . '/metadata/detailviewdefs.php',
     'editviewdefs'    => 	'modules/' . $module_name . '/metadata/editviewdefs.php',
     'listviewdefs'    => 	'modules/' . $module_name . '/metadata/listviewdefs.php',
     'searchdefs'      =>    'modules/' . $module_name . '/metadata/searchdefs.php',
     'popupdefs'	      =>    'modules/' . $module_name . '/metadata/popupdefs.php',
     'searchfields'	  =>    'modules/' . $module_name . '/metadata/SearchFields.php',
 ];

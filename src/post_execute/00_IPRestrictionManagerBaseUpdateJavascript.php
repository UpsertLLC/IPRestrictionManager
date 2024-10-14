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

if ( ! defined('sugarEntry') || ! sugarEntry) {
    die('Not A Valid Entry Point');
}

$GLOBALS['log']->info('Upsert® IP Restriction Manager :: Updating Javascipt Version');

$config = \SugarConfig::getInstance();
$configurator = new \Configurator();

$key = 'js_custom_version';
$version = (int) $config->get($key, 1);
$version++;
$configurator->config[$key] = $version;
$configurator->handleOverride();
$config->clearCache($key);

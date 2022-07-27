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

if (class_exists('\\upsert_IPRestrictions') && \BeanFactory::newBean('upsert_IPRestrictions') != null) {
    $hook_array['after_routing'][] = [
        1,
        'Check For IP Restrictions',
        '',
        '\\upsert_IPRestrictions',
        'checkForIPRestriction',
    ];

    $hook_array['before_respond'][] = [
        1,
        'Check For IP Restrictions',
        '',
        '\\upsert_IPRestrictions',
        'checkForIPRestriction',
    ];
}

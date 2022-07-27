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

    $admin_option_defs = [];

    $admin_option_defs['Administration']['UpsertIPRestrictionManagerRestrictions'] = [
        'Search',
        'icon' => 'sicon-ban',
        'LBL_UPSERT_IPRESTRICTIONMANAGER_RESTRICTIONS_LINK',
        'LBL_UPSERT_IPRESTRICTIONMANAGER_RESTRICTIONS_LINK_DESCRIPTION',
        '#upsert_IPRestrictions',
    ];

    $admin_option_defs['Administration']['UpsertIPRestrictionManagerRestrictionLogs'] = [
        'Search',
        'icon' => 'sicon-list-view',
        'LBL_UPSERT_IPRESTRICTIONMANAGER_RESTRICTION_LOGS_LINK',
        'LBL_UPSERT_IPRESTRICTIONMANAGER_RESTRICTION_LOGS_LINK_DESCRIPTION',
        '#upsert_IPRestrictionLogs',
    ];

    $admin_option_defs['Administration']['UpsertIPRestrictionManagerRestrictionConfigs'] = [
        'Administration',
        'LBL_UPSERT_IPRESTRICTIONMANAGER_CONFIGURATION_LINK',
        'LBL_UPSERT_IPRESTRICTIONMANAGER_CONFIGURATION_LINK_DESCRIPTION',
        '#upsert_IPRestrictions/layout/upsert-config',
    ];

    $admin_option_defs['Administration']['UpsertIPRestrictionManagerInformation'] = [
        'info_inline',
        'icon' => 'sicon-info-lg',
        'LBL_UPSERT_IPRESTRICTIONMANAGER_INFORMATION_LINK',
        'LBL_UPSERT_IPRESTRICTIONMANAGER_INFORMATION_LINK_DESCRIPTION',
        'javascript:void(parent.SUGAR.App.router.navigate("Home/layout/upsert-ip-restriction-manager-about", {trigger: true}));',
    ];

    $admin_group_header[] = [
        'LBL_UPSERT_IPRESTRICTIONMANAGER_SECTION_HEADER',
        '',
        false,
        $admin_option_defs,
        'LBL_UPSERT_IPRESTRICTIONMANAGER_SECTION_DESCRIPTION',
    ];

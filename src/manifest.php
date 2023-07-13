<?php

$manifest = [
    'acceptable_sugar_flavors' => [
        'PRO',
        'ENT',
        'ULT',
        'SERVE',
        'SELL',
    ],
    'acceptable_sugar_versions' => [
        'regex_matches' => [
            '12\\.*\\.*.*',
            '13\\.*\\.*.*',
        ],
    ],
    'author' => 'Upsert, LLC',
    'description' => '',
    'is_uninstallable' => true,
    'key' => 'UpsertIPRestrictionManager',
    'name' => 'Upsert® IP Restriction Manager For SugarCRM',
    'published_date' => '2023-07-13',
    'remove_tables' => 'prompt',
    'type' => 'module',
    'uninstall_before_upgrade' => false,
    'version' => '3.1.0',
];

$installdefs = [
    'administration' => [
        [
            'from' => '<basepath>/administration/UpsertIPRestrictionManager.php',
        ],
    ],
    'beans' => [
        [
            'module' => 'upsert_IPRestrictionLogs',
            'class' => 'upsert_IPRestrictionLogs',
            'path' => 'modules/upsert_IPRestrictionLogs/upsert_IPRestrictionLogs.php',
            'tab' => false,
        ],
        [
            'module' => 'upsert_IPRestrictions',
            'class' => 'upsert_IPRestrictions',
            'path' => 'modules/upsert_IPRestrictions/upsert_IPRestrictions.php',
            'tab' => false,
        ],
    ],
    'copy' => [
        [
            'from' => '<basepath>/copy/custom/Extension/application/Ext/UpsertPluginVersions/UpsertIPRestrictionManagerLicensingServer.php',
            'to' => 'custom/Extension/application/Ext/UpsertPluginVersions/UpsertIPRestrictionManagerLicensingServer.php',
        ],
        [
            'from' => '<basepath>/copy/custom/clients/base/api/upsert_IPRestrictionManagerAboutApi.php',
            'to' => 'custom/clients/base/api/upsert_IPRestrictionManagerAboutApi.php',
        ],
        [
            'from' => '<basepath>/copy/custom/clients/base/fields/upsert-ip-restriction-manager-third-party-software/detail.hbs',
            'to' => 'custom/clients/base/fields/upsert-ip-restriction-manager-third-party-software/detail.hbs',
        ],
        [
            'from' => '<basepath>/copy/custom/clients/base/fields/upsert-ip-restriction-manager-third-party-software/upsert-ip-restriction-manager-third-party-software.js',
            'to' => 'custom/clients/base/fields/upsert-ip-restriction-manager-third-party-software/upsert-ip-restriction-manager-third-party-software.js',
        ],
        [
            'from' => '<basepath>/copy/custom/clients/base/layouts/upsert-ip-restriction-manager-about/upsert-ip-restriction-manager-about.php',
            'to' => 'custom/clients/base/layouts/upsert-ip-restriction-manager-about/upsert-ip-restriction-manager-about.php',
        ],
        [
            'from' => '<basepath>/copy/custom/clients/base/views/upsert-ip-restriction-manager-about/upsert-ip-restriction-manager-about.js',
            'to' => 'custom/clients/base/views/upsert-ip-restriction-manager-about/upsert-ip-restriction-manager-about.js',
        ],
        [
            'from' => '<basepath>/copy/custom/clients/base/views/upsert-ip-restriction-manager-about/upsert-ip-restriction-manager-about.php',
            'to' => 'custom/clients/base/views/upsert-ip-restriction-manager-about/upsert-ip-restriction-manager-about.php',
        ],
        [
            'from' => '<basepath>/copy/custom/src/Upsert/IPRestrictionManager/Help/API/GET_upsert_iprestrictionmanager_about.html',
            'to' => 'custom/src/Upsert/IPRestrictionManager/Help/API/GET_upsert_iprestrictionmanager_about.html',
        ],
        [
            'from' => '<basepath>/copy/custom/src/Upsert/IPRestrictionManager/Help/API/GET_upsert_iprestrictionmanager_configs_settings.html',
            'to' => 'custom/src/Upsert/IPRestrictionManager/Help/API/GET_upsert_iprestrictionmanager_configs_settings.html',
        ],
        [
            'from' => '<basepath>/copy/custom/src/Upsert/IPRestrictionManager/Help/API/GET_upsert_iprestrictions_platforms_list.html',
            'to' => 'custom/src/Upsert/IPRestrictionManager/Help/API/GET_upsert_iprestrictions_platforms_list.html',
        ],
        [
            'from' => '<basepath>/copy/custom/src/Upsert/IPRestrictionManager/Help/API/POST_upsert_iprestrictionmanager_configs_settings.html',
            'to' => 'custom/src/Upsert/IPRestrictionManager/Help/API/POST_upsert_iprestrictionmanager_configs_settings.html',
        ],
        [
            'from' => '<basepath>/copy/custom/src/Upsert/IPRestrictionManager/Helpers/IpUtils.php',
            'to' => 'custom/src/Upsert/IPRestrictionManager/Helpers/IpUtils.php',
        ],
        [
            'from' => '<basepath>/copy/custom/src/Upsert/IPRestrictionManager/Helpers/Str.php',
            'to' => 'custom/src/Upsert/IPRestrictionManager/Helpers/Str.php',
        ],
        [
            'from' => '<basepath>/copy/custom/src/Upsert/IPRestrictionManager/Settings.php',
            'to' => 'custom/src/Upsert/IPRestrictionManager/Settings.php',
        ],
        [
            'from' => '<basepath>/copy/custom/tests/Functional/Upsert/IPRestrictionManager/Classes/IpUtilsTest.php',
            'to' => 'custom/tests/Functional/Upsert/IPRestrictionManager/Classes/IpUtilsTest.php',
        ],
        [
            'from' => '<basepath>/copy/custom/tests/Functional/Upsert/IPRestrictionManager/Modules/upsert_IPRestrictions/upsert_IPRestrictionsTest.php',
            'to' => 'custom/tests/Functional/Upsert/IPRestrictionManager/Modules/upsert_IPRestrictions/upsert_IPRestrictionsTest.php',
        ],
        [
            'from' => '<basepath>/copy/custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportACLRolesUtilities.php',
            'to' => 'custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportACLRolesUtilities.php',
        ],
        [
            'from' => '<basepath>/copy/custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportTeamsUtilities.php',
            'to' => 'custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportTeamsUtilities.php',
        ],
        [
            'from' => '<basepath>/copy/custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportUpsertIPRestrictionsUtilities.php',
            'to' => 'custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportUpsertIPRestrictionsUtilities.php',
        ],
        [
            'from' => '<basepath>/copy/custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportUserUtilities.php',
            'to' => 'custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportUserUtilities.php',
        ],
        [
            'from' => '<basepath>/copy/custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportUtilities.php',
            'to' => 'custom/tests/Functional/Upsert/IPRestrictionManager/Utilities/SugarTestSupportUtilities.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/filters/basic/basic.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/filters/basic/basic.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/filters/default/default.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/filters/default/default.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/menus/header/header.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/menus/header/header.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/menus/quickcreate/quickcreate.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/menus/quickcreate/quickcreate.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/views/dupecheck-list/dupecheck-list.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/views/dupecheck-list/dupecheck-list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/views/list/list.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/views/list/list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/views/massupdate/massupdate.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/views/massupdate/massupdate.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/views/record/record.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/views/record/record.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/views/search-list/search-list.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/views/search-list/search-list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/views/selection-list/selection-list.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/views/selection-list/selection-list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/base/views/subpanel-list/subpanel-list.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/base/views/subpanel-list/subpanel-list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/mobile/layouts/detail/detail.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/mobile/layouts/detail/detail.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/mobile/layouts/edit/edit.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/mobile/layouts/edit/edit.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/mobile/layouts/list/list.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/mobile/layouts/list/list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/mobile/views/detail/detail.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/mobile/views/detail/detail.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/mobile/views/edit/edit.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/mobile/views/edit/edit.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/clients/mobile/views/list/list.php',
            'to' => 'modules/upsert_IPRestrictionLogs/clients/mobile/views/list/list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/dashboards/focus/focus-dashboard.php',
            'to' => 'modules/upsert_IPRestrictionLogs/dashboards/focus/focus-dashboard.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/dashboards/record/record-dashboard.php',
            'to' => 'modules/upsert_IPRestrictionLogs/dashboards/record/record-dashboard.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/ar_SA.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/ar_SA.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/bg_BG.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/bg_BG.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/ca_ES.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/ca_ES.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/cs_CZ.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/cs_CZ.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/da_DK.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/da_DK.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/de_DE.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/de_DE.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/el_EL.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/el_EL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/en_UK.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/en_UK.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/en_us.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/en_us.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/es_ES.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/es_ES.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/es_LA.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/es_LA.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/et_EE.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/et_EE.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/fi_FI.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/fi_FI.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/fr_FR.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/fr_FR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/he_IL.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/he_IL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/hr_HR.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/hr_HR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/hu_HU.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/hu_HU.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/it_it.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/it_it.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/ja_JP.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/ja_JP.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/ko_KR.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/ko_KR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/lt_LT.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/lt_LT.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/lv_LV.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/lv_LV.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/nb_NO.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/nb_NO.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/nl_NL.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/nl_NL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/pl_PL.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/pl_PL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/pt_BR.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/pt_BR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/pt_PT.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/pt_PT.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/ro_RO.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/ro_RO.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/ru_RU.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/ru_RU.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/sk_SK.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/sk_SK.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/sq_AL.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/sq_AL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/sr_RS.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/sr_RS.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/sv_SE.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/sv_SE.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/th_TH.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/th_TH.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/tr_TR.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/tr_TR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/uk_UA.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/uk_UA.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/zh_CN.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/zh_CN.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/language/zh_TW.lang.php',
            'to' => 'modules/upsert_IPRestrictionLogs/language/zh_TW.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/SearchFields.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/SearchFields.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/detailviewdefs.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/detailviewdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/editviewdefs.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/editviewdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/listviewdefs.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/listviewdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/metafiles.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/metafiles.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/popupdefs.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/popupdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/quickcreatedefs.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/quickcreatedefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/searchdefs.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/searchdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/studio.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/studio.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/metadata/subpanels/default.php',
            'to' => 'modules/upsert_IPRestrictionLogs/metadata/subpanels/default.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/upsert_IPRestrictionLogs.php',
            'to' => 'modules/upsert_IPRestrictionLogs/upsert_IPRestrictionLogs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictionLogs/vardefs.php',
            'to' => 'modules/upsert_IPRestrictionLogs/vardefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/api/upsert_IPRestrictionManagerConfigsApi.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/api/upsert_IPRestrictionManagerConfigsApi.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/api/upsert_IPRestrictionsApi.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/api/upsert_IPRestrictionsApi.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/fields/upsert-list-collection/detail.hbs',
            'to' => 'modules/upsert_IPRestrictions/clients/base/fields/upsert-list-collection/detail.hbs',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/fields/upsert-list-collection/edit.hbs',
            'to' => 'modules/upsert_IPRestrictions/clients/base/fields/upsert-list-collection/edit.hbs',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/fields/upsert-list-collection/upsert-list-collection.js',
            'to' => 'modules/upsert_IPRestrictions/clients/base/fields/upsert-list-collection/upsert-list-collection.js',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/filters/basic/basic.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/filters/basic/basic.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/filters/default/default.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/filters/default/default.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/layouts/subpanels/subpanels.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/layouts/subpanels/subpanels.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/layouts/upsert-config/upsert-config.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/layouts/upsert-config/upsert-config.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/menus/header/header.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/menus/header/header.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/menus/quickcreate/quickcreate.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/menus/quickcreate/quickcreate.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/dupecheck-list/dupecheck-list.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/dupecheck-list/dupecheck-list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/list/list.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/list/list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/massupdate/massupdate.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/massupdate/massupdate.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/record/record.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/record/record.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/search-list/search-list.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/search-list/search-list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/selection-list/selection-list.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/selection-list/selection-list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/subpanel-list/subpanel-list.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/subpanel-list/subpanel-list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/upsert-config/upsert-config.js',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/upsert-config/upsert-config.js',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/base/views/upsert-config/upsert-config.php',
            'to' => 'modules/upsert_IPRestrictions/clients/base/views/upsert-config/upsert-config.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/mobile/layouts/detail/detail.php',
            'to' => 'modules/upsert_IPRestrictions/clients/mobile/layouts/detail/detail.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/mobile/layouts/edit/edit.php',
            'to' => 'modules/upsert_IPRestrictions/clients/mobile/layouts/edit/edit.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/mobile/layouts/list/list.php',
            'to' => 'modules/upsert_IPRestrictions/clients/mobile/layouts/list/list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/mobile/views/detail/detail.php',
            'to' => 'modules/upsert_IPRestrictions/clients/mobile/views/detail/detail.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/mobile/views/edit/edit.php',
            'to' => 'modules/upsert_IPRestrictions/clients/mobile/views/edit/edit.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/clients/mobile/views/list/list.php',
            'to' => 'modules/upsert_IPRestrictions/clients/mobile/views/list/list.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/dashboards/focus/focus-dashboard.php',
            'to' => 'modules/upsert_IPRestrictions/dashboards/focus/focus-dashboard.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/dashboards/record/record-dashboard.php',
            'to' => 'modules/upsert_IPRestrictions/dashboards/record/record-dashboard.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/ar_SA.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/ar_SA.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/bg_BG.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/bg_BG.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/ca_ES.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/ca_ES.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/cs_CZ.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/cs_CZ.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/da_DK.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/da_DK.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/de_DE.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/de_DE.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/el_EL.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/el_EL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/en_UK.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/en_UK.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/en_us.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/en_us.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/es_ES.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/es_ES.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/es_LA.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/es_LA.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/et_EE.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/et_EE.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/fi_FI.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/fi_FI.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/fr_FR.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/fr_FR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/he_IL.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/he_IL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/hr_HR.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/hr_HR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/hu_HU.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/hu_HU.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/it_it.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/it_it.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/ja_JP.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/ja_JP.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/ko_KR.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/ko_KR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/lt_LT.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/lt_LT.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/lv_LV.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/lv_LV.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/nb_NO.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/nb_NO.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/nl_NL.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/nl_NL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/pl_PL.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/pl_PL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/pt_BR.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/pt_BR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/pt_PT.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/pt_PT.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/ro_RO.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/ro_RO.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/ru_RU.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/ru_RU.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/sk_SK.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/sk_SK.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/sq_AL.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/sq_AL.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/sr_RS.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/sr_RS.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/sv_SE.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/sv_SE.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/th_TH.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/th_TH.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/tr_TR.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/tr_TR.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/uk_UA.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/uk_UA.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/zh_CN.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/zh_CN.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/language/zh_TW.lang.php',
            'to' => 'modules/upsert_IPRestrictions/language/zh_TW.lang.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/SearchFields.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/SearchFields.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/detailviewdefs.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/detailviewdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/editviewdefs.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/editviewdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/listviewdefs.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/listviewdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/metafiles.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/metafiles.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/popupdefs.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/popupdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/quickcreatedefs.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/quickcreatedefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/searchdefs.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/searchdefs.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/studio.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/studio.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/metadata/subpanels/default.php',
            'to' => 'modules/upsert_IPRestrictions/metadata/subpanels/default.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/upsert_IPRestrictions.php',
            'to' => 'modules/upsert_IPRestrictions/upsert_IPRestrictions.php',
        ],
        [
            'from' => '<basepath>/copy/modules/upsert_IPRestrictions/vardefs.php',
            'to' => 'modules/upsert_IPRestrictions/vardefs.php',
        ],
    ],
    'extensions' => [
        [
            'from' => '<basepath>/extensions/UpsertIPRestrictionManagerBase.php',
        ],
    ],
    'hookdefs' => [
        [
            'from' => '<basepath>/hookdefs/application/UpsertIPRestrictionManager.php',
            'to_module' => 'application',
        ],
    ],
    'id' => 'UpsertIPRestrictionManager',
    'language' => [
        [
            'from' => '<basepath>/language/Administration/en_us.UpsertIPRestrictionManager.php',
            'to_module' => 'Administration',
            'language' => 'en_us',
        ],
        [
            'from' => '<basepath>/language/application/en_us.UpsertIPRestrictionManager.php',
            'to_module' => 'application',
            'language' => 'en_us',
        ],
    ],
    'layoutdefs' => [
        [
            'from' => '<basepath>/layoutdefs/ACLRoles/upsert_iprestrictions_aclroles_ACLRoles.php',
            'to_module' => 'ACLRoles',
        ],
        [
            'from' => '<basepath>/layoutdefs/Teams/upsert_iprestrictions_teams_Teams.php',
            'to_module' => 'Teams',
        ],
        [
            'from' => '<basepath>/layoutdefs/Users/upsert_iprestrictions_users_Users.php',
            'to_module' => 'Users',
        ],
    ],
    'post_execute' => [
        '<basepath>/post_execute/00_QRAR.php',
    ],
    'pre_execute' => [
        '<basepath>/pre_execute/00_CHECK.php',
        '<basepath>/pre_execute/00_FlagIinstall.php',
    ],
    'pre_uninstall' => [
        '<basepath>/pre_uninstall/00_FlagUninstall.php',
    ],
    'relationships' => [
        [
            'meta_data' => '<basepath>/relationships/upsert_iprestrictions_aclrolesMetaData.php',
        ],
        [
            'meta_data' => '<basepath>/relationships/upsert_iprestrictions_teamsMetaData.php',
        ],
        [
            'meta_data' => '<basepath>/relationships/upsert_iprestrictions_usersMetaData.php',
        ],
    ],
    'vardefs' => [
        [
            'from' => '<basepath>/vardefs/ACLRoles/upsert_iprestrictions_aclroles_ACLRoles.php',
            'to_module' => 'ACLRoles',
        ],
        [
            'from' => '<basepath>/vardefs/Teams/upsert_iprestrictions_teams_Teams.php',
            'to_module' => 'Teams',
        ],
        [
            'from' => '<basepath>/vardefs/Users/upsert_iprestrictions_users_Users.php',
            'to_module' => 'Users',
        ],
    ],
];

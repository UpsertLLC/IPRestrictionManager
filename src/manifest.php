<?php

$manifest = array(
    'acceptable_sugar_versions' => array(
        'regex_matches' => array(
            '^7.9\\..+',
            '^7.11\\..+',
            '^8.0\\..+',
            '^9.0\\..+',
            '^9.1\\..+',
            '^9.2\\..+',
        )
    ),
    'acceptable_sugar_flavors' => array(
        'PRO',
        'ENT',
        'ULT'
    ),
    'readme' => 'README.txt',
    'key' => 'IRM',
    'author' => 'SugarCRM Developer Support',
    'description' => 'Allows for the ability to restrict user logins to specific ranges of ip addresses.',
    'icon' => '',
    'is_uninstallable' => true,
    'name' => 'IP Restriction Manager',
    'published_date' => '2017-05-04 12:00:00',
    'type' => 'module',
    'version' => '2.3',
    'remove_tables' => 'prompt'
);

$installdefs = array(
    'id' => 'IP_Restriction_Manager',
    'beans' => array(
        array(
            'module' => 'IRM_IPRestrictionManager',
            'class' => 'IRM_IPRestrictionManager',
            'path' => 'modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php',
            'tab' => true
        )
    ),
    'layoutdefs' => array(
        array(
            'from' => '<basepath>/SugarModules/relationships/layoutdefs/irm_iprestrictionmanager_aclroles_ACLRoles.php',
            'to_module' => 'ACLRoles'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/layoutdefs/irm_iprestrictionmanager_aclroles_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/layoutdefs/irm_iprestrictionmanager_teams_Teams.php',
            'to_module' => 'Teams'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/layoutdefs/irm_iprestrictionmanager_teams_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/layoutdefs/irm_iprestrictionmanager_users_Users.php',
            'to_module' => 'Users'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/layoutdefs/irm_iprestrictionmanager_users_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        )
    ),
    'relationships' => array(
        array(
            'meta_data' => '<basepath>/SugarModules/relationships/relationships/irm_iprestrictionmanager_aclrolesMetaData.php'
        ),
        array(
            'meta_data' => '<basepath>/SugarModules/relationships/relationships/irm_iprestrictionmanager_teamsMetaData.php'
        ),
        array(
            'meta_data' => '<basepath>/SugarModules/relationships/relationships/irm_iprestrictionmanager_usersMetaData.php'
        )
    ),
    'image_dir' => '<basepath>/icons',
    'copy' => array(
        array(
            'from' => '<basepath>/SugarModules/modules/IRM_IPRestrictionManager',
            'to' => 'modules/IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/copy/custom/Extension/modules/Administration/Ext/Administration/IPRestrictionManager.php',
            'to' => 'custom/Extension/modules/Administration/Ext/Administration/IPRestrictionManager.php'
        ),
        array(
            'from' => '<basepath>/copy/custom/Extension/modules/Administration/Ext/Language/en_us.IPRestrictionManager.php',
            'to' => 'custom/Extension/modules/Administration/Ext/Language/en_us.IPRestrictionManager.php'
        ),
        array(
            'from' => '<basepath>/copy/custom/clients/base/api/CustomOAuth2Api.php',
            'to' => 'custom/clients/base/api/CustomOAuth2Api.php'
        ),
        array(
            'from' => '<basepath>/copy/custom/clients/base/api/CustomCurrentUserApi.php',
            'to' => 'custom/clients/base/api/CustomCurrentUserApi.php'
        ),
        array(
            'from' => '<basepath>/copy/custom/src/Symfony/Component/HttpFoundation/IpUtils.php',
            'to' => 'custom/src/Symfony/Component/HttpFoundation/IpUtils.php'
        ),
        array(
            'from' => '<basepath>/copy/custom/src/Symfony/Component/HttpFoundation/LICENSE.txt',
            'to' => 'custom/src/Symfony/Component/HttpFoundation/LICENSE.txt'
        ),
        array(
            'from' => '<basepath>/copy/custom/tests/',
            'to' => 'custom/tests/'
        )
    ),
    'language' => array(
        array(
            'from' => '<basepath>/SugarModules/relationships/language/ACLRoles.php',
            'to_module' => 'ACLRoles',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/language/IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/language/Teams.php',
            'to_module' => 'Teams',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/language/IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/language/Users.php',
            'to_module' => 'Users',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/language/IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager',
            'language' => 'en_us'
        ),
        array(
            'from' => '<basepath>/SugarModules/language/application/en_us.lang.php',
            'to_module' => 'application',
            'language' => 'en_us'
        )
    ),
    'sidecar' => array(
        array(
            'from' => '<basepath>/SugarModules/clients/base/layouts/subpanels/irm_iprestrictionmanager_aclroles_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/clients/base/layouts/subpanels/irm_iprestrictionmanager_teams_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/clients/base/layouts/subpanels/irm_iprestrictionmanager_users_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/clients/mobile/layouts/subpanels/irm_iprestrictionmanager_aclroles_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/clients/mobile/layouts/subpanels/irm_iprestrictionmanager_teams_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/clients/mobile/layouts/subpanels/irm_iprestrictionmanager_users_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        )
    ),
    'vardefs' => array(
        array(
            'from' => '<basepath>/SugarModules/relationships/vardefs/irm_iprestrictionmanager_aclroles_ACLRoles.php',
            'to_module' => 'ACLRoles'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/vardefs/irm_iprestrictionmanager_aclroles_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/vardefs/irm_iprestrictionmanager_teams_Teams.php',
            'to_module' => 'Teams'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/vardefs/irm_iprestrictionmanager_teams_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/vardefs/irm_iprestrictionmanager_users_Users.php',
            'to_module' => 'Users'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/vardefs/irm_iprestrictionmanager_users_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        )
    ),
    'wireless_subpanels' => array(
        array(
            'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/irm_iprestrictionmanager_aclroles_ACLRoles.php',
            'to_module' => 'ACLRoles'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/irm_iprestrictionmanager_aclroles_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/irm_iprestrictionmanager_teams_Teams.php',
            'to_module' => 'Teams'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/irm_iprestrictionmanager_teams_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/irm_iprestrictionmanager_users_Users.php',
            'to_module' => 'Users'
        ),
        array(
            'from' => '<basepath>/SugarModules/relationships/wirelesslayoutdefs/irm_iprestrictionmanager_users_IRM_IPRestrictionManager.php',
            'to_module' => 'IRM_IPRestrictionManager'
        )
    )
);

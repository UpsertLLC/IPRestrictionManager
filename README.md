# IP Restriction Manager
[![Build Status](https://travis-ci.org/sugarcrm/IPRestrictionManager.svg?branch=master)](https://travis-ci.org/sugarcrm/IPRestrictionManager)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.4-8892BF.svg?style=flat-square)](https://php.net/)

This is the Users Guide for the IP Restriction Manager plugin version 2.x.  

The IP Restriction Manager plugin allows a Sugar Administrator to setup restrictive IP ranges for authentication. These ranges can be specific to a user, team, role or combination of all three. IP ranges can be specified in the following formats: specific, wildcard, CIDR and Start-End

# Release Notes
* 2.4
    * Support for Sugar 9.0, 9.1, 9.2
    * Update getIpAddress to check additional $_SERVER vars
* 2.3
    * Support for Sugar 7.11 and 8
* 2.2
    * Added Unit Tests
* 2.1
    * Corrections For SugarCRM HealthCheck
        * Removed use of `SugarQuery->compileSQL()`
        * Removed use of `app.view.invokeParent`
* 1.0
    * Initial release of the IP Restriction Manager package

# Prerequisites
Requirements for installation

## Supported Versions
* 7.9.x
* 7.11.x
* 8.x
* 9.x

## Supported Editions
* Professional
* Enterprise
* Ultimate

## Supported Databases
* MySQL
* MSSQL
* Oracle
* DB2

## Supported Languages
* English

# Generating The Module Loader Package
To build the installer package, you will need to download the contents on this repository and execute:
```
php build.php
```
Once completed, the installer `*.zip` package will be located under `./builds/` and can be installed using `Admin > Module Loader`

# Installation
Installation instructions for generating and installing a module loadable package.

1. Login to your SugarCRM instance with an administrator account.
2. Navigate to `Admin > Module Loader`
3. Browse to the IP Restriction Manager Package and upload it.
4. Click the Install button for the IP Restriction Manager package.
5. If you agree to the License Agreement, select ‘Accept’ and click ‘Commit’.

# Upgrading
When upgrading to the latest release, there are several important steps to follow.
1. Make a backup of your SugarCRM filesystem.
2. Make a backup of your SugarCRM database.
3. Follow the uninstallation steps and make sure to select ‘Do Not Remove Tables’ when prompted by the module loader uninstall wizard to remove database tables.
4. Follow the installation steps to install the latest package from this repository.

# Uninstallation
Steps for uninstalling the plugin.

## Through Module Loader
1. Login to your Sugar instance with an administrator account.
2. Navigate to `Admin > Module Loader`
3. Find the ‘IP Restriction Manager’ entry in the list of installed plugins and click ‘Uninstall’.
4. a) If you are planning to install an updated package, you will want to select ‘Do Not Remove Tables’. Please note that this is very important. Doing this will leave all relationship, template and backup records intact for when you install the updated package.    
   b) If you are not planning to continue using the IP Restriction Manager in the future, you will want to select ‘Remove Tables’.
   
## Through FileSystem
Manual steps to remove the plugin. Once the following sections are complete, navigate to `Admin > Repair` and run a `Quick Repair and Rebuild`.

### Files to Remove
* ./modules/IRM_IPRestrictionManager/*
* ./custom/tests/modules/IRM_IPRestrictionManager/*
* ./custom/src/Symfony/Component/HttpFoundation/*
* ./custom/clients/base/api/CustomOAuth2Api.php
* ./custom/clients/base/api/CustomCurrentUserApi.php
* ./custom/Extension/modules/IRM_IPRestrictionManager/*
* ./custom/Extension/modules/Administration/Ext/Administration/IPRestrictionManager.php
* ./custom/Extension/modules/Administration/Ext/Language/en_us.IPRestrictionManager.php
* ./custom/Extension/modules/Users/Ext/Language/{language key}.IP_Restriction_Manager.php
* ./custom/Extension/modules/Users/Ext/Layoutdefs/irm_iprestrictionmanager_users_Users.php
* ./custom/Extension/modules/Users/Ext/Vardefs/irm_iprestrictionmanager_users_Users.php
* ./custom/Extension/modules/Users/Ext/WirelessLayoutdefs/irm_iprestrictionmanager_users_Users.php
* ./custom/Extension/modules/Teams/Ext/Language/{language key}.IP_Restriction_Manager.php
* ./custom/Extension/modules/Teams/Ext/Layoutdefs/irm_iprestrictionmanager_teams_Teams.php
* ./custom/Extension/modules/Teams/Ext/Vardefs/irm_iprestrictionmanager_teams_Teams.php
* ./custom/Extension/modules/Teams/Ext/WirelessLayoutdefs/irm_iprestrictionmanager_teams_Teams.php
* ./custom/Extension/modules/ACLRoles/Ext/Language/{language key}.IP_Restriction_Manager.php
* ./custom/Extension/modules/ACLRoles/Ext/Layoutdefs/irm_iprestrictionmanager_aclroles_ACLRoles.php
* ./custom/Extension/modules/ACLRoles/Ext/Vardefs/irm_iprestrictionmanager_aclroles_ACLRoles.php
* ./custom/Extension/modules/ACLRoles/Ext/WirelessLayoutdefs/irm_iprestrictionmanager_aclroles_ACLRoles.php

These files should also be removed so they can be rebuilt by the extensions framework.
* ./custom/application/Ext/Include/modules.ext.php
* ./custom/application/Ext/TableDictionary/tabledictionary.ext.php
* ./cache/file_map.php
* ./custom/modules/Users/Ext/*
* ./custom/modules/Teams/Ext/*
* ./custom/modules/Roles/Ext/*

### Tables to Remove
Please note these should only be removed if you are not planning to install an updated version.

* irm_iprestrictionmanager
* irm_iprestrictionmanager_aclroles_c
* irm_iprestrictionmanager_audit
* irm_iprestrictionmanager_teams_c
* irm_iprestrictionmanager_users_c

# Recovering When Locked Out
Should a situation occur where you are unable to authenticate, you can use the section below to regain access to the system. You should note that the the IP Restriction Manager is always disabled if the user is logging in from `localhost` or `127.0.0.1`. If you need to disable this check for local testing, it can be found [here](https://github.com/sugarcrm/IPRestrictionManager/blob/master/src/SugarModules/modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php#L173).

## On-Site

### Option 1 - Database Update
If you have database access, you can run the following database query to disable all restrictions:
```
UPDATE irm_iprestrictionmanager SET status = 'Disabled' WHERE deleted = 0;
```

### Option 2 - File Change
If you have file system access, modify the function `validateAPI` in `./modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php` to return before the validation logic:
```
public function validateAPI($api, $username, $platform)
{
    return;
    ...
}
```

## Sugar cloud
If you are On-Demand, you will need to submit a support ticket by logging into https://portal.sugarondemand.com/. Please describe the issue you are experiencing, reference the IP Restriction Manager, and provide a link to this documentation.

# Using the Module
Documentation on the use and administration of ip restrictions.

## Navigating to the IP Restriction Manager
The Ip Restriction Module is only accessible to system administrators. An administrator can navigate to the module in two different ways.
1. Navigating directly to `/#IRM_IPRestrictionManager` in the browsers url
2. Navigating to `Admin > IP Restriction Management`

## Administering IP Restrictions
To create a restriction, you will need to click “Create” from the IP Restriction Modules submenu tabs. New restrictions will be in effect when current users refresh the browser or reauthenticate.

The fields presented on the quick create are outlines below:

### IP Range 
Type: Text

The IP restrictions you would like to implement. Valid restriction types are:
* Specific IP format: 1.2.3.4
* Wildcard format: 1.2.3.*
   * you may use `*` or `*.*.*.*` to signify any ip address
* CIDR format: 1.2.3/24  OR  1.2.3.4/255.255.255.0
* Start-End IP format: 1.2.3.4-1.2.3.5 

### Status
Type: Dropdown

Whether or not the restriction is enabled/disabled. If the status is ‘Disabled’, the restriction will not be in effect.

### Platforms
Type: Multi-Select

The allowed platforms a user is allowed to authenticate to. Available options are:
* All - all platforms
* Base (Sugar) - Sugar UI only
* Mobile - Mobile devices only

#### Adding Platforms
Adminitrators may need to add additional supported platforms to account for intergrations and plugins. To achieve this, navigate to `Admin > Dropdown Editor` and find the `ip_restriction_platforms_list` dropdown list. Next, add the new platform type making sure that the `Item Name` field matches the platform type being passed to the Sugar REST v10 API. You can make the `Display Label` field anything you would like. Click save when done.

### Description
Type: Text

A description of the restriction for administrative use.

# Contributing
Everyone is welcome to be involved by creating or improving functionality. If you would like to contribute, please make sure to review the [contribution terms](CONTRIBUTOR_TERMS.pdf). When you update this [README](README.md), please check out the [contribution guidelines](CONTRIBUTING.md) for helpful hints and tips that will make it easier to accept your pull request.

## Contributors
* [Jerry Clark](https://github.com/geraldclark)
* [Upsert, LLC](https://github.com/UpsertLLC)

# Licensed under Apache
© 2017 SugarCRM Inc.  Licensed by SugarCRM under the Apache 2.0 license.

## Third Party Libraries
* Symfony HttpFoundation Component (3.3.6) - MIT - The HttpFoundation component defines an object-oriented layer for the HTTP specification. This plugin makes use of the symfony/http-foundation IpUtils Library. It is slightly modified to pass Sugars Package Scanner.
    * [Github](https://github.com/symfony/http-foundation)

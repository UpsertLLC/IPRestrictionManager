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

namespace Sugarcrm\Sugarcrm\custom\Upsert\IPRestrictionManager;

class Settings
{
    /**
     * Returns the settings cache key
     *
     * @return string
     */
    public static function getCacheKey()
    {
        return 'upsert_IPRestrictionManager__configs';
    }

    /**
     * Fetches config settings.
     */
    public static function fetchConfigs()
    {
        $cacheKey = static::getCacheKey();
        $settings = sugar_cache_retrieve($cacheKey);
        
        $refetch = false;
        if (is_null($settings) || ! is_array($settings)) {
            $refetch = true;
        }
    
        if ($refetch) {
            $viewdefs = static::getConfigFile();
    
            $fieldNames = [];
            foreach ($viewdefs['upsert_IPRestrictions']['base']['view']['upsert-config']['panels'][1]['fields'] as $field) {
                array_push($fieldNames, $field['name']);
            }
    
            $administration = new \Administration();
            $administration->retrieveSettings('upsert_IPRestrictionManager', true);
            $settings = $administration->settings;
            if (isset($settings['upsert_IPRestrictionManager'])) {
                unset($settings['upsert_IPRestrictionManager']);
            }
    
            foreach ($fieldNames as $fieldName) {
                if ( ! isset($settings[$fieldName])) {
                    $fieldDefaultValue = static::getFieldDefaultValue($fieldName);
                    $settings[$fieldName] = $fieldDefaultValue;
                }
            }
    
            sugar_cache_put($cacheKey, $settings, 0);
        }
    
        return $settings;
    }

    /**
     * Retrieves the file that data will be loaded from.
     *
     * @return array
     */
    public static function getConfigFile()
    {
        $viewdefs = [];
        $file = \SugarAutoLoader::existingCustomOne('modules/upsert_IPRestrictions/clients/base/views/upsert-config/upsert-config.php');
        require $file;

        return $viewdefs;
    }

    /**
     * Returns the default value for the field
     *
     * @param string $fieldName
     *
     * @return string
     */
    public static function getFieldDefaultValue($fieldName)
    {
        $bean = \BeanFactory::getDefinition('upsert_IPRestrictions');

        if (isset($bean->field_defs[$fieldName]['default'])) {
            return $bean->field_defs[$fieldName]['default'];
        }

        return null;
    }

    /**
     * Fetches the config value for a field
     *
     * @param string $fieldName
     *
     * @return string
     */
    public static function fetchConfig($fieldName)
    {
        $configs = static::fetchConfigs();
        
        if (isset($configs[$fieldName])) {
            return $configs[$fieldName];
        }

        if (isset($configs['upsert_IPRestrictionManager_'.$fieldName])) {
            return $configs['upsert_IPRestrictionManager_'.$fieldName];
        }

        return null;
    }
}

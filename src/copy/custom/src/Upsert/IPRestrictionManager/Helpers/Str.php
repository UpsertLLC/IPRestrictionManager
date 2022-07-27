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

namespace Sugarcrm\Sugarcrm\custom\Upsert\IPRestrictionManager\Helpers;

class Str
{
    /**
     * Find function to identify if a string contains a substring. Can handle multiple needles for a haystack search.
     * - modified from origin modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php::hasString
     *
     * @param $needles
     * @param $haystack
     *
     * @return bool
     */
    public static function hasString($needles, $haystack)
    {
        if ( ! is_array($needles)) {
            $needles = [$needles];
        }

        $found = false;
        foreach ($needles as $needle) {
            $position = stripos($haystack, $needle);

            if ($position !== false) {
                $found = true;
                break;
            }
        }

        return $found;
    }

    /**
     * Determines if the string begins with a substring
     *
     * @param string $string
     * @param string $startString
     *
     * @return boolean
     */
    public static function startsWith($string, $startString)
    {
        $length = strlen($startString);
        return (substr($string, 0, $length) === $startString);
    }
}

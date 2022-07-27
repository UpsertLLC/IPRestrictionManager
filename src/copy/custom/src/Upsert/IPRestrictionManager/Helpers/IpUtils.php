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

use Symfony\Component\HttpFoundation\IpUtils as SymfonyIpUtils;

class IpUtils
{
    /**
     * Fetches the current users ip address.
     * - modified from origin modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php::getIpAddress
     *
     * @return string
     */
    public static function getIpAddress()
    {
        $ip = '';

        $headerKeys = [
            'HTTP_CLIENT_IP',
            'HTTP_X_FORWARDED_FOR',
            'HTTP_X_FORWARDED',
            'HTTP_FORWARDED_FOR',
            'HTTP_FORWARDED',
            'REMOTE_ADDR',
        ];

        foreach ($headerKeys as $headerKey) {
            $replacedKey = str_replace('_', '-', ltrim($headerKey, 'HTTP_'));
            if (isset($_SERVER[$headerKey]) && ! empty($_SERVER[$headerKey])) {
                $ip = $_SERVER[$headerKey];
                break;
            } elseif (isset($_SERVER[$replacedKey]) && ! empty($_SERVER[$replacedKey])) {
                $ip = $_SERVER[$replacedKey];
                break;
            }
        }

        return $ip;
    }

    /**
     * Validates the ip against a range syntax.
     * - modified from origin modules/IRM_IPRestrictionManager/IRM_IPRestrictionManager.php::validateRange
     *
     * @param string $ip
     * @param string $range
     *
     *.   Network ranges can be specified as:
     *.   1. Specific: 1.2.3.4
     *.   2. Wildcard: 1.2.3.*
     *.   3. IP/Netmask: 1.2.3.4/255.255.255.0
     *.   4. CIDR: 1.2.3.4/32
     *.   5. Start-End: 1.2.3.4-1.2.3.5
     *
     * @return bool
     */
    public static function validateRange(string $ip, string $range)
    {
        if ($range == '*' || $range == '*.*.*.*') {
            return true;
        }

        //handle wildcard addresses
        if (Str::hasString('*', $range)) {
            $start = str_replace('*', '0', $range);
            $end = str_replace('*', '255', $range);
            $range = "{$start}-{$end}";
        }

        //handle ranges
        if (Str::hasString('-', $range)) {
            list($lower, $upper) = explode('-', $range, 2);
            $lowerConverted = (float)sprintf('%u', ip2long($lower));
            $upperConverted = (float)sprintf('%u', ip2long($upper));
            $ipConverted = (float)sprintf('%u', ip2long($ip));
            return (($ipConverted >= $lowerConverted) && ($ipConverted <= $upperConverted));
        }

        //handle ip-netmask
        if (Str::hasString('/', $range)) {
            list($range, $netmask) = explode('/', $range, 2);
            if (Str::hasString('.', $netmask)) {
                $netmaskConverted = ip2long($netmask);
                return ((ip2long($ip) & $netmaskConverted) == (ip2long($range) & $netmaskConverted));
            }
        }

        //else validate ip4/ip6/CIDR
        return SymfonyIpUtils::checkIp($ip, $range);
    }
}

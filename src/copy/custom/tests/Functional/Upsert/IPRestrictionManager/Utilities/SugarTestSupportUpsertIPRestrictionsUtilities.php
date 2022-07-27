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

namespace Sugarcrm\Sugarcrm\custom\tests\Functional\Upsert\IPRestrictionManager\Utilities;

class SugarTestSupportUpsertIPRestrictionsUtilities extends SugarTestSupportUtilities
{
    protected $_beanName = 'upsert_IPRestrictions';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($attributes = [], $defaults= [])
    {
        //set defaults
        $coreDefaults = [
            'enabled' => true,
            'ip_range' => '*.*.*.*',
            'platforms' => '^all^',
        ];

        $defaults = $this->merge($defaults, $coreDefaults);

        $bean = parent::create($attributes, $defaults);
        return $bean;
    }
}

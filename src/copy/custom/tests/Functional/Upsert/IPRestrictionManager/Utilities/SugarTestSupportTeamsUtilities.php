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

class SugarTestSupportTeamsUtilities extends SugarTestSupportUtilities
{
    protected $_beanName = 'Teams';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($attributes = [], $defaults= [])
    {
        //set defaults
        $coreDefaults = [
            //    "enabled" => true,
        ];

        $defaults = $this->merge($defaults, $coreDefaults);

        $bean = parent::create($attributes, $defaults);
        return $bean;
    }

    public function deleteAll()
    {
        parent::deleteAll(); // TODO: Change the autogenerated stub
        $ids = $this->getCreatedIds();
        if (count($ids) > 0) {
            $in = "'" . implode("', '", $ids) . "'";
            $GLOBALS['db']->query("DELETE FROM team_sets_teams WHERE team_id IN ({$in})");
        }
    }
}

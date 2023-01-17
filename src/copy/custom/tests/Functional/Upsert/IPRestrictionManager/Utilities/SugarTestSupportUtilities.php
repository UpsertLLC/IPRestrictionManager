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

abstract class SugarTestSupportUtilities
{
    protected $_created = [];
    protected $_beanName = '';

    public function __construct()
    {
    }

    /**
     * Create a record
     *
     * @param array $attributes
     * @param array $defaults
     *
     * @return null|SugarBean
     */
    public function create(array $attributes = [], array $defaults = [])
    {
        $fields = [];

        //populate default values
        foreach ($defaults as $field => $value) {
            if (is_object($value) && get_class($value) == 'SugarDateTime') {
                $value = $value->asDb();
            }
            $fields[$field] = $value;
        }

        //set attributes
        foreach ($attributes as $field => $value) {
            if (is_object($value) && get_class($value) == 'SugarDateTime') {
                $value = $value->asDb();
            }
            $fields[$field] = $value;
        }

        $time = mt_rand();

        $bean = \BeanFactory::newBean($this->_beanName);
        $bean->name = 'Sugar' . $this->_beanName . " {$time}";
        $bean->team_id = '1';
        $bean->team_set_id = '1';

        if (isset($fields['disable_hooks']) && $fields['disable_hooks']) {
            $bean->logicHookDepth['after_save'] = 1000;
            $bean->logicHookDepth['before_save'] = 1000;
            $bean->logicHookDepth['before_retrieve'] = 1000;
            $bean->logicHookDepth['after_retrieve'] = 1000;
            $bean->logicHookDepth['before_delete'] = 1000;
            $bean->logicHookDepth['after_delete'] = 1000;
            $bean->logicHookDepth['after_relationship_add'] = 1000;
            $bean->logicHookDepth['after_relationship_delete'] = 1000;
        }


        if (isset($fields['id'])) {
            $bean->new_with_id = true;
        }

        $storedUser = false;
        if (isset($fields['created_by'])) {
            $storedUser = clone $GLOBALS['current_user'];
            $GLOBALS['current_user'] = \BeanFactory::getBean('Users', $fields['created_by']);
        }

        foreach ($fields as $field => $value) {
            $bean->{$field} = $value;
        }

        $bean->save(false);

        if ($storedUser) {
            $GLOBALS['current_user'] = $storedUser;
        }

        $triggered = false;

        if ( ! isset($fields['force_values']) || $fields['force_values'] == true) {
            foreach ($fields as $field => $value) {
                if (in_array($field, ['force_values', 'disable_hooks', 'new_with_id'], true)) {
                    continue;
                }

                if (is_object($value) && get_class($value) == 'SugarDateTime') {
                    $value = $value->asDb();
                }

                if ($bean->{$field} != $value) {
                    $triggered = true;
                    $this->updateField($bean, $field, $value);
                }
            }
        }

        if ($triggered) {
            $bean->retrieve($bean->id);
        }

        $this->addCreatedId($bean->id);

        return $bean;
    }

    /**
     * Merges overrides over the default array
     *
     * @param $overrides
     * @param array $defaults
     * @param mixed $attributes
     *
     * @return array
     */
    public function merge($attributes, $defaults = [])
    {
        foreach ($defaults as $field => $value) {
            if ( ! isset($attributes[$field])) {
                $attributes[$field] = $value;
            }
        }

        return $attributes;
    }

    /**
     * Fetch the beans table name
     *
     * @return String
     */
    public function getTable()
    {
        return \BeanFactory::newBean($this->_beanName)->getTableName();
    }

    /**
     * Updates a field with a given value
     *
     * @param $bean
     * @param $field
     * @param $value
     */
    public function updateField($bean, $field, $value)
    {
        $fieldDef = $bean->field_defs[$field];
        if (array_key_exists('source', $fieldDef) && $fieldDef['source'] == 'custom_fields') {
            $table = $bean->table_name . '_cstm';
            $query = "UPDATE {$table} SET {$field} = '{$value}' where id_c = '{$bean->id}'";
        } else {
            $table = $bean->table_name;
            $query = "UPDATE {$table} SET {$field} = '{$value}' where id = '{$bean->id}'";
        }

        $GLOBALS['db']->query($query);
    }

    /**
     * Deletes all created records
     */
    public function deleteAll()
    {
        $ids = self::getCreatedIds();
        $table = $this->getTable();

        $GLOBALS['db']->query("DELETE FROM {$table} WHERE id IN ('" . implode("', '", $ids) . "')");

        $customTable = $table . '_cstm';
        if ($GLOBALS['db']->tableExists($customTable)) {
            $GLOBALS['db']->query("DELETE FROM {$customTable} WHERE id_c IN ('" . implode("', '", $ids) . "')");
        }

        $auditTable = $table . '_audit';
        if ($GLOBALS['db']->tableExists($auditTable)) {
            $GLOBALS['db']->query("DELETE FROM {$auditTable} WHERE parent_id IN ('" . implode("', '", $ids) . "')");
        }

        if ($GLOBALS['db']->tableExists('relationships')) {
            $sql = "SELECT * FROM relationships WHERE lhs_module = '{$this->_beanName}' AND join_table IS NOT NULL AND join_key_lhs IS NOT NULL AND relationship_type <> 'user-based'";
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
                if ($GLOBALS['db']->tableExists($row['join_table'])) {
                    $GLOBALS['db']->query("DELETE FROM {$row['join_table']} WHERE {$row['join_key_lhs']} IN ('" . implode("', '", $ids) . "')");
                }
            }

            $sql = "SELECT * FROM relationships WHERE rhs_module = '{$this->_beanName}' AND join_table IS NOT NULL AND join_key_rhs IS NOT NULL AND relationship_type <> 'user-based'";
            $result = $GLOBALS['db']->query($sql);
            while ($row = $GLOBALS['db']->fetchByAssoc($result)) {
                if ($GLOBALS['db']->tableExists($row['join_table'])) {
                    $GLOBALS['db']->query("DELETE FROM {$row['join_table']} WHERE {$row['join_key_rhs']} IN ('" . implode("', '", $ids) . "')");
                }
            }
        }
    }

    /**
     * Truncates the tables
     */
    public function truncate()
    {
        $table = $this->getTable();
        $GLOBALS['db']->query("TRUNCATE {$table}");

        $customTable = $table . '_cstm';
        if ($GLOBALS['db']->tableExists($customTable)) {
            $GLOBALS['db']->query("TRUNCATE {$customTable}");
        }

        $auditTable = $table . '_audit';
        if ($GLOBALS['db']->tableExists($auditTable)) {
            $GLOBALS['db']->query("TRUNCATE {$auditTable}");
        }
    }

    /**
     * Returns an instance of the sugarbean
     *
     * @return SugarBean
     */
    public function getInstance()
    {
        return \BeanFactory::newBean($this->_beanName);
    }

    /**
     * Adds an id to the list of created Ids
     *
     * @param mixed $id
     */
    public function addCreatedId($id)
    {
        $this->_created[] = $id;
    }

    /**
     * Returns all created bean Ids
     *
     * @return array
     */
    public function getCreatedIds()
    {
        return $this->_created;
    }
}

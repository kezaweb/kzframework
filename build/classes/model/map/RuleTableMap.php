<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'rule' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.model.map
 */
class RuleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.RuleTableMap';

    /**
     * Initialize the table attributes, columns and validators
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('rule');
        $this->setPhpName('Rule');
        $this->setClassname('Kzf\\Model\\Rule');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('rul_name', 'RulName', 'VARCHAR', false, 45, null);
        $this->addColumn('rul_desc', 'RulDesc', 'VARCHAR', false, 400, null);
        $this->addColumn('rul_actif', 'RulActif', 'BOOLEAN', false, 1, null);
        $this->addForeignKey('tru_id', 'TruId', 'INTEGER', 'type_rule', 'id', false, null, null);
        $this->addForeignKey('created_by', 'CreatedBy', 'INTEGER', 'user', 'id', false, null, null);
        $this->addForeignKey('updated_by', 'UpdatedBy', 'INTEGER', 'user', 'id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TypeRule', 'Kzf\\Model\\TypeRule', RelationMap::MANY_TO_ONE, array('tru_id' => 'id', ), null, null);
        $this->addRelation('UserRelatedByCreatedBy', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('created_by' => 'id', ), null, null);
        $this->addRelation('UserRelatedByUpdatedBy', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('updated_by' => 'id', ), null, null);
        $this->addRelation('BchRul', 'Kzf\\Model\\BchRul', RelationMap::ONE_TO_MANY, array('id' => 'rul_id', ), null, null, 'BchRuls');
        $this->addRelation('LefRul', 'Kzf\\Model\\LefRul', RelationMap::ONE_TO_MANY, array('id' => 'rul_id', ), null, null, 'LefRuls');
        $this->addRelation('RulOption', 'Kzf\\Model\\RulOption', RelationMap::ONE_TO_MANY, array('id' => 'rul_id', ), null, null, 'RulOptions');
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' =>  array (
  'create_column' => 'created_at',
  'update_column' => 'updated_at',
  'disable_updated_at' => 'false',
),
        );
    } // getBehaviors()

} // RuleTableMap

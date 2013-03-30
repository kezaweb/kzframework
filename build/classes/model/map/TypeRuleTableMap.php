<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'type_rule' table.
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
class TypeRuleTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.TypeRuleTableMap';

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
        $this->setName('type_rule');
        $this->setPhpName('TypeRule');
        $this->setClassname('Kzf\\Model\\TypeRule');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('is_in_store', 'IsInStore', 'BOOLEAN', false, 1, null);
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
        $this->addRelation('UserRelatedByCreatedBy', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('created_by' => 'id', ), null, null);
        $this->addRelation('UserRelatedByUpdatedBy', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('updated_by' => 'id', ), null, null);
        $this->addRelation('Rule', 'Kzf\\Model\\Rule', RelationMap::ONE_TO_MANY, array('id' => 'tru_id', ), null, null, 'Rules');
        $this->addRelation('TypeRuleI18n', 'Kzf\\Model\\TypeRuleI18n', RelationMap::ONE_TO_ONE, array('id' => 'id', ), null, null);
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

} // TypeRuleTableMap

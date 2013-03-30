<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'lef_rul' table.
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
class LefRulTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.LefRulTableMap';

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
        $this->setName('lef_rul');
        $this->setPhpName('LefRul');
        $this->setClassname('Kzf\\Model\\LefRul');
        $this->setPackage('model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('lef_id', 'LefId', 'INTEGER' , 'leaf', 'id', true, null, null);
        $this->addForeignPrimaryKey('rul_id', 'RulId', 'INTEGER' , 'rule', 'id', true, null, null);
        $this->addColumn('ler_option', 'LerOption', 'LONGVARCHAR', false, null, null);
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
        $this->addRelation('Rule', 'Kzf\\Model\\Rule', RelationMap::MANY_TO_ONE, array('rul_id' => 'id', ), null, null);
        $this->addRelation('Leaf', 'Kzf\\Model\\Leaf', RelationMap::MANY_TO_ONE, array('lef_id' => 'id', ), null, null);
        $this->addRelation('UserRelatedByCreatedBy', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('created_by' => 'id', ), null, null);
        $this->addRelation('UserRelatedByUpdatedBy', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('updated_by' => 'id', ), null, null);
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

} // LefRulTableMap

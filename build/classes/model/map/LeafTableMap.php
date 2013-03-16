<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'leaf' table.
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
class LeafTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.LeafTableMap';

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
        $this->setName('leaf');
        $this->setPhpName('Leaf');
        $this->setClassname('Kzf\\Model\\Leaf');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('lef_title', 'LefTitle', 'VARCHAR', false, 150, null);
        $this->addColumn('lef_active', 'LefActive', 'BOOLEAN', false, 1, null);
        $this->addColumn('lef_published_at', 'LefPublishedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('lef_content', 'LefContent', 'BLOB', false, null, null);
        $this->addForeignKey('created_by', 'CreatedBy', 'INTEGER', 'user', 'id', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addForeignKey('updated_by', 'UpdatedBy', 'INTEGER', 'user', 'id', false, null, null);
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
        $this->addRelation('LefRul', 'Kzf\\Model\\LefRul', RelationMap::ONE_TO_MANY, array('id' => 'lef_id', ), null, null, 'LefRuls');
        $this->addRelation('NodeTree', 'Kzf\\Model\\NodeTree', RelationMap::ONE_TO_MANY, array('id' => 'lef_id', ), null, null, 'NodeTrees');
    } // buildRelations()

} // LeafTableMap

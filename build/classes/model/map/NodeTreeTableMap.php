<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'node_tree' table.
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
class NodeTreeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.NodeTreeTableMap';

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
        $this->setName('node_tree');
        $this->setPhpName('NodeTree');
        $this->setClassname('Kzf\\Model\\NodeTree');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('ndt_id', 'NdtId', 'INTEGER', false, null, null);
        $this->addColumn('ndt_position', 'NdtPosition', 'INTEGER', false, null, null);
        $this->addColumn('ndt_left', 'NdtLeft', 'INTEGER', false, null, null);
        $this->addColumn('ndt_right', 'NdtRight', 'INTEGER', false, null, null);
        $this->addColumn('ndt_level', 'NdtLevel', 'INTEGER', false, null, null);
        $this->addColumn('ndt_title', 'NdtTitle', 'VARCHAR', false, 150, null);
        $this->addColumn('ndt_type', 'NdtType', 'VARCHAR', false, 45, null);
        $this->addColumn('ndt_cloud', 'NdtCloud', 'BOOLEAN', false, 1, null);
        $this->addColumn('ndt_virtual', 'NdtVirtual', 'BOOLEAN', false, 1, null);
        $this->addForeignKey('bch_id', 'BchId', 'INTEGER', 'branch', 'id', false, null, null);
        $this->addForeignKey('bch_parent', 'BchParent', 'INTEGER', 'branch', 'id', false, null, null);
        $this->addForeignKey('lef_id', 'LefId', 'INTEGER', 'leaf', 'id', false, null, null);
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
        $this->addRelation('Leaf', 'Kzf\\Model\\Leaf', RelationMap::MANY_TO_ONE, array('lef_id' => 'id', ), null, null);
        $this->addRelation('BranchRelatedByBchId', 'Kzf\\Model\\Branch', RelationMap::MANY_TO_ONE, array('bch_id' => 'id', ), null, null);
        $this->addRelation('BranchRelatedByBchParent', 'Kzf\\Model\\Branch', RelationMap::MANY_TO_ONE, array('bch_parent' => 'id', ), null, null);
    } // buildRelations()

} // NodeTreeTableMap

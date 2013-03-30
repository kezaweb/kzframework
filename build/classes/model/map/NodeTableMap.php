<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'node' table.
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
class NodeTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.NodeTableMap';

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
        $this->setName('node');
        $this->setPhpName('Node');
        $this->setClassname('Kzf\\Model\\Node');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('nod_title', 'NodTitle', 'VARCHAR', false, 150, null);
        $this->addColumn('nod_left', 'NodLeft', 'INTEGER', false, null, null);
        $this->addColumn('nod_right', 'NodRight', 'INTEGER', false, null, null);
        $this->addColumn('nod_level', 'NodLevel', 'INTEGER', false, null, null);
        $this->addColumn('nod_type', 'NodType', 'VARCHAR', false, 45, null);
        $this->addColumn('nod_cloud', 'NodCloud', 'INTEGER', false, 1, null);
        $this->addColumn('nod_virtual', 'NodVirtual', 'INTEGER', false, 1, null);
        $this->addColumn('bch_id', 'BchId', 'INTEGER', false, null, null);
        $this->addColumn('bch_parent', 'BchParent', 'INTEGER', false, null, null);
        $this->addColumn('lef_id', 'LefId', 'INTEGER', false, null, null);
        $this->addColumn('created_by', 'CreatedBy', 'INTEGER', false, null, null);
        $this->addColumn('updated_by', 'UpdatedBy', 'INTEGER', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
            'nested_set' =>  array (
  'left_column' => 'nod_left',
  'right_column' => 'nod_right',
  'level_column' => 'nod_level',
  'use_scope' => 'false',
  'scope_column' => 'tree_scope',
  'method_proxies' => 'true',
),
        );
    } // getBehaviors()

} // NodeTableMap

<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'usr_cre' table.
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
class UsrCreTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.UsrCreTableMap';

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
        $this->setName('usr_cre');
        $this->setPhpName('UsrCre');
        $this->setClassname('Kzf\\Model\\UsrCre');
        $this->setPackage('model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('usr_id', 'UsrId', 'INTEGER' , 'user', 'id', true, null, null);
        $this->addForeignPrimaryKey('cre_id', 'CreId', 'INTEGER' , 'credential', 'id', true, null, null);
        $this->addForeignKey('created_by', 'CreatedBy', 'INTEGER', 'user', 'id', false, null, null);
        $this->addForeignKey('updated_by', 'UpdatedBy', 'INTEGER', 'user', 'id', false, null, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('UserRelatedByUsrId', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('usr_id' => 'id', ), null, null);
        $this->addRelation('Credential', 'Kzf\\Model\\Credential', RelationMap::MANY_TO_ONE, array('cre_id' => 'id', ), null, null);
        $this->addRelation('UserRelatedByCreatedBy', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('created_by' => 'id', ), null, null);
        $this->addRelation('UserRelatedByUpdatedBy', 'Kzf\\Model\\User', RelationMap::MANY_TO_ONE, array('updated_by' => 'id', ), null, null);
    } // buildRelations()

} // UsrCreTableMap

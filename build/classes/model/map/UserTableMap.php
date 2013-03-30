<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'user' table.
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
class UserTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.UserTableMap';

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
        $this->setName('user');
        $this->setPhpName('User');
        $this->setClassname('Kzf\\Model\\User');
        $this->setPackage('model');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('usr_first_name', 'UsrFirstName', 'VARCHAR', false, 70, null);
        $this->addColumn('usr_last_name', 'UsrLastName', 'VARCHAR', false, 70, null);
        $this->addColumn('usr_login', 'UsrLogin', 'VARCHAR', false, 70, null);
        $this->addColumn('usr_password', 'UsrPassword', 'VARCHAR', false, 70, null);
        $this->addColumn('usr_cp', 'UsrCp', 'INTEGER', false, 5, null);
        $this->addColumn('usr_avatar', 'UsrAvatar', 'VARCHAR', false, 100, null);
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
        $this->addRelation('BchRulRelatedByCreatedBy', 'Kzf\\Model\\BchRul', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'BchRulsRelatedByCreatedBy');
        $this->addRelation('BchRulRelatedByUpdatedBy', 'Kzf\\Model\\BchRul', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'BchRulsRelatedByUpdatedBy');
        $this->addRelation('BranchRelatedByCreatedBy', 'Kzf\\Model\\Branch', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'BranchsRelatedByCreatedBy');
        $this->addRelation('BranchRelatedByUpdatedBy', 'Kzf\\Model\\Branch', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'BranchsRelatedByUpdatedBy');
        $this->addRelation('CredentialRelatedByCreatedBy', 'Kzf\\Model\\Credential', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'CredentialsRelatedByCreatedBy');
        $this->addRelation('CredentialRelatedByUpdatedBy', 'Kzf\\Model\\Credential', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'CredentialsRelatedByUpdatedBy');
        $this->addRelation('LeafRelatedByCreatedBy', 'Kzf\\Model\\Leaf', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'LeafsRelatedByCreatedBy');
        $this->addRelation('LeafRelatedByUpdatedBy', 'Kzf\\Model\\Leaf', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'LeafsRelatedByUpdatedBy');
        $this->addRelation('LefRulRelatedByCreatedBy', 'Kzf\\Model\\LefRul', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'LefRulsRelatedByCreatedBy');
        $this->addRelation('LefRulRelatedByUpdatedBy', 'Kzf\\Model\\LefRul', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'LefRulsRelatedByUpdatedBy');
        $this->addRelation('RulOptionRelatedByCreatedBy', 'Kzf\\Model\\RulOption', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'RulOptionsRelatedByCreatedBy');
        $this->addRelation('RulOptionRelatedByUpdatedBy', 'Kzf\\Model\\RulOption', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'RulOptionsRelatedByUpdatedBy');
        $this->addRelation('RuleRelatedByCreatedBy', 'Kzf\\Model\\Rule', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'RulesRelatedByCreatedBy');
        $this->addRelation('RuleRelatedByUpdatedBy', 'Kzf\\Model\\Rule', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'RulesRelatedByUpdatedBy');
        $this->addRelation('TemplateRelatedByCreatedBy', 'Kzf\\Model\\Template', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'TemplatesRelatedByCreatedBy');
        $this->addRelation('TemplateRelatedByUpdatedBy', 'Kzf\\Model\\Template', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'TemplatesRelatedByUpdatedBy');
        $this->addRelation('TypeRuleRelatedByCreatedBy', 'Kzf\\Model\\TypeRule', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'TypeRulesRelatedByCreatedBy');
        $this->addRelation('TypeRuleRelatedByUpdatedBy', 'Kzf\\Model\\TypeRule', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'TypeRulesRelatedByUpdatedBy');
        $this->addRelation('UserRelatedById0', 'Kzf\\Model\\User', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'UsersRelatedById0');
        $this->addRelation('UserRelatedById1', 'Kzf\\Model\\User', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'UsersRelatedById1');
        $this->addRelation('UsrCreRelatedByUsrId', 'Kzf\\Model\\UsrCre', RelationMap::ONE_TO_MANY, array('id' => 'usr_id', ), null, null, 'UsrCresRelatedByUsrId');
        $this->addRelation('UsrCreRelatedByCreatedBy', 'Kzf\\Model\\UsrCre', RelationMap::ONE_TO_MANY, array('id' => 'created_by', ), null, null, 'UsrCresRelatedByCreatedBy');
        $this->addRelation('UsrCreRelatedByUpdatedBy', 'Kzf\\Model\\UsrCre', RelationMap::ONE_TO_MANY, array('id' => 'updated_by', ), null, null, 'UsrCresRelatedByUpdatedBy');
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

} // UserTableMap

<?php

namespace Kzf\Model\map;

use \RelationMap;
use \TableMap;


/**
 * This class defines the structure of the 'type_rule_i18n' table.
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
class TypeRuleI18nTableMap extends TableMap
{

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = 'model.map.TypeRuleI18nTableMap';

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
        $this->setName('type_rule_i18n');
        $this->setPhpName('TypeRuleI18n');
        $this->setClassname('Kzf\\Model\\TypeRuleI18n');
        $this->setPackage('model');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('id', 'Id', 'INTEGER' , 'type_rule', 'id', true, null, null);
        $this->addColumn('local', 'Local', 'VARCHAR', true, 5, 'en_EN');
        $this->addColumn('tru_name', 'TruName', 'VARCHAR', true, 255, null);
        // validators
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('TypeRule', 'Kzf\\Model\\TypeRule', RelationMap::MANY_TO_ONE, array('id' => 'id', ), null, null);
    } // buildRelations()

} // TypeRuleI18nTableMap

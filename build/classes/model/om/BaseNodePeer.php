<?php

namespace Kzf\Model\om;

use \BasePeer;
use \Criteria;
use \PDO;
use \PDOStatement;
use \Propel;
use \PropelException;
use \PropelPDO;
use Kzf\Model\Node;
use Kzf\Model\NodePeer;
use Kzf\Model\map\NodeTableMap;

/**
 * Base static class for performing query and update operations on the 'node' table.
 *
 *
 *
 * @package propel.generator.model.om
 */
abstract class BaseNodePeer
{

    /** the default database name for this class */
    const DATABASE_NAME = 'kzf';

    /** the table name for this class */
    const TABLE_NAME = 'node';

    /** the related Propel class for this table */
    const OM_CLASS = 'Kzf\\Model\\Node';

    /** the related TableMap class for this table */
    const TM_CLASS = 'NodeTableMap';

    /** The total number of columns. */
    const NUM_COLUMNS = 16;

    /** The number of lazy-loaded columns. */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /** The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS) */
    const NUM_HYDRATE_COLUMNS = 16;

    /** the column name for the id field */
    const ID = 'node.id';

    /** the column name for the nod_master field */
    const NOD_MASTER = 'node.nod_master';

    /** the column name for the nod_title field */
    const NOD_TITLE = 'node.nod_title';

    /** the column name for the nod_left field */
    const NOD_LEFT = 'node.nod_left';

    /** the column name for the nod_right field */
    const NOD_RIGHT = 'node.nod_right';

    /** the column name for the nod_level field */
    const NOD_LEVEL = 'node.nod_level';

    /** the column name for the nod_type field */
    const NOD_TYPE = 'node.nod_type';

    /** the column name for the nod_cloud field */
    const NOD_CLOUD = 'node.nod_cloud';

    /** the column name for the nod_virtual field */
    const NOD_VIRTUAL = 'node.nod_virtual';

    /** the column name for the bch_id field */
    const BCH_ID = 'node.bch_id';

    /** the column name for the bch_parent field */
    const BCH_PARENT = 'node.bch_parent';

    /** the column name for the lef_id field */
    const LEF_ID = 'node.lef_id';

    /** the column name for the created_by field */
    const CREATED_BY = 'node.created_by';

    /** the column name for the updated_by field */
    const UPDATED_BY = 'node.updated_by';

    /** the column name for the created_at field */
    const CREATED_AT = 'node.created_at';

    /** the column name for the updated_at field */
    const UPDATED_AT = 'node.updated_at';

    /** The default string format for model objects of the related table **/
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * An identiy map to hold any loaded instances of Node objects.
     * This must be public so that other peer classes can access this when hydrating from JOIN
     * queries.
     * @var        array Node[]
     */
    public static $instances = array();


    // nested_set behavior

    /**
     * Left column for the set
     */
    const LEFT_COL = 'node.nod_left';

    /**
     * Right column for the set
     */
    const RIGHT_COL = 'node.nod_right';

    /**
     * Level column for the set
     */
    const LEVEL_COL = 'node.nod_level';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. NodePeer::$fieldNames[NodePeer::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        BasePeer::TYPE_PHPNAME => array ('Id', 'NodMaster', 'NodTitle', 'NodLeft', 'NodRight', 'NodLevel', 'NodType', 'NodCloud', 'NodVirtual', 'BchId', 'BchParent', 'LefId', 'CreatedBy', 'UpdatedBy', 'CreatedAt', 'UpdatedAt', ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id', 'nodMaster', 'nodTitle', 'nodLeft', 'nodRight', 'nodLevel', 'nodType', 'nodCloud', 'nodVirtual', 'bchId', 'bchParent', 'lefId', 'createdBy', 'updatedBy', 'createdAt', 'updatedAt', ),
        BasePeer::TYPE_COLNAME => array (NodePeer::ID, NodePeer::NOD_MASTER, NodePeer::NOD_TITLE, NodePeer::NOD_LEFT, NodePeer::NOD_RIGHT, NodePeer::NOD_LEVEL, NodePeer::NOD_TYPE, NodePeer::NOD_CLOUD, NodePeer::NOD_VIRTUAL, NodePeer::BCH_ID, NodePeer::BCH_PARENT, NodePeer::LEF_ID, NodePeer::CREATED_BY, NodePeer::UPDATED_BY, NodePeer::CREATED_AT, NodePeer::UPDATED_AT, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID', 'NOD_MASTER', 'NOD_TITLE', 'NOD_LEFT', 'NOD_RIGHT', 'NOD_LEVEL', 'NOD_TYPE', 'NOD_CLOUD', 'NOD_VIRTUAL', 'BCH_ID', 'BCH_PARENT', 'LEF_ID', 'CREATED_BY', 'UPDATED_BY', 'CREATED_AT', 'UPDATED_AT', ),
        BasePeer::TYPE_FIELDNAME => array ('id', 'nod_master', 'nod_title', 'nod_left', 'nod_right', 'nod_level', 'nod_type', 'nod_cloud', 'nod_virtual', 'bch_id', 'bch_parent', 'lef_id', 'created_by', 'updated_by', 'created_at', 'updated_at', ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. NodePeer::$fieldNames[BasePeer::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'NodMaster' => 1, 'NodTitle' => 2, 'NodLeft' => 3, 'NodRight' => 4, 'NodLevel' => 5, 'NodType' => 6, 'NodCloud' => 7, 'NodVirtual' => 8, 'BchId' => 9, 'BchParent' => 10, 'LefId' => 11, 'CreatedBy' => 12, 'UpdatedBy' => 13, 'CreatedAt' => 14, 'UpdatedAt' => 15, ),
        BasePeer::TYPE_STUDLYPHPNAME => array ('id' => 0, 'nodMaster' => 1, 'nodTitle' => 2, 'nodLeft' => 3, 'nodRight' => 4, 'nodLevel' => 5, 'nodType' => 6, 'nodCloud' => 7, 'nodVirtual' => 8, 'bchId' => 9, 'bchParent' => 10, 'lefId' => 11, 'createdBy' => 12, 'updatedBy' => 13, 'createdAt' => 14, 'updatedAt' => 15, ),
        BasePeer::TYPE_COLNAME => array (NodePeer::ID => 0, NodePeer::NOD_MASTER => 1, NodePeer::NOD_TITLE => 2, NodePeer::NOD_LEFT => 3, NodePeer::NOD_RIGHT => 4, NodePeer::NOD_LEVEL => 5, NodePeer::NOD_TYPE => 6, NodePeer::NOD_CLOUD => 7, NodePeer::NOD_VIRTUAL => 8, NodePeer::BCH_ID => 9, NodePeer::BCH_PARENT => 10, NodePeer::LEF_ID => 11, NodePeer::CREATED_BY => 12, NodePeer::UPDATED_BY => 13, NodePeer::CREATED_AT => 14, NodePeer::UPDATED_AT => 15, ),
        BasePeer::TYPE_RAW_COLNAME => array ('ID' => 0, 'NOD_MASTER' => 1, 'NOD_TITLE' => 2, 'NOD_LEFT' => 3, 'NOD_RIGHT' => 4, 'NOD_LEVEL' => 5, 'NOD_TYPE' => 6, 'NOD_CLOUD' => 7, 'NOD_VIRTUAL' => 8, 'BCH_ID' => 9, 'BCH_PARENT' => 10, 'LEF_ID' => 11, 'CREATED_BY' => 12, 'UPDATED_BY' => 13, 'CREATED_AT' => 14, 'UPDATED_AT' => 15, ),
        BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'nod_master' => 1, 'nod_title' => 2, 'nod_left' => 3, 'nod_right' => 4, 'nod_level' => 5, 'nod_type' => 6, 'nod_cloud' => 7, 'nod_virtual' => 8, 'bch_id' => 9, 'bch_parent' => 10, 'lef_id' => 11, 'created_by' => 12, 'updated_by' => 13, 'created_at' => 14, 'updated_at' => 15, ),
        BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, )
    );

    /**
     * Translates a fieldname to another type
     *
     * @param      string $name field name
     * @param      string $fromType One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                         BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @param      string $toType   One of the class type constants
     * @return string          translated name of the field.
     * @throws PropelException - if the specified name could not be found in the fieldname mappings.
     */
    public static function translateFieldName($name, $fromType, $toType)
    {
        $toNames = NodePeer::getFieldNames($toType);
        $key = isset(NodePeer::$fieldKeys[$fromType][$name]) ? NodePeer::$fieldKeys[$fromType][$name] : null;
        if ($key === null) {
            throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(NodePeer::$fieldKeys[$fromType], true));
        }

        return $toNames[$key];
    }

    /**
     * Returns an array of field names.
     *
     * @param      string $type The type of fieldnames to return:
     *                      One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                      BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
     * @return array           A list of field names
     * @throws PropelException - if the type is not valid.
     */
    public static function getFieldNames($type = BasePeer::TYPE_PHPNAME)
    {
        if (!array_key_exists($type, NodePeer::$fieldNames)) {
            throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME, BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. ' . $type . ' was given.');
        }

        return NodePeer::$fieldNames[$type];
    }

    /**
     * Convenience method which changes table.column to alias.column.
     *
     * Using this method you can maintain SQL abstraction while using column aliases.
     * <code>
     *		$c->addAlias("alias1", TablePeer::TABLE_NAME);
     *		$c->addJoin(TablePeer::alias("alias1", TablePeer::PRIMARY_KEY_COLUMN), TablePeer::PRIMARY_KEY_COLUMN);
     * </code>
     * @param      string $alias The alias for the current table.
     * @param      string $column The column name for current table. (i.e. NodePeer::COLUMN_NAME).
     * @return string
     */
    public static function alias($alias, $column)
    {
        return str_replace(NodePeer::TABLE_NAME.'.', $alias.'.', $column);
    }

    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param      Criteria $criteria object containing the columns to add.
     * @param      string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(NodePeer::ID);
            $criteria->addSelectColumn(NodePeer::NOD_MASTER);
            $criteria->addSelectColumn(NodePeer::NOD_TITLE);
            $criteria->addSelectColumn(NodePeer::NOD_LEFT);
            $criteria->addSelectColumn(NodePeer::NOD_RIGHT);
            $criteria->addSelectColumn(NodePeer::NOD_LEVEL);
            $criteria->addSelectColumn(NodePeer::NOD_TYPE);
            $criteria->addSelectColumn(NodePeer::NOD_CLOUD);
            $criteria->addSelectColumn(NodePeer::NOD_VIRTUAL);
            $criteria->addSelectColumn(NodePeer::BCH_ID);
            $criteria->addSelectColumn(NodePeer::BCH_PARENT);
            $criteria->addSelectColumn(NodePeer::LEF_ID);
            $criteria->addSelectColumn(NodePeer::CREATED_BY);
            $criteria->addSelectColumn(NodePeer::UPDATED_BY);
            $criteria->addSelectColumn(NodePeer::CREATED_AT);
            $criteria->addSelectColumn(NodePeer::UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.nod_master');
            $criteria->addSelectColumn($alias . '.nod_title');
            $criteria->addSelectColumn($alias . '.nod_left');
            $criteria->addSelectColumn($alias . '.nod_right');
            $criteria->addSelectColumn($alias . '.nod_level');
            $criteria->addSelectColumn($alias . '.nod_type');
            $criteria->addSelectColumn($alias . '.nod_cloud');
            $criteria->addSelectColumn($alias . '.nod_virtual');
            $criteria->addSelectColumn($alias . '.bch_id');
            $criteria->addSelectColumn($alias . '.bch_parent');
            $criteria->addSelectColumn($alias . '.lef_id');
            $criteria->addSelectColumn($alias . '.created_by');
            $criteria->addSelectColumn($alias . '.updated_by');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
        }
    }

    /**
     * Returns the number of rows matching criteria.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @return int Number of matching rows.
     */
    public static function doCount(Criteria $criteria, $distinct = false, PropelPDO $con = null)
    {
        // we may modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NodePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NodePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count
        $criteria->setDbName(NodePeer::DATABASE_NAME); // Set the correct dbName

        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        // BasePeer returns a PDOStatement
        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }
    /**
     * Selects one object from the DB.
     *
     * @param      Criteria $criteria object used to create the SELECT statement.
     * @param      PropelPDO $con
     * @return                 Node
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectOne(Criteria $criteria, PropelPDO $con = null)
    {
        $critcopy = clone $criteria;
        $critcopy->setLimit(1);
        $objects = NodePeer::doSelect($critcopy, $con);
        if ($objects) {
            return $objects[0];
        }

        return null;
    }
    /**
     * Selects several row from the DB.
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con
     * @return array           Array of selected Objects
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelect(Criteria $criteria, PropelPDO $con = null)
    {
        return NodePeer::populateObjects(NodePeer::doSelectStmt($criteria, $con));
    }
    /**
     * Prepares the Criteria object and uses the parent doSelect() method to execute a PDOStatement.
     *
     * Use this method directly if you want to work with an executed statement directly (for example
     * to perform your own object hydration).
     *
     * @param      Criteria $criteria The Criteria object used to build the SELECT statement.
     * @param      PropelPDO $con The connection to use
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return PDOStatement The executed PDOStatement object.
     * @see        BasePeer::doSelect()
     */
    public static function doSelectStmt(Criteria $criteria, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        if (!$criteria->hasSelectClause()) {
            $criteria = clone $criteria;
            NodePeer::addSelectColumns($criteria);
        }

        // Set the correct dbName
        $criteria->setDbName(NodePeer::DATABASE_NAME);

        // BasePeer returns a PDOStatement
        return BasePeer::doSelect($criteria, $con);
    }
    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doSelect*()
     * methods in your stub classes -- you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by doSelect*()
     * and retrieveByPK*() calls.
     *
     * @param      Node $obj A Node object.
     * @param      string $key (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if ($key === null) {
                $key = (string) $obj->getId();
            } // if key === null
            NodePeer::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param      mixed $value A Node object or a primary key value.
     *
     * @return void
     * @throws PropelException - if the value is invalid.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && $value !== null) {
            if (is_object($value) && $value instanceof Node) {
                $key = (string) $value->getId();
            } elseif (is_scalar($value)) {
                // assume we've been passed a primary key
                $key = (string) $value;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or Node object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value,true)));
                throw $e;
            }

            unset(NodePeer::$instances[$key]);
        }
    } // removeInstanceFromPool()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      string $key The key (@see getPrimaryKeyHash()) for this instance.
     * @return   Node Found object or null if 1) no instance exists for specified key or 2) instance pooling has been disabled.
     * @see        getPrimaryKeyHash()
     */
    public static function getInstanceFromPool($key)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (isset(NodePeer::$instances[$key])) {
                return NodePeer::$instances[$key];
            }
        }

        return null; // just to be explicit
    }

    /**
     * Clear the instance pool.
     *
     * @return void
     */
    public static function clearInstancePool($and_clear_all_references = false)
    {
      if ($and_clear_all_references)
      {
        foreach (NodePeer::$instances as $instance)
        {
          $instance->clearAllReferences(true);
        }
      }
        NodePeer::$instances = array();
    }

    /**
     * Method to invalidate the instance pool of all tables related to node
     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return string A string version of PK or null if the components of primary key in result array are all null.
     */
    public static function getPrimaryKeyHashFromRow($row, $startcol = 0)
    {
        // If the PK cannot be derived from the row, return null.
        if ($row[$startcol] === null) {
            return null;
        }

        return (string) $row[$startcol];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $startcol = 0)
    {

        return (int) $row[$startcol];
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function populateObjects(PDOStatement $stmt)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = NodePeer::getOMClass();
        // populate the object(s)
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key = NodePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj = NodePeer::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                NodePeer::addInstanceToPool($obj, $key);
            } // if key exists
        }
        $stmt->closeCursor();

        return $results;
    }
    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param      array $row PropelPDO resultset row.
     * @param      int $startcol The 0-based offset for reading from the resultset row.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     * @return array (Node object, last column rank)
     */
    public static function populateObject($row, $startcol = 0)
    {
        $key = NodePeer::getPrimaryKeyHashFromRow($row, $startcol);
        if (null !== ($obj = NodePeer::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $startcol, true); // rehydrate
            $col = $startcol + NodePeer::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = NodePeer::OM_CLASS;
            $obj = new $cls();
            $col = $obj->hydrate($row, $startcol);
            NodePeer::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }


    /**
     * Returns the number of rows matching criteria, joining all related tables
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct Whether to select only distinct columns; deprecated: use Criteria->setDistinct() instead.
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return int Number of matching rows.
     */
    public static function doCountJoinAll(Criteria $criteria, $distinct = false, PropelPDO $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        // we're going to modify criteria, so copy it first
        $criteria = clone $criteria;

        // We need to set the primary table name, since in the case that there are no WHERE columns
        // it will be impossible for the BasePeer::createSelectSql() method to determine which
        // tables go into the FROM clause.
        $criteria->setPrimaryTableName(NodePeer::TABLE_NAME);

        if ($distinct && !in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
            $criteria->setDistinct();
        }

        if (!$criteria->hasSelectClause()) {
            NodePeer::addSelectColumns($criteria);
        }

        $criteria->clearOrderByColumns(); // ORDER BY won't ever affect the count

        // Set the correct dbName
        $criteria->setDbName(NodePeer::DATABASE_NAME);

        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $stmt = BasePeer::doCount($criteria, $con);

        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $count = (int) $row[0];
        } else {
            $count = 0; // no rows returned; we infer that means 0 matches.
        }
        $stmt->closeCursor();

        return $count;
    }

    /**
     * Selects a collection of Node objects pre-filled with all related objects.
     *
     * @param      Criteria  $criteria
     * @param      PropelPDO $con
     * @param      String    $join_behavior the type of joins to use, defaults to Criteria::LEFT_JOIN
     * @return array           Array of Node objects.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doSelectJoinAll(Criteria $criteria, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $criteria = clone $criteria;

        // Set the correct dbName if it has not been overridden
        if ($criteria->getDbName() == Propel::getDefaultDB()) {
            $criteria->setDbName(NodePeer::DATABASE_NAME);
        }

        NodePeer::addSelectColumns($criteria);
        $startcol2 = NodePeer::NUM_HYDRATE_COLUMNS;

        $stmt = BasePeer::doSelect($criteria, $con);
        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $key1 = NodePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null !== ($obj1 = NodePeer::getInstanceFromPool($key1))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj1->hydrate($row, 0, true); // rehydrate
            } else {
                $cls = NodePeer::getOMClass();

                $obj1 = new $cls();
                $obj1->hydrate($row);
                NodePeer::addInstanceToPool($obj1, $key1);
            } // if obj1 already loaded

            $results[] = $obj1;
        }
        $stmt->closeCursor();

        return $results;
    }

    /**
     * Returns the TableMap related to this peer.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getDatabaseMap(NodePeer::DATABASE_NAME)->getTable(NodePeer::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this peer class.
     */
    public static function buildTableMap()
    {
      $dbMap = Propel::getDatabaseMap(BaseNodePeer::DATABASE_NAME);
      if (!$dbMap->hasTable(BaseNodePeer::TABLE_NAME)) {
        $dbMap->addTableObject(new NodeTableMap());
      }
    }

    /**
     * The class that the Peer will make instances of.
     *
     *
     * @return string ClassName
     */
    public static function getOMClass($row = 0, $colnum = 0)
    {
        return NodePeer::OM_CLASS;
    }

    /**
     * Performs an INSERT on the database, given a Node or Criteria object.
     *
     * @param      mixed $values Criteria or Node object containing data that is used to create the INSERT statement.
     * @param      PropelPDO $con the PropelPDO connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doInsert($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity
        } else {
            $criteria = $values->buildCriteria(); // build Criteria from Node object
        }

        if ($criteria->containsKey(NodePeer::ID) && $criteria->keyContainsValue(NodePeer::ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.NodePeer::ID.')');
        }


        // Set the correct dbName
        $criteria->setDbName(NodePeer::DATABASE_NAME);

        try {
            // use transaction because $criteria could contain info
            // for more than one table (I guess, conceivably)
            $con->beginTransaction();
            $pk = BasePeer::doInsert($criteria, $con);
            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $pk;
    }

    /**
     * Performs an UPDATE on the database, given a Node or Criteria object.
     *
     * @param      mixed $values Criteria or Node object containing data that is used to create the UPDATE statement.
     * @param      PropelPDO $con The connection to use (specify PropelPDO connection object to exert more control over transactions).
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function doUpdate($values, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $selectCriteria = new Criteria(NodePeer::DATABASE_NAME);

        if ($values instanceof Criteria) {
            $criteria = clone $values; // rename for clarity

            $comparison = $criteria->getComparison(NodePeer::ID);
            $value = $criteria->remove(NodePeer::ID);
            if ($value) {
                $selectCriteria->add(NodePeer::ID, $value, $comparison);
            } else {
                $selectCriteria->setPrimaryTableName(NodePeer::TABLE_NAME);
            }

        } else { // $values is Node object
            $criteria = $values->buildCriteria(); // gets full criteria
            $selectCriteria = $values->buildPkeyCriteria(); // gets criteria w/ primary key(s)
        }

        // set the correct dbName
        $criteria->setDbName(NodePeer::DATABASE_NAME);

        return BasePeer::doUpdate($selectCriteria, $criteria, $con);
    }

    /**
     * Deletes all rows from the node table.
     *
     * @param      PropelPDO $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).
     * @throws PropelException
     */
    public static function doDeleteAll(PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += BasePeer::doDeleteAll(NodePeer::TABLE_NAME, $con, NodePeer::DATABASE_NAME);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NodePeer::clearInstancePool();
            NodePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs a DELETE on the database, given a Node or Criteria object OR a primary key value.
     *
     * @param      mixed $values Criteria or Node object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param      PropelPDO $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *				if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, PropelPDO $con = null)
     {
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        if ($values instanceof Criteria) {
            // invalidate the cache for all objects of this type, since we have no
            // way of knowing (without running a query) what objects should be invalidated
            // from the cache based on this Criteria.
            NodePeer::clearInstancePool();
            // rename for clarity
            $criteria = clone $values;
        } elseif ($values instanceof Node) { // it's a model object
            // invalidate the cache for this single object
            NodePeer::removeInstanceFromPool($values);
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(NodePeer::DATABASE_NAME);
            $criteria->add(NodePeer::ID, (array) $values, Criteria::IN);
            // invalidate the cache for this object(s)
            foreach ((array) $values as $singleval) {
                NodePeer::removeInstanceFromPool($singleval);
            }
        }

        // Set the correct dbName
        $criteria->setDbName(NodePeer::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();

            $affectedRows += BasePeer::doDelete($criteria, $con);
            NodePeer::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Validates all modified columns of given Node object.
     * If parameter $columns is either a single column name or an array of column names
     * than only those columns are validated.
     *
     * NOTICE: This does not apply to primary or foreign keys for now.
     *
     * @param      Node $obj The object to validate.
     * @param      mixed $cols Column name or array of column names.
     *
     * @return mixed TRUE if all columns are valid or the error message of the first invalid column.
     */
    public static function doValidate($obj, $cols = null)
    {
        $columns = array();

        if ($cols) {
            $dbMap = Propel::getDatabaseMap(NodePeer::DATABASE_NAME);
            $tableMap = $dbMap->getTable(NodePeer::TABLE_NAME);

            if (! is_array($cols)) {
                $cols = array($cols);
            }

            foreach ($cols as $colName) {
                if ($tableMap->hasColumn($colName)) {
                    $get = 'get' . $tableMap->getColumn($colName)->getPhpName();
                    $columns[$colName] = $obj->$get();
                }
            }
        } else {

        }

        return BasePeer::doValidate(NodePeer::DATABASE_NAME, NodePeer::TABLE_NAME, $columns);
    }

    /**
     * Retrieve a single object by pkey.
     *
     * @param      int $pk the primary key.
     * @param      PropelPDO $con the connection to use
     * @return Node
     */
    public static function retrieveByPK($pk, PropelPDO $con = null)
    {

        if (null !== ($obj = NodePeer::getInstanceFromPool((string) $pk))) {
            return $obj;
        }

        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $criteria = new Criteria(NodePeer::DATABASE_NAME);
        $criteria->add(NodePeer::ID, $pk);

        $v = NodePeer::doSelect($criteria, $con);

        return !empty($v) > 0 ? $v[0] : null;
    }

    /**
     * Retrieve multiple objects by pkey.
     *
     * @param      array $pks List of primary keys
     * @param      PropelPDO $con the connection to use
     * @return Node[]
     * @throws PropelException Any exceptions caught during processing will be
     *		 rethrown wrapped into a PropelException.
     */
    public static function retrieveByPKs($pks, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        $objs = null;
        if (empty($pks)) {
            $objs = array();
        } else {
            $criteria = new Criteria(NodePeer::DATABASE_NAME);
            $criteria->add(NodePeer::ID, $pks, Criteria::IN);
            $objs = NodePeer::doSelect($criteria, $con);
        }

        return $objs;
    }

    // nested_set behavior

    /**
     * Returns the root node for a given scope
     *
     * @param      PropelPDO $con	Connection to use.
     * @return     Node			Propel object for root node
     */
    public static function retrieveRoot(PropelPDO $con = null)
    {
        $c = new Criteria(NodePeer::DATABASE_NAME);
        $c->add(NodePeer::LEFT_COL, 1, Criteria::EQUAL);

        return NodePeer::doSelectOne($c, $con);
    }

    /**
     * Returns the whole tree node for a given scope
     *
     * @param      Criteria $criteria	Optional Criteria to filter the query
     * @param      PropelPDO $con	Connection to use.
     * @return     Node			Propel object for root node
     */
    public static function retrieveTree(Criteria $criteria = null, PropelPDO $con = null)
    {
        if ($criteria === null) {
            $criteria = new Criteria(NodePeer::DATABASE_NAME);
        }
        $criteria->addAscendingOrderByColumn(NodePeer::LEFT_COL);

        return NodePeer::doSelect($criteria, $con);
    }

    /**
     * Tests if node is valid
     *
     * @param      Node $node	Propel object for src node
     * @return     bool
     */
    public static function isValid(Node $node = null)
    {
        if (is_object($node) && $node->getRightValue() > $node->getLeftValue()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Delete an entire tree
     *
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     int  The number of deleted nodes
     */
    public static function deleteTree(PropelPDO $con = null)
    {

        return NodePeer::doDeleteAll($con);
    }

    /**
     * Adds $delta to all L and R values that are >= $first and <= $last.
     * '$delta' can also be negative.
     *
     * @param      int $delta		Value to be shifted by, can be negative
     * @param      int $first		First node to be shifted
     * @param      int $last			Last node to be shifted (optional)
     * @param      PropelPDO $con		Connection to use.
     */
    public static function shiftRLValues($delta, $first, $last = null, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        // Shift left column values
        $whereCriteria = new Criteria(NodePeer::DATABASE_NAME);
        $criterion = $whereCriteria->getNewCriterion(NodePeer::LEFT_COL, $first, Criteria::GREATER_EQUAL);
        if (null !== $last) {
            $criterion->addAnd($whereCriteria->getNewCriterion(NodePeer::LEFT_COL, $last, Criteria::LESS_EQUAL));
        }
        $whereCriteria->add($criterion);

        $valuesCriteria = new Criteria(NodePeer::DATABASE_NAME);
        $valuesCriteria->add(NodePeer::LEFT_COL, array('raw' => NodePeer::LEFT_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        BasePeer::doUpdate($whereCriteria, $valuesCriteria, $con);

        // Shift right column values
        $whereCriteria = new Criteria(NodePeer::DATABASE_NAME);
        $criterion = $whereCriteria->getNewCriterion(NodePeer::RIGHT_COL, $first, Criteria::GREATER_EQUAL);
        if (null !== $last) {
            $criterion->addAnd($whereCriteria->getNewCriterion(NodePeer::RIGHT_COL, $last, Criteria::LESS_EQUAL));
        }
        $whereCriteria->add($criterion);

        $valuesCriteria = new Criteria(NodePeer::DATABASE_NAME);
        $valuesCriteria->add(NodePeer::RIGHT_COL, array('raw' => NodePeer::RIGHT_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        BasePeer::doUpdate($whereCriteria, $valuesCriteria, $con);
    }

    /**
     * Adds $delta to level for nodes having left value >= $first and right value <= $last.
     * '$delta' can also be negative.
     *
     * @param      int $delta		Value to be shifted by, can be negative
     * @param      int $first		First node to be shifted
     * @param      int $last			Last node to be shifted
     * @param      PropelPDO $con		Connection to use.
     */
    public static function shiftLevel($delta, $first, $last, PropelPDO $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $whereCriteria = new Criteria(NodePeer::DATABASE_NAME);
        $whereCriteria->add(NodePeer::LEFT_COL, $first, Criteria::GREATER_EQUAL);
        $whereCriteria->add(NodePeer::RIGHT_COL, $last, Criteria::LESS_EQUAL);

        $valuesCriteria = new Criteria(NodePeer::DATABASE_NAME);
        $valuesCriteria->add(NodePeer::LEVEL_COL, array('raw' => NodePeer::LEVEL_COL . ' + ?', 'value' => $delta), Criteria::CUSTOM_EQUAL);

        BasePeer::doUpdate($whereCriteria, $valuesCriteria, $con);
    }

    /**
     * Reload all already loaded nodes to sync them with updated db
     *
     * @param      Node $prune		Object to prune from the update
     * @param      PropelPDO $con		Connection to use.
     */
    public static function updateLoadedNodes($prune = null, PropelPDO $con = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            $keys = array();
            foreach (NodePeer::$instances as $obj) {
                if (!$prune || !$prune->equals($obj)) {
                    $keys[] = $obj->getPrimaryKey();
                }
            }

            if (!empty($keys)) {
                // We don't need to alter the object instance pool; we're just modifying these ones
                // already in the pool.
                $criteria = new Criteria(NodePeer::DATABASE_NAME);
                $criteria->add(NodePeer::ID, $keys, Criteria::IN);
                $stmt = NodePeer::doSelectStmt($criteria, $con);
                while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
                    $key = NodePeer::getPrimaryKeyHashFromRow($row, 0);
                    if (null !== ($object = NodePeer::getInstanceFromPool($key))) {
                        $object->setLeftValue($row[3]);
                        $object->setRightValue($row[4]);
                        $object->setLevel($row[5]);
                        $object->clearNestedSetChildren();
                    }
                }
                $stmt->closeCursor();
            }
        }
    }

    /**
     * Update the tree to allow insertion of a leaf at the specified position
     *
     * @param      int $left	left column value
     * @param      mixed $prune	Object to prune from the shift
     * @param      PropelPDO $con	Connection to use.
     */
    public static function makeRoomForLeaf($left, $prune = null, PropelPDO $con = null)
    {
        // Update database nodes
        NodePeer::shiftRLValues(2, $left, null, $con);

        // Update all loaded nodes
        NodePeer::updateLoadedNodes($prune, $con);
    }

    /**
     * Update the tree to allow insertion of a leaf at the specified position
     *
     * @param      PropelPDO $con	Connection to use.
     */
    public static function fixLevels(PropelPDO $con = null)
    {
        $c = new Criteria();
        $c->addAscendingOrderByColumn(NodePeer::LEFT_COL);
        $stmt = NodePeer::doSelectStmt($c, $con);

        // set the class once to avoid overhead in the loop
        $cls = NodePeer::getOMClass(false);
        $level = null;
        // iterate over the statement
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {

            // hydrate object
            $key = NodePeer::getPrimaryKeyHashFromRow($row, 0);
            if (null === ($obj = NodePeer::getInstanceFromPool($key))) {
                $obj = new $cls();
                $obj->hydrate($row);
                NodePeer::addInstanceToPool($obj, $key);
            }

            // compute level
            // Algorithm shamelessly stolen from sfPropelActAsNestedSetBehaviorPlugin
            // Probably authored by Tristan Rivoallan
            if ($level === null) {
                $level = 0;
                $i = 0;
                $prev = array($obj->getRightValue());
            } else {
                while ($obj->getRightValue() > $prev[$i]) {
                    $i--;
                }
                $level = ++$i;
                $prev[$i] = $obj->getRightValue();
            }

            // update level in node if necessary
            if ($obj->getLevel() !== $level) {
                $obj->setLevel($level);
                $obj->save($con);
            }
        }
        $stmt->closeCursor();
    }

    /**
     * Updates all scope values for items that has negative left (<=0) values.
     *
     * @param      mixed     $scope
     * @param      PropelPDO $con	Connection to use.
     */
    public static function setNegativeScope($scope, PropelPDO $con = null)
    {
        //adjust scope value to $scope
        $whereCriteria = new Criteria(NodePeer::DATABASE_NAME);
        $whereCriteria->add(NodePeer::LEFT_COL, 0, Criteria::LESS_EQUAL);

        $valuesCriteria = new Criteria(NodePeer::DATABASE_NAME);
        $valuesCriteria->add(NodePeer::SCOPE_COL, $scope, Criteria::EQUAL);

        BasePeer::doUpdate($whereCriteria, $valuesCriteria, $con);
    }

} // BaseNodePeer

// This is the static code needed to register the TableMap for this table with the main Propel class.
//
BaseNodePeer::buildTableMap();


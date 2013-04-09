<?php

namespace Kzf\Model\om;

use \Criteria;
use \Exception;
use \ModelCriteria;
use \ModelJoin;
use \PDO;
use \Propel;
use \PropelCollection;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Kzf\Model\Node;
use Kzf\Model\NodePeer;
use Kzf\Model\NodeQuery;

/**
 * Base class that represents a query for the 'node' table.
 *
 *
 *
 * @method NodeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NodeQuery orderByNodMaster($order = Criteria::ASC) Order by the nod_master column
 * @method NodeQuery orderByNodTitle($order = Criteria::ASC) Order by the nod_title column
 * @method NodeQuery orderByNodLeft($order = Criteria::ASC) Order by the nod_left column
 * @method NodeQuery orderByNodRight($order = Criteria::ASC) Order by the nod_right column
 * @method NodeQuery orderByNodLevel($order = Criteria::ASC) Order by the nod_level column
 * @method NodeQuery orderByNodType($order = Criteria::ASC) Order by the nod_type column
 * @method NodeQuery orderByNodCloud($order = Criteria::ASC) Order by the nod_cloud column
 * @method NodeQuery orderByNodVirtual($order = Criteria::ASC) Order by the nod_virtual column
 * @method NodeQuery orderByBchId($order = Criteria::ASC) Order by the bch_id column
 * @method NodeQuery orderByBchParent($order = Criteria::ASC) Order by the bch_parent column
 * @method NodeQuery orderByLefId($order = Criteria::ASC) Order by the lef_id column
 * @method NodeQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method NodeQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method NodeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method NodeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method NodeQuery groupById() Group by the id column
 * @method NodeQuery groupByNodMaster() Group by the nod_master column
 * @method NodeQuery groupByNodTitle() Group by the nod_title column
 * @method NodeQuery groupByNodLeft() Group by the nod_left column
 * @method NodeQuery groupByNodRight() Group by the nod_right column
 * @method NodeQuery groupByNodLevel() Group by the nod_level column
 * @method NodeQuery groupByNodType() Group by the nod_type column
 * @method NodeQuery groupByNodCloud() Group by the nod_cloud column
 * @method NodeQuery groupByNodVirtual() Group by the nod_virtual column
 * @method NodeQuery groupByBchId() Group by the bch_id column
 * @method NodeQuery groupByBchParent() Group by the bch_parent column
 * @method NodeQuery groupByLefId() Group by the lef_id column
 * @method NodeQuery groupByCreatedBy() Group by the created_by column
 * @method NodeQuery groupByUpdatedBy() Group by the updated_by column
 * @method NodeQuery groupByCreatedAt() Group by the created_at column
 * @method NodeQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method NodeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NodeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NodeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NodeQuery leftJoinNodeRelatedByNodMaster($relationAlias = null) Adds a LEFT JOIN clause to the query using the NodeRelatedByNodMaster relation
 * @method NodeQuery rightJoinNodeRelatedByNodMaster($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NodeRelatedByNodMaster relation
 * @method NodeQuery innerJoinNodeRelatedByNodMaster($relationAlias = null) Adds a INNER JOIN clause to the query using the NodeRelatedByNodMaster relation
 *
 * @method NodeQuery leftJoinNodeRelatedById($relationAlias = null) Adds a LEFT JOIN clause to the query using the NodeRelatedById relation
 * @method NodeQuery rightJoinNodeRelatedById($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NodeRelatedById relation
 * @method NodeQuery innerJoinNodeRelatedById($relationAlias = null) Adds a INNER JOIN clause to the query using the NodeRelatedById relation
 *
 * @method Node findOne(PropelPDO $con = null) Return the first Node matching the query
 * @method Node findOneOrCreate(PropelPDO $con = null) Return the first Node matching the query, or a new Node object populated from the query conditions when no match is found
 *
 * @method Node findOneByNodMaster(int $nod_master) Return the first Node filtered by the nod_master column
 * @method Node findOneByNodTitle(string $nod_title) Return the first Node filtered by the nod_title column
 * @method Node findOneByNodLeft(int $nod_left) Return the first Node filtered by the nod_left column
 * @method Node findOneByNodRight(int $nod_right) Return the first Node filtered by the nod_right column
 * @method Node findOneByNodLevel(int $nod_level) Return the first Node filtered by the nod_level column
 * @method Node findOneByNodType(string $nod_type) Return the first Node filtered by the nod_type column
 * @method Node findOneByNodCloud(int $nod_cloud) Return the first Node filtered by the nod_cloud column
 * @method Node findOneByNodVirtual(int $nod_virtual) Return the first Node filtered by the nod_virtual column
 * @method Node findOneByBchId(int $bch_id) Return the first Node filtered by the bch_id column
 * @method Node findOneByBchParent(int $bch_parent) Return the first Node filtered by the bch_parent column
 * @method Node findOneByLefId(int $lef_id) Return the first Node filtered by the lef_id column
 * @method Node findOneByCreatedBy(int $created_by) Return the first Node filtered by the created_by column
 * @method Node findOneByUpdatedBy(int $updated_by) Return the first Node filtered by the updated_by column
 * @method Node findOneByCreatedAt(string $created_at) Return the first Node filtered by the created_at column
 * @method Node findOneByUpdatedAt(string $updated_at) Return the first Node filtered by the updated_at column
 *
 * @method array findById(int $id) Return Node objects filtered by the id column
 * @method array findByNodMaster(int $nod_master) Return Node objects filtered by the nod_master column
 * @method array findByNodTitle(string $nod_title) Return Node objects filtered by the nod_title column
 * @method array findByNodLeft(int $nod_left) Return Node objects filtered by the nod_left column
 * @method array findByNodRight(int $nod_right) Return Node objects filtered by the nod_right column
 * @method array findByNodLevel(int $nod_level) Return Node objects filtered by the nod_level column
 * @method array findByNodType(string $nod_type) Return Node objects filtered by the nod_type column
 * @method array findByNodCloud(int $nod_cloud) Return Node objects filtered by the nod_cloud column
 * @method array findByNodVirtual(int $nod_virtual) Return Node objects filtered by the nod_virtual column
 * @method array findByBchId(int $bch_id) Return Node objects filtered by the bch_id column
 * @method array findByBchParent(int $bch_parent) Return Node objects filtered by the bch_parent column
 * @method array findByLefId(int $lef_id) Return Node objects filtered by the lef_id column
 * @method array findByCreatedBy(int $created_by) Return Node objects filtered by the created_by column
 * @method array findByUpdatedBy(int $updated_by) Return Node objects filtered by the updated_by column
 * @method array findByCreatedAt(string $created_at) Return Node objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Node objects filtered by the updated_at column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseNodeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNodeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kzf', $modelName = 'Kzf\\Model\\Node', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NodeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NodeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NodeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NodeQuery) {
            return $criteria;
        }
        $query = new NodeQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return   Node|Node[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NodePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NodePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Alias of findPk to use instance pooling
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Node A model object, or null if the key is not found
     * @throws PropelException
     */
     public function findOneById($key, $con = null)
     {
        return $this->findPk($key, $con);
     }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 Node A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT id, nod_master, nod_title, nod_left, nod_right, nod_level, nod_type, nod_cloud, nod_virtual, bch_id, bch_parent, lef_id, created_by, updated_by, created_at, updated_at FROM node WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new Node();
            $obj->hydrate($row);
            NodePeer::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return Node|Node[]|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|Node[]|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if ($con === null) {
            $con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $stmt = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($stmt);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NodePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NodePeer::ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id >= 12
     * $query->filterById(array('max' => 12)); // WHERE id <= 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NodePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NodePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the nod_master column
     *
     * Example usage:
     * <code>
     * $query->filterByNodMaster(1234); // WHERE nod_master = 1234
     * $query->filterByNodMaster(array(12, 34)); // WHERE nod_master IN (12, 34)
     * $query->filterByNodMaster(array('min' => 12)); // WHERE nod_master >= 12
     * $query->filterByNodMaster(array('max' => 12)); // WHERE nod_master <= 12
     * </code>
     *
     * @see       filterByNodeRelatedByNodMaster()
     *
     * @param     mixed $nodMaster The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByNodMaster($nodMaster = null, $comparison = null)
    {
        if (is_array($nodMaster)) {
            $useMinMax = false;
            if (isset($nodMaster['min'])) {
                $this->addUsingAlias(NodePeer::NOD_MASTER, $nodMaster['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nodMaster['max'])) {
                $this->addUsingAlias(NodePeer::NOD_MASTER, $nodMaster['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::NOD_MASTER, $nodMaster, $comparison);
    }

    /**
     * Filter the query on the nod_title column
     *
     * Example usage:
     * <code>
     * $query->filterByNodTitle('fooValue');   // WHERE nod_title = 'fooValue'
     * $query->filterByNodTitle('%fooValue%'); // WHERE nod_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nodTitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByNodTitle($nodTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nodTitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nodTitle)) {
                $nodTitle = str_replace('*', '%', $nodTitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NodePeer::NOD_TITLE, $nodTitle, $comparison);
    }

    /**
     * Filter the query on the nod_left column
     *
     * Example usage:
     * <code>
     * $query->filterByNodLeft(1234); // WHERE nod_left = 1234
     * $query->filterByNodLeft(array(12, 34)); // WHERE nod_left IN (12, 34)
     * $query->filterByNodLeft(array('min' => 12)); // WHERE nod_left >= 12
     * $query->filterByNodLeft(array('max' => 12)); // WHERE nod_left <= 12
     * </code>
     *
     * @param     mixed $nodLeft The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByNodLeft($nodLeft = null, $comparison = null)
    {
        if (is_array($nodLeft)) {
            $useMinMax = false;
            if (isset($nodLeft['min'])) {
                $this->addUsingAlias(NodePeer::NOD_LEFT, $nodLeft['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nodLeft['max'])) {
                $this->addUsingAlias(NodePeer::NOD_LEFT, $nodLeft['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::NOD_LEFT, $nodLeft, $comparison);
    }

    /**
     * Filter the query on the nod_right column
     *
     * Example usage:
     * <code>
     * $query->filterByNodRight(1234); // WHERE nod_right = 1234
     * $query->filterByNodRight(array(12, 34)); // WHERE nod_right IN (12, 34)
     * $query->filterByNodRight(array('min' => 12)); // WHERE nod_right >= 12
     * $query->filterByNodRight(array('max' => 12)); // WHERE nod_right <= 12
     * </code>
     *
     * @param     mixed $nodRight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByNodRight($nodRight = null, $comparison = null)
    {
        if (is_array($nodRight)) {
            $useMinMax = false;
            if (isset($nodRight['min'])) {
                $this->addUsingAlias(NodePeer::NOD_RIGHT, $nodRight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nodRight['max'])) {
                $this->addUsingAlias(NodePeer::NOD_RIGHT, $nodRight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::NOD_RIGHT, $nodRight, $comparison);
    }

    /**
     * Filter the query on the nod_level column
     *
     * Example usage:
     * <code>
     * $query->filterByNodLevel(1234); // WHERE nod_level = 1234
     * $query->filterByNodLevel(array(12, 34)); // WHERE nod_level IN (12, 34)
     * $query->filterByNodLevel(array('min' => 12)); // WHERE nod_level >= 12
     * $query->filterByNodLevel(array('max' => 12)); // WHERE nod_level <= 12
     * </code>
     *
     * @param     mixed $nodLevel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByNodLevel($nodLevel = null, $comparison = null)
    {
        if (is_array($nodLevel)) {
            $useMinMax = false;
            if (isset($nodLevel['min'])) {
                $this->addUsingAlias(NodePeer::NOD_LEVEL, $nodLevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nodLevel['max'])) {
                $this->addUsingAlias(NodePeer::NOD_LEVEL, $nodLevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::NOD_LEVEL, $nodLevel, $comparison);
    }

    /**
     * Filter the query on the nod_type column
     *
     * Example usage:
     * <code>
     * $query->filterByNodType('fooValue');   // WHERE nod_type = 'fooValue'
     * $query->filterByNodType('%fooValue%'); // WHERE nod_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nodType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByNodType($nodType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nodType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $nodType)) {
                $nodType = str_replace('*', '%', $nodType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NodePeer::NOD_TYPE, $nodType, $comparison);
    }

    /**
     * Filter the query on the nod_cloud column
     *
     * Example usage:
     * <code>
     * $query->filterByNodCloud(1234); // WHERE nod_cloud = 1234
     * $query->filterByNodCloud(array(12, 34)); // WHERE nod_cloud IN (12, 34)
     * $query->filterByNodCloud(array('min' => 12)); // WHERE nod_cloud >= 12
     * $query->filterByNodCloud(array('max' => 12)); // WHERE nod_cloud <= 12
     * </code>
     *
     * @param     mixed $nodCloud The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByNodCloud($nodCloud = null, $comparison = null)
    {
        if (is_array($nodCloud)) {
            $useMinMax = false;
            if (isset($nodCloud['min'])) {
                $this->addUsingAlias(NodePeer::NOD_CLOUD, $nodCloud['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nodCloud['max'])) {
                $this->addUsingAlias(NodePeer::NOD_CLOUD, $nodCloud['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::NOD_CLOUD, $nodCloud, $comparison);
    }

    /**
     * Filter the query on the nod_virtual column
     *
     * Example usage:
     * <code>
     * $query->filterByNodVirtual(1234); // WHERE nod_virtual = 1234
     * $query->filterByNodVirtual(array(12, 34)); // WHERE nod_virtual IN (12, 34)
     * $query->filterByNodVirtual(array('min' => 12)); // WHERE nod_virtual >= 12
     * $query->filterByNodVirtual(array('max' => 12)); // WHERE nod_virtual <= 12
     * </code>
     *
     * @param     mixed $nodVirtual The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByNodVirtual($nodVirtual = null, $comparison = null)
    {
        if (is_array($nodVirtual)) {
            $useMinMax = false;
            if (isset($nodVirtual['min'])) {
                $this->addUsingAlias(NodePeer::NOD_VIRTUAL, $nodVirtual['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($nodVirtual['max'])) {
                $this->addUsingAlias(NodePeer::NOD_VIRTUAL, $nodVirtual['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::NOD_VIRTUAL, $nodVirtual, $comparison);
    }

    /**
     * Filter the query on the bch_id column
     *
     * Example usage:
     * <code>
     * $query->filterByBchId(1234); // WHERE bch_id = 1234
     * $query->filterByBchId(array(12, 34)); // WHERE bch_id IN (12, 34)
     * $query->filterByBchId(array('min' => 12)); // WHERE bch_id >= 12
     * $query->filterByBchId(array('max' => 12)); // WHERE bch_id <= 12
     * </code>
     *
     * @param     mixed $bchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByBchId($bchId = null, $comparison = null)
    {
        if (is_array($bchId)) {
            $useMinMax = false;
            if (isset($bchId['min'])) {
                $this->addUsingAlias(NodePeer::BCH_ID, $bchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bchId['max'])) {
                $this->addUsingAlias(NodePeer::BCH_ID, $bchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::BCH_ID, $bchId, $comparison);
    }

    /**
     * Filter the query on the bch_parent column
     *
     * Example usage:
     * <code>
     * $query->filterByBchParent(1234); // WHERE bch_parent = 1234
     * $query->filterByBchParent(array(12, 34)); // WHERE bch_parent IN (12, 34)
     * $query->filterByBchParent(array('min' => 12)); // WHERE bch_parent >= 12
     * $query->filterByBchParent(array('max' => 12)); // WHERE bch_parent <= 12
     * </code>
     *
     * @param     mixed $bchParent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByBchParent($bchParent = null, $comparison = null)
    {
        if (is_array($bchParent)) {
            $useMinMax = false;
            if (isset($bchParent['min'])) {
                $this->addUsingAlias(NodePeer::BCH_PARENT, $bchParent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bchParent['max'])) {
                $this->addUsingAlias(NodePeer::BCH_PARENT, $bchParent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::BCH_PARENT, $bchParent, $comparison);
    }

    /**
     * Filter the query on the lef_id column
     *
     * Example usage:
     * <code>
     * $query->filterByLefId(1234); // WHERE lef_id = 1234
     * $query->filterByLefId(array(12, 34)); // WHERE lef_id IN (12, 34)
     * $query->filterByLefId(array('min' => 12)); // WHERE lef_id >= 12
     * $query->filterByLefId(array('max' => 12)); // WHERE lef_id <= 12
     * </code>
     *
     * @param     mixed $lefId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByLefId($lefId = null, $comparison = null)
    {
        if (is_array($lefId)) {
            $useMinMax = false;
            if (isset($lefId['min'])) {
                $this->addUsingAlias(NodePeer::LEF_ID, $lefId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lefId['max'])) {
                $this->addUsingAlias(NodePeer::LEF_ID, $lefId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::LEF_ID, $lefId, $comparison);
    }

    /**
     * Filter the query on the created_by column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedBy(1234); // WHERE created_by = 1234
     * $query->filterByCreatedBy(array(12, 34)); // WHERE created_by IN (12, 34)
     * $query->filterByCreatedBy(array('min' => 12)); // WHERE created_by >= 12
     * $query->filterByCreatedBy(array('max' => 12)); // WHERE created_by <= 12
     * </code>
     *
     * @param     mixed $createdBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(NodePeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(NodePeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::CREATED_BY, $createdBy, $comparison);
    }

    /**
     * Filter the query on the updated_by column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedBy(1234); // WHERE updated_by = 1234
     * $query->filterByUpdatedBy(array(12, 34)); // WHERE updated_by IN (12, 34)
     * $query->filterByUpdatedBy(array('min' => 12)); // WHERE updated_by >= 12
     * $query->filterByUpdatedBy(array('max' => 12)); // WHERE updated_by <= 12
     * </code>
     *
     * @param     mixed $updatedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(NodePeer::UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(NodePeer::UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::UPDATED_BY, $updatedBy, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(NodePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NodePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(NodePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NodePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Node object
     *
     * @param   Node|PropelObjectCollection $node The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NodeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNodeRelatedByNodMaster($node, $comparison = null)
    {
        if ($node instanceof Node) {
            return $this
                ->addUsingAlias(NodePeer::NOD_MASTER, $node->getId(), $comparison);
        } elseif ($node instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NodePeer::NOD_MASTER, $node->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByNodeRelatedByNodMaster() only accepts arguments of type Node or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NodeRelatedByNodMaster relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function joinNodeRelatedByNodMaster($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NodeRelatedByNodMaster');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'NodeRelatedByNodMaster');
        }

        return $this;
    }

    /**
     * Use the NodeRelatedByNodMaster relation Node object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\NodeQuery A secondary query class using the current class as primary query
     */
    public function useNodeRelatedByNodMasterQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNodeRelatedByNodMaster($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NodeRelatedByNodMaster', '\Kzf\Model\NodeQuery');
    }

    /**
     * Filter the query by a related Node object
     *
     * @param   Node|PropelObjectCollection $node  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NodeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByNodeRelatedById($node, $comparison = null)
    {
        if ($node instanceof Node) {
            return $this
                ->addUsingAlias(NodePeer::ID, $node->getNodMaster(), $comparison);
        } elseif ($node instanceof PropelObjectCollection) {
            return $this
                ->useNodeRelatedByIdQuery()
                ->filterByPrimaryKeys($node->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByNodeRelatedById() only accepts arguments of type Node or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the NodeRelatedById relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function joinNodeRelatedById($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('NodeRelatedById');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'NodeRelatedById');
        }

        return $this;
    }

    /**
     * Use the NodeRelatedById relation Node object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\NodeQuery A secondary query class using the current class as primary query
     */
    public function useNodeRelatedByIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinNodeRelatedById($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'NodeRelatedById', '\Kzf\Model\NodeQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Node $node Object to remove from the list of results
     *
     * @return NodeQuery The current query, for fluid interface
     */
    public function prune($node = null)
    {
        if ($node) {
            $this->addUsingAlias(NodePeer::ID, $node->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     NodeQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(NodePeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     NodeQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(NodePeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     NodeQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(NodePeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     NodeQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(NodePeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     NodeQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(NodePeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     NodeQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(NodePeer::CREATED_AT);
    }
    // nested_set behavior

    /**
     * Filter the query to restrict the result to descendants of an object
     *
     * @param     Node $node The object to use for descendant search
     *
     * @return    NodeQuery The current query, for fluid interface
     */
    public function descendantsOf($node)
    {
        return $this
            ->addUsingAlias(NodePeer::LEFT_COL, $node->getLeftValue(), Criteria::GREATER_THAN)
            ->addUsingAlias(NodePeer::LEFT_COL, $node->getRightValue(), Criteria::LESS_THAN);
    }

    /**
     * Filter the query to restrict the result to the branch of an object.
     * Same as descendantsOf(), except that it includes the object passed as parameter in the result
     *
     * @param     Node $node The object to use for branch search
     *
     * @return    NodeQuery The current query, for fluid interface
     */
    public function branchOf($node)
    {
        return $this
            ->addUsingAlias(NodePeer::LEFT_COL, $node->getLeftValue(), Criteria::GREATER_EQUAL)
            ->addUsingAlias(NodePeer::LEFT_COL, $node->getRightValue(), Criteria::LESS_EQUAL);
    }

    /**
     * Filter the query to restrict the result to children of an object
     *
     * @param     Node $node The object to use for child search
     *
     * @return    NodeQuery The current query, for fluid interface
     */
    public function childrenOf($node)
    {
        return $this
            ->descendantsOf($node)
            ->addUsingAlias(NodePeer::LEVEL_COL, $node->getLevel() + 1, Criteria::EQUAL);
    }

    /**
     * Filter the query to restrict the result to siblings of an object.
     * The result does not include the object passed as parameter.
     *
     * @param     Node $node The object to use for sibling search
     * @param      PropelPDO $con Connection to use.
     *
     * @return    NodeQuery The current query, for fluid interface
     */
    public function siblingsOf($node, PropelPDO $con = null)
    {
        if ($node->isRoot()) {
            return $this->
                add(NodePeer::LEVEL_COL, '1<>1', Criteria::CUSTOM);
        } else {
            return $this
                ->childrenOf($node->getParent($con))
                ->prune($node);
        }
    }

    /**
     * Filter the query to restrict the result to ancestors of an object
     *
     * @param     Node $node The object to use for ancestors search
     *
     * @return    NodeQuery The current query, for fluid interface
     */
    public function ancestorsOf($node)
    {
        return $this
            ->addUsingAlias(NodePeer::LEFT_COL, $node->getLeftValue(), Criteria::LESS_THAN)
            ->addUsingAlias(NodePeer::RIGHT_COL, $node->getRightValue(), Criteria::GREATER_THAN);
    }

    /**
     * Filter the query to restrict the result to roots of an object.
     * Same as ancestorsOf(), except that it includes the object passed as parameter in the result
     *
     * @param     Node $node The object to use for roots search
     *
     * @return    NodeQuery The current query, for fluid interface
     */
    public function rootsOf($node)
    {
        return $this
            ->addUsingAlias(NodePeer::LEFT_COL, $node->getLeftValue(), Criteria::LESS_EQUAL)
            ->addUsingAlias(NodePeer::RIGHT_COL, $node->getRightValue(), Criteria::GREATER_EQUAL);
    }

    /**
     * Order the result by branch, i.e. natural tree order
     *
     * @param     bool $reverse if true, reverses the order
     *
     * @return    NodeQuery The current query, for fluid interface
     */
    public function orderByBranch($reverse = false)
    {
        if ($reverse) {
            return $this
                ->addDescendingOrderByColumn(NodePeer::LEFT_COL);
        } else {
            return $this
                ->addAscendingOrderByColumn(NodePeer::LEFT_COL);
        }
    }

    /**
     * Order the result by level, the closer to the root first
     *
     * @param     bool $reverse if true, reverses the order
     *
     * @return    NodeQuery The current query, for fluid interface
     */
    public function orderByLevel($reverse = false)
    {
        if ($reverse) {
            return $this
                ->addAscendingOrderByColumn(NodePeer::RIGHT_COL);
        } else {
            return $this
                ->addDescendingOrderByColumn(NodePeer::RIGHT_COL);
        }
    }

    /**
     * Returns the root node for the tree
     *
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     Node The tree root object
     */
    public function findRoot($con = null)
    {
        return $this
            ->addUsingAlias(NodePeer::LEFT_COL, 1, Criteria::EQUAL)
            ->findOne($con);
    }

    /**
     * Returns the tree of objects
     *
     * @param      PropelPDO $con	Connection to use.
     *
     * @return     mixed the list of results, formatted by the current formatter
     */
    public function findTree($con = null)
    {
        return $this
            ->orderByBranch()
            ->find($con);
    }

}

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
use Kzf\Model\Branch;
use Kzf\Model\Leaf;
use Kzf\Model\NodeTree;
use Kzf\Model\NodeTreePeer;
use Kzf\Model\NodeTreeQuery;
use Kzf\Model\User;

/**
 * Base class that represents a query for the 'node_tree' table.
 *
 *
 *
 * @method NodeTreeQuery orderById($order = Criteria::ASC) Order by the id column
 * @method NodeTreeQuery orderByNdtId($order = Criteria::ASC) Order by the ndt_id column
 * @method NodeTreeQuery orderByNdtPosition($order = Criteria::ASC) Order by the ndt_position column
 * @method NodeTreeQuery orderByNdtLeft($order = Criteria::ASC) Order by the ndt_left column
 * @method NodeTreeQuery orderByNdtRight($order = Criteria::ASC) Order by the ndt_right column
 * @method NodeTreeQuery orderByNdtLevel($order = Criteria::ASC) Order by the ndt_level column
 * @method NodeTreeQuery orderByNdtTitle($order = Criteria::ASC) Order by the ndt_title column
 * @method NodeTreeQuery orderByNdtType($order = Criteria::ASC) Order by the ndt_type column
 * @method NodeTreeQuery orderByNdtCloud($order = Criteria::ASC) Order by the ndt_cloud column
 * @method NodeTreeQuery orderByNdtVirtual($order = Criteria::ASC) Order by the ndt_virtual column
 * @method NodeTreeQuery orderByBchId($order = Criteria::ASC) Order by the bch_id column
 * @method NodeTreeQuery orderByBchParent($order = Criteria::ASC) Order by the bch_parent column
 * @method NodeTreeQuery orderByLefId($order = Criteria::ASC) Order by the lef_id column
 * @method NodeTreeQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method NodeTreeQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method NodeTreeQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method NodeTreeQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method NodeTreeQuery groupById() Group by the id column
 * @method NodeTreeQuery groupByNdtId() Group by the ndt_id column
 * @method NodeTreeQuery groupByNdtPosition() Group by the ndt_position column
 * @method NodeTreeQuery groupByNdtLeft() Group by the ndt_left column
 * @method NodeTreeQuery groupByNdtRight() Group by the ndt_right column
 * @method NodeTreeQuery groupByNdtLevel() Group by the ndt_level column
 * @method NodeTreeQuery groupByNdtTitle() Group by the ndt_title column
 * @method NodeTreeQuery groupByNdtType() Group by the ndt_type column
 * @method NodeTreeQuery groupByNdtCloud() Group by the ndt_cloud column
 * @method NodeTreeQuery groupByNdtVirtual() Group by the ndt_virtual column
 * @method NodeTreeQuery groupByBchId() Group by the bch_id column
 * @method NodeTreeQuery groupByBchParent() Group by the bch_parent column
 * @method NodeTreeQuery groupByLefId() Group by the lef_id column
 * @method NodeTreeQuery groupByCreatedBy() Group by the created_by column
 * @method NodeTreeQuery groupByCreatedAt() Group by the created_at column
 * @method NodeTreeQuery groupByUpdatedBy() Group by the updated_by column
 * @method NodeTreeQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method NodeTreeQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method NodeTreeQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method NodeTreeQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method NodeTreeQuery leftJoinUserRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method NodeTreeQuery rightJoinUserRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method NodeTreeQuery innerJoinUserRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCreatedBy relation
 *
 * @method NodeTreeQuery leftJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method NodeTreeQuery rightJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method NodeTreeQuery innerJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUpdatedBy relation
 *
 * @method NodeTreeQuery leftJoinLeaf($relationAlias = null) Adds a LEFT JOIN clause to the query using the Leaf relation
 * @method NodeTreeQuery rightJoinLeaf($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Leaf relation
 * @method NodeTreeQuery innerJoinLeaf($relationAlias = null) Adds a INNER JOIN clause to the query using the Leaf relation
 *
 * @method NodeTreeQuery leftJoinBranchRelatedByBchId($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchRelatedByBchId relation
 * @method NodeTreeQuery rightJoinBranchRelatedByBchId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchRelatedByBchId relation
 * @method NodeTreeQuery innerJoinBranchRelatedByBchId($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchRelatedByBchId relation
 *
 * @method NodeTreeQuery leftJoinBranchRelatedByBchParent($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchRelatedByBchParent relation
 * @method NodeTreeQuery rightJoinBranchRelatedByBchParent($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchRelatedByBchParent relation
 * @method NodeTreeQuery innerJoinBranchRelatedByBchParent($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchRelatedByBchParent relation
 *
 * @method NodeTree findOne(PropelPDO $con = null) Return the first NodeTree matching the query
 * @method NodeTree findOneOrCreate(PropelPDO $con = null) Return the first NodeTree matching the query, or a new NodeTree object populated from the query conditions when no match is found
 *
 * @method NodeTree findOneByNdtId(int $ndt_id) Return the first NodeTree filtered by the ndt_id column
 * @method NodeTree findOneByNdtPosition(int $ndt_position) Return the first NodeTree filtered by the ndt_position column
 * @method NodeTree findOneByNdtLeft(int $ndt_left) Return the first NodeTree filtered by the ndt_left column
 * @method NodeTree findOneByNdtRight(int $ndt_right) Return the first NodeTree filtered by the ndt_right column
 * @method NodeTree findOneByNdtLevel(int $ndt_level) Return the first NodeTree filtered by the ndt_level column
 * @method NodeTree findOneByNdtTitle(string $ndt_title) Return the first NodeTree filtered by the ndt_title column
 * @method NodeTree findOneByNdtType(string $ndt_type) Return the first NodeTree filtered by the ndt_type column
 * @method NodeTree findOneByNdtCloud(boolean $ndt_cloud) Return the first NodeTree filtered by the ndt_cloud column
 * @method NodeTree findOneByNdtVirtual(boolean $ndt_virtual) Return the first NodeTree filtered by the ndt_virtual column
 * @method NodeTree findOneByBchId(int $bch_id) Return the first NodeTree filtered by the bch_id column
 * @method NodeTree findOneByBchParent(int $bch_parent) Return the first NodeTree filtered by the bch_parent column
 * @method NodeTree findOneByLefId(int $lef_id) Return the first NodeTree filtered by the lef_id column
 * @method NodeTree findOneByCreatedBy(int $created_by) Return the first NodeTree filtered by the created_by column
 * @method NodeTree findOneByCreatedAt(string $created_at) Return the first NodeTree filtered by the created_at column
 * @method NodeTree findOneByUpdatedBy(int $updated_by) Return the first NodeTree filtered by the updated_by column
 * @method NodeTree findOneByUpdatedAt(string $updated_at) Return the first NodeTree filtered by the updated_at column
 *
 * @method array findById(int $id) Return NodeTree objects filtered by the id column
 * @method array findByNdtId(int $ndt_id) Return NodeTree objects filtered by the ndt_id column
 * @method array findByNdtPosition(int $ndt_position) Return NodeTree objects filtered by the ndt_position column
 * @method array findByNdtLeft(int $ndt_left) Return NodeTree objects filtered by the ndt_left column
 * @method array findByNdtRight(int $ndt_right) Return NodeTree objects filtered by the ndt_right column
 * @method array findByNdtLevel(int $ndt_level) Return NodeTree objects filtered by the ndt_level column
 * @method array findByNdtTitle(string $ndt_title) Return NodeTree objects filtered by the ndt_title column
 * @method array findByNdtType(string $ndt_type) Return NodeTree objects filtered by the ndt_type column
 * @method array findByNdtCloud(boolean $ndt_cloud) Return NodeTree objects filtered by the ndt_cloud column
 * @method array findByNdtVirtual(boolean $ndt_virtual) Return NodeTree objects filtered by the ndt_virtual column
 * @method array findByBchId(int $bch_id) Return NodeTree objects filtered by the bch_id column
 * @method array findByBchParent(int $bch_parent) Return NodeTree objects filtered by the bch_parent column
 * @method array findByLefId(int $lef_id) Return NodeTree objects filtered by the lef_id column
 * @method array findByCreatedBy(int $created_by) Return NodeTree objects filtered by the created_by column
 * @method array findByCreatedAt(string $created_at) Return NodeTree objects filtered by the created_at column
 * @method array findByUpdatedBy(int $updated_by) Return NodeTree objects filtered by the updated_by column
 * @method array findByUpdatedAt(string $updated_at) Return NodeTree objects filtered by the updated_at column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseNodeTreeQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseNodeTreeQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kzf', $modelName = 'Kzf\\Model\\NodeTree', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new NodeTreeQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   NodeTreeQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return NodeTreeQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof NodeTreeQuery) {
            return $criteria;
        }
        $query = new NodeTreeQuery();
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
     * @return   NodeTree|NodeTree[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NodeTreePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(NodeTreePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 NodeTree A model object, or null if the key is not found
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
     * @return                 NodeTree A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT id, ndt_id, ndt_position, ndt_left, ndt_right, ndt_level, ndt_title, ndt_type, ndt_cloud, ndt_virtual, bch_id, bch_parent, lef_id, created_by, created_at, updated_by, updated_at FROM node_tree WHERE id = :p0';
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
            $obj = new NodeTree();
            $obj->hydrate($row);
            NodeTreePeer::addInstanceToPool($obj, (string) $key);
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
     * @return NodeTree|NodeTree[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|NodeTree[]|mixed the list of results, formatted by the current formatter
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
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NodeTreePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NodeTreePeer::ID, $keys, Criteria::IN);
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
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NodeTreePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NodeTreePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the ndt_id column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtId(1234); // WHERE ndt_id = 1234
     * $query->filterByNdtId(array(12, 34)); // WHERE ndt_id IN (12, 34)
     * $query->filterByNdtId(array('min' => 12)); // WHERE ndt_id >= 12
     * $query->filterByNdtId(array('max' => 12)); // WHERE ndt_id <= 12
     * </code>
     *
     * @param     mixed $ndtId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtId($ndtId = null, $comparison = null)
    {
        if (is_array($ndtId)) {
            $useMinMax = false;
            if (isset($ndtId['min'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_ID, $ndtId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ndtId['max'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_ID, $ndtId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_ID, $ndtId, $comparison);
    }

    /**
     * Filter the query on the ndt_position column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtPosition(1234); // WHERE ndt_position = 1234
     * $query->filterByNdtPosition(array(12, 34)); // WHERE ndt_position IN (12, 34)
     * $query->filterByNdtPosition(array('min' => 12)); // WHERE ndt_position >= 12
     * $query->filterByNdtPosition(array('max' => 12)); // WHERE ndt_position <= 12
     * </code>
     *
     * @param     mixed $ndtPosition The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtPosition($ndtPosition = null, $comparison = null)
    {
        if (is_array($ndtPosition)) {
            $useMinMax = false;
            if (isset($ndtPosition['min'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_POSITION, $ndtPosition['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ndtPosition['max'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_POSITION, $ndtPosition['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_POSITION, $ndtPosition, $comparison);
    }

    /**
     * Filter the query on the ndt_left column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtLeft(1234); // WHERE ndt_left = 1234
     * $query->filterByNdtLeft(array(12, 34)); // WHERE ndt_left IN (12, 34)
     * $query->filterByNdtLeft(array('min' => 12)); // WHERE ndt_left >= 12
     * $query->filterByNdtLeft(array('max' => 12)); // WHERE ndt_left <= 12
     * </code>
     *
     * @param     mixed $ndtLeft The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtLeft($ndtLeft = null, $comparison = null)
    {
        if (is_array($ndtLeft)) {
            $useMinMax = false;
            if (isset($ndtLeft['min'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_LEFT, $ndtLeft['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ndtLeft['max'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_LEFT, $ndtLeft['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_LEFT, $ndtLeft, $comparison);
    }

    /**
     * Filter the query on the ndt_right column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtRight(1234); // WHERE ndt_right = 1234
     * $query->filterByNdtRight(array(12, 34)); // WHERE ndt_right IN (12, 34)
     * $query->filterByNdtRight(array('min' => 12)); // WHERE ndt_right >= 12
     * $query->filterByNdtRight(array('max' => 12)); // WHERE ndt_right <= 12
     * </code>
     *
     * @param     mixed $ndtRight The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtRight($ndtRight = null, $comparison = null)
    {
        if (is_array($ndtRight)) {
            $useMinMax = false;
            if (isset($ndtRight['min'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_RIGHT, $ndtRight['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ndtRight['max'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_RIGHT, $ndtRight['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_RIGHT, $ndtRight, $comparison);
    }

    /**
     * Filter the query on the ndt_level column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtLevel(1234); // WHERE ndt_level = 1234
     * $query->filterByNdtLevel(array(12, 34)); // WHERE ndt_level IN (12, 34)
     * $query->filterByNdtLevel(array('min' => 12)); // WHERE ndt_level >= 12
     * $query->filterByNdtLevel(array('max' => 12)); // WHERE ndt_level <= 12
     * </code>
     *
     * @param     mixed $ndtLevel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtLevel($ndtLevel = null, $comparison = null)
    {
        if (is_array($ndtLevel)) {
            $useMinMax = false;
            if (isset($ndtLevel['min'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_LEVEL, $ndtLevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ndtLevel['max'])) {
                $this->addUsingAlias(NodeTreePeer::NDT_LEVEL, $ndtLevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_LEVEL, $ndtLevel, $comparison);
    }

    /**
     * Filter the query on the ndt_title column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtTitle('fooValue');   // WHERE ndt_title = 'fooValue'
     * $query->filterByNdtTitle('%fooValue%'); // WHERE ndt_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ndtTitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtTitle($ndtTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ndtTitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ndtTitle)) {
                $ndtTitle = str_replace('*', '%', $ndtTitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_TITLE, $ndtTitle, $comparison);
    }

    /**
     * Filter the query on the ndt_type column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtType('fooValue');   // WHERE ndt_type = 'fooValue'
     * $query->filterByNdtType('%fooValue%'); // WHERE ndt_type LIKE '%fooValue%'
     * </code>
     *
     * @param     string $ndtType The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtType($ndtType = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($ndtType)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $ndtType)) {
                $ndtType = str_replace('*', '%', $ndtType);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_TYPE, $ndtType, $comparison);
    }

    /**
     * Filter the query on the ndt_cloud column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtCloud(true); // WHERE ndt_cloud = true
     * $query->filterByNdtCloud('yes'); // WHERE ndt_cloud = true
     * </code>
     *
     * @param     boolean|string $ndtCloud The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtCloud($ndtCloud = null, $comparison = null)
    {
        if (is_string($ndtCloud)) {
            $ndtCloud = in_array(strtolower($ndtCloud), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_CLOUD, $ndtCloud, $comparison);
    }

    /**
     * Filter the query on the ndt_virtual column
     *
     * Example usage:
     * <code>
     * $query->filterByNdtVirtual(true); // WHERE ndt_virtual = true
     * $query->filterByNdtVirtual('yes'); // WHERE ndt_virtual = true
     * </code>
     *
     * @param     boolean|string $ndtVirtual The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByNdtVirtual($ndtVirtual = null, $comparison = null)
    {
        if (is_string($ndtVirtual)) {
            $ndtVirtual = in_array(strtolower($ndtVirtual), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(NodeTreePeer::NDT_VIRTUAL, $ndtVirtual, $comparison);
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
     * @see       filterByBranchRelatedByBchId()
     *
     * @param     mixed $bchId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByBchId($bchId = null, $comparison = null)
    {
        if (is_array($bchId)) {
            $useMinMax = false;
            if (isset($bchId['min'])) {
                $this->addUsingAlias(NodeTreePeer::BCH_ID, $bchId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bchId['max'])) {
                $this->addUsingAlias(NodeTreePeer::BCH_ID, $bchId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::BCH_ID, $bchId, $comparison);
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
     * @see       filterByBranchRelatedByBchParent()
     *
     * @param     mixed $bchParent The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByBchParent($bchParent = null, $comparison = null)
    {
        if (is_array($bchParent)) {
            $useMinMax = false;
            if (isset($bchParent['min'])) {
                $this->addUsingAlias(NodeTreePeer::BCH_PARENT, $bchParent['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bchParent['max'])) {
                $this->addUsingAlias(NodeTreePeer::BCH_PARENT, $bchParent['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::BCH_PARENT, $bchParent, $comparison);
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
     * @see       filterByLeaf()
     *
     * @param     mixed $lefId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByLefId($lefId = null, $comparison = null)
    {
        if (is_array($lefId)) {
            $useMinMax = false;
            if (isset($lefId['min'])) {
                $this->addUsingAlias(NodeTreePeer::LEF_ID, $lefId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lefId['max'])) {
                $this->addUsingAlias(NodeTreePeer::LEF_ID, $lefId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::LEF_ID, $lefId, $comparison);
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
     * @see       filterByUserRelatedByCreatedBy()
     *
     * @param     mixed $createdBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(NodeTreePeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(NodeTreePeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::CREATED_BY, $createdBy, $comparison);
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
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(NodeTreePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(NodeTreePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::CREATED_AT, $createdAt, $comparison);
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
     * @see       filterByUserRelatedByUpdatedBy()
     *
     * @param     mixed $updatedBy The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(NodeTreePeer::UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(NodeTreePeer::UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::UPDATED_BY, $updatedBy, $comparison);
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
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(NodeTreePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(NodeTreePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NodeTreePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NodeTreeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByCreatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(NodeTreePeer::CREATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NodeTreePeer::CREATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByCreatedBy() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function joinUserRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'UserRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByCreatedBy relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByCreatedBy', '\Kzf\Model\UserQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NodeTreeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUpdatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(NodeTreePeer::UPDATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NodeTreePeer::UPDATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByUserRelatedByUpdatedBy() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function joinUserRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'UserRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the UserRelatedByUpdatedBy relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedByUpdatedBy', '\Kzf\Model\UserQuery');
    }

    /**
     * Filter the query by a related Leaf object
     *
     * @param   Leaf|PropelObjectCollection $leaf The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NodeTreeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeaf($leaf, $comparison = null)
    {
        if ($leaf instanceof Leaf) {
            return $this
                ->addUsingAlias(NodeTreePeer::LEF_ID, $leaf->getId(), $comparison);
        } elseif ($leaf instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NodeTreePeer::LEF_ID, $leaf->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByLeaf() only accepts arguments of type Leaf or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Leaf relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function joinLeaf($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Leaf');

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
            $this->addJoinObject($join, 'Leaf');
        }

        return $this;
    }

    /**
     * Use the Leaf relation Leaf object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\LeafQuery A secondary query class using the current class as primary query
     */
    public function useLeafQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeaf($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Leaf', '\Kzf\Model\LeafQuery');
    }

    /**
     * Filter the query by a related Branch object
     *
     * @param   Branch|PropelObjectCollection $branch The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NodeTreeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBranchRelatedByBchId($branch, $comparison = null)
    {
        if ($branch instanceof Branch) {
            return $this
                ->addUsingAlias(NodeTreePeer::BCH_ID, $branch->getId(), $comparison);
        } elseif ($branch instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NodeTreePeer::BCH_ID, $branch->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBranchRelatedByBchId() only accepts arguments of type Branch or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BranchRelatedByBchId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function joinBranchRelatedByBchId($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BranchRelatedByBchId');

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
            $this->addJoinObject($join, 'BranchRelatedByBchId');
        }

        return $this;
    }

    /**
     * Use the BranchRelatedByBchId relation Branch object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\BranchQuery A secondary query class using the current class as primary query
     */
    public function useBranchRelatedByBchIdQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBranchRelatedByBchId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BranchRelatedByBchId', '\Kzf\Model\BranchQuery');
    }

    /**
     * Filter the query by a related Branch object
     *
     * @param   Branch|PropelObjectCollection $branch The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 NodeTreeQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBranchRelatedByBchParent($branch, $comparison = null)
    {
        if ($branch instanceof Branch) {
            return $this
                ->addUsingAlias(NodeTreePeer::BCH_PARENT, $branch->getId(), $comparison);
        } elseif ($branch instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(NodeTreePeer::BCH_PARENT, $branch->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByBranchRelatedByBchParent() only accepts arguments of type Branch or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BranchRelatedByBchParent relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function joinBranchRelatedByBchParent($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BranchRelatedByBchParent');

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
            $this->addJoinObject($join, 'BranchRelatedByBchParent');
        }

        return $this;
    }

    /**
     * Use the BranchRelatedByBchParent relation Branch object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\BranchQuery A secondary query class using the current class as primary query
     */
    public function useBranchRelatedByBchParentQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBranchRelatedByBchParent($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BranchRelatedByBchParent', '\Kzf\Model\BranchQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   NodeTree $nodeTree Object to remove from the list of results
     *
     * @return NodeTreeQuery The current query, for fluid interface
     */
    public function prune($nodeTree = null)
    {
        if ($nodeTree) {
            $this->addUsingAlias(NodeTreePeer::ID, $nodeTree->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

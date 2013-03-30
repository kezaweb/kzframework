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
use Kzf\Model\RulOption;
use Kzf\Model\RulOptionPeer;
use Kzf\Model\RulOptionQuery;
use Kzf\Model\Rule;
use Kzf\Model\User;

/**
 * Base class that represents a query for the 'rul_option' table.
 *
 *
 *
 * @method RulOptionQuery orderById($order = Criteria::ASC) Order by the id column
 * @method RulOptionQuery orderByRouName($order = Criteria::ASC) Order by the rou_name column
 * @method RulOptionQuery orderByRouDesc($order = Criteria::ASC) Order by the rou_desc column
 * @method RulOptionQuery orderByRouDefaultValue($order = Criteria::ASC) Order by the rou_default_value column
 * @method RulOptionQuery orderByRouPattern($order = Criteria::ASC) Order by the rou_pattern column
 * @method RulOptionQuery orderByRulId($order = Criteria::ASC) Order by the rul_id column
 * @method RulOptionQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method RulOptionQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method RulOptionQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method RulOptionQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method RulOptionQuery groupById() Group by the id column
 * @method RulOptionQuery groupByRouName() Group by the rou_name column
 * @method RulOptionQuery groupByRouDesc() Group by the rou_desc column
 * @method RulOptionQuery groupByRouDefaultValue() Group by the rou_default_value column
 * @method RulOptionQuery groupByRouPattern() Group by the rou_pattern column
 * @method RulOptionQuery groupByRulId() Group by the rul_id column
 * @method RulOptionQuery groupByCreatedBy() Group by the created_by column
 * @method RulOptionQuery groupByUpdatedBy() Group by the updated_by column
 * @method RulOptionQuery groupByCreatedAt() Group by the created_at column
 * @method RulOptionQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method RulOptionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RulOptionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RulOptionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RulOptionQuery leftJoinRule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rule relation
 * @method RulOptionQuery rightJoinRule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rule relation
 * @method RulOptionQuery innerJoinRule($relationAlias = null) Adds a INNER JOIN clause to the query using the Rule relation
 *
 * @method RulOptionQuery leftJoinUserRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method RulOptionQuery rightJoinUserRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method RulOptionQuery innerJoinUserRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCreatedBy relation
 *
 * @method RulOptionQuery leftJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method RulOptionQuery rightJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method RulOptionQuery innerJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUpdatedBy relation
 *
 * @method RulOption findOne(PropelPDO $con = null) Return the first RulOption matching the query
 * @method RulOption findOneOrCreate(PropelPDO $con = null) Return the first RulOption matching the query, or a new RulOption object populated from the query conditions when no match is found
 *
 * @method RulOption findOneByRouName(string $rou_name) Return the first RulOption filtered by the rou_name column
 * @method RulOption findOneByRouDesc(string $rou_desc) Return the first RulOption filtered by the rou_desc column
 * @method RulOption findOneByRouDefaultValue(string $rou_default_value) Return the first RulOption filtered by the rou_default_value column
 * @method RulOption findOneByRouPattern(string $rou_pattern) Return the first RulOption filtered by the rou_pattern column
 * @method RulOption findOneByRulId(int $rul_id) Return the first RulOption filtered by the rul_id column
 * @method RulOption findOneByCreatedBy(int $created_by) Return the first RulOption filtered by the created_by column
 * @method RulOption findOneByUpdatedBy(int $updated_by) Return the first RulOption filtered by the updated_by column
 * @method RulOption findOneByCreatedAt(string $created_at) Return the first RulOption filtered by the created_at column
 * @method RulOption findOneByUpdatedAt(string $updated_at) Return the first RulOption filtered by the updated_at column
 *
 * @method array findById(int $id) Return RulOption objects filtered by the id column
 * @method array findByRouName(string $rou_name) Return RulOption objects filtered by the rou_name column
 * @method array findByRouDesc(string $rou_desc) Return RulOption objects filtered by the rou_desc column
 * @method array findByRouDefaultValue(string $rou_default_value) Return RulOption objects filtered by the rou_default_value column
 * @method array findByRouPattern(string $rou_pattern) Return RulOption objects filtered by the rou_pattern column
 * @method array findByRulId(int $rul_id) Return RulOption objects filtered by the rul_id column
 * @method array findByCreatedBy(int $created_by) Return RulOption objects filtered by the created_by column
 * @method array findByUpdatedBy(int $updated_by) Return RulOption objects filtered by the updated_by column
 * @method array findByCreatedAt(string $created_at) Return RulOption objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return RulOption objects filtered by the updated_at column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseRulOptionQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRulOptionQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kzf', $modelName = 'Kzf\\Model\\RulOption', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RulOptionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   RulOptionQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RulOptionQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RulOptionQuery) {
            return $criteria;
        }
        $query = new RulOptionQuery();
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
     * @return   RulOption|RulOption[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RulOptionPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RulOptionPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 RulOption A model object, or null if the key is not found
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
     * @return                 RulOption A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT id, rou_name, rou_desc, rou_default_value, rou_pattern, rul_id, created_by, updated_by, created_at, updated_at FROM rul_option WHERE id = :p0';
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
            $obj = new RulOption();
            $obj->hydrate($row);
            RulOptionPeer::addInstanceToPool($obj, (string) $key);
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
     * @return RulOption|RulOption[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|RulOption[]|mixed the list of results, formatted by the current formatter
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
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RulOptionPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RulOptionPeer::ID, $keys, Criteria::IN);
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
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RulOptionPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RulOptionPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the rou_name column
     *
     * Example usage:
     * <code>
     * $query->filterByRouName('fooValue');   // WHERE rou_name = 'fooValue'
     * $query->filterByRouName('%fooValue%'); // WHERE rou_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rouName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByRouName($rouName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rouName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rouName)) {
                $rouName = str_replace('*', '%', $rouName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::ROU_NAME, $rouName, $comparison);
    }

    /**
     * Filter the query on the rou_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByRouDesc('fooValue');   // WHERE rou_desc = 'fooValue'
     * $query->filterByRouDesc('%fooValue%'); // WHERE rou_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rouDesc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByRouDesc($rouDesc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rouDesc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rouDesc)) {
                $rouDesc = str_replace('*', '%', $rouDesc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::ROU_DESC, $rouDesc, $comparison);
    }

    /**
     * Filter the query on the rou_default_value column
     *
     * Example usage:
     * <code>
     * $query->filterByRouDefaultValue('fooValue');   // WHERE rou_default_value = 'fooValue'
     * $query->filterByRouDefaultValue('%fooValue%'); // WHERE rou_default_value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rouDefaultValue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByRouDefaultValue($rouDefaultValue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rouDefaultValue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rouDefaultValue)) {
                $rouDefaultValue = str_replace('*', '%', $rouDefaultValue);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::ROU_DEFAULT_VALUE, $rouDefaultValue, $comparison);
    }

    /**
     * Filter the query on the rou_pattern column
     *
     * Example usage:
     * <code>
     * $query->filterByRouPattern('fooValue');   // WHERE rou_pattern = 'fooValue'
     * $query->filterByRouPattern('%fooValue%'); // WHERE rou_pattern LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rouPattern The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByRouPattern($rouPattern = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rouPattern)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rouPattern)) {
                $rouPattern = str_replace('*', '%', $rouPattern);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::ROU_PATTERN, $rouPattern, $comparison);
    }

    /**
     * Filter the query on the rul_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRulId(1234); // WHERE rul_id = 1234
     * $query->filterByRulId(array(12, 34)); // WHERE rul_id IN (12, 34)
     * $query->filterByRulId(array('min' => 12)); // WHERE rul_id >= 12
     * $query->filterByRulId(array('max' => 12)); // WHERE rul_id <= 12
     * </code>
     *
     * @see       filterByRule()
     *
     * @param     mixed $rulId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByRulId($rulId = null, $comparison = null)
    {
        if (is_array($rulId)) {
            $useMinMax = false;
            if (isset($rulId['min'])) {
                $this->addUsingAlias(RulOptionPeer::RUL_ID, $rulId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rulId['max'])) {
                $this->addUsingAlias(RulOptionPeer::RUL_ID, $rulId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::RUL_ID, $rulId, $comparison);
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
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(RulOptionPeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(RulOptionPeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::CREATED_BY, $createdBy, $comparison);
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
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(RulOptionPeer::UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(RulOptionPeer::UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::UPDATED_BY, $updatedBy, $comparison);
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
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(RulOptionPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RulOptionPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(RulOptionPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RulOptionPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulOptionPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Rule object
     *
     * @param   Rule|PropelObjectCollection $rule The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RulOptionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRule($rule, $comparison = null)
    {
        if ($rule instanceof Rule) {
            return $this
                ->addUsingAlias(RulOptionPeer::RUL_ID, $rule->getId(), $comparison);
        } elseif ($rule instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RulOptionPeer::RUL_ID, $rule->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByRule() only accepts arguments of type Rule or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Rule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function joinRule($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Rule');

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
            $this->addJoinObject($join, 'Rule');
        }

        return $this;
    }

    /**
     * Use the Rule relation Rule object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\RuleQuery A secondary query class using the current class as primary query
     */
    public function useRuleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rule', '\Kzf\Model\RuleQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RulOptionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByCreatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(RulOptionPeer::CREATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RulOptionPeer::CREATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return RulOptionQuery The current query, for fluid interface
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
     * @return                 RulOptionQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUpdatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(RulOptionPeer::UPDATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RulOptionPeer::UPDATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return RulOptionQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   RulOption $rulOption Object to remove from the list of results
     *
     * @return RulOptionQuery The current query, for fluid interface
     */
    public function prune($rulOption = null)
    {
        if ($rulOption) {
            $this->addUsingAlias(RulOptionPeer::ID, $rulOption->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     RulOptionQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(RulOptionPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     RulOptionQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(RulOptionPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     RulOptionQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(RulOptionPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     RulOptionQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(RulOptionPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     RulOptionQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(RulOptionPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     RulOptionQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(RulOptionPeer::CREATED_AT);
    }
}

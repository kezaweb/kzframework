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
use Kzf\Model\BchRul;
use Kzf\Model\LefRul;
use Kzf\Model\RulOption;
use Kzf\Model\Rule;
use Kzf\Model\RulePeer;
use Kzf\Model\RuleQuery;
use Kzf\Model\TypeRule;
use Kzf\Model\User;

/**
 * Base class that represents a query for the 'rule' table.
 *
 *
 *
 * @method RuleQuery orderById($order = Criteria::ASC) Order by the id column
 * @method RuleQuery orderByRulName($order = Criteria::ASC) Order by the rul_name column
 * @method RuleQuery orderByRulDesc($order = Criteria::ASC) Order by the rul_desc column
 * @method RuleQuery orderByRulActif($order = Criteria::ASC) Order by the rul_actif column
 * @method RuleQuery orderByTruId($order = Criteria::ASC) Order by the tru_id column
 * @method RuleQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method RuleQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method RuleQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method RuleQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method RuleQuery groupById() Group by the id column
 * @method RuleQuery groupByRulName() Group by the rul_name column
 * @method RuleQuery groupByRulDesc() Group by the rul_desc column
 * @method RuleQuery groupByRulActif() Group by the rul_actif column
 * @method RuleQuery groupByTruId() Group by the tru_id column
 * @method RuleQuery groupByCreatedBy() Group by the created_by column
 * @method RuleQuery groupByCreatedAt() Group by the created_at column
 * @method RuleQuery groupByUpdatedBy() Group by the updated_by column
 * @method RuleQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method RuleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method RuleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method RuleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method RuleQuery leftJoinTypeRule($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeRule relation
 * @method RuleQuery rightJoinTypeRule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeRule relation
 * @method RuleQuery innerJoinTypeRule($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeRule relation
 *
 * @method RuleQuery leftJoinUserRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method RuleQuery rightJoinUserRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method RuleQuery innerJoinUserRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCreatedBy relation
 *
 * @method RuleQuery leftJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method RuleQuery rightJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method RuleQuery innerJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUpdatedBy relation
 *
 * @method RuleQuery leftJoinBchRul($relationAlias = null) Adds a LEFT JOIN clause to the query using the BchRul relation
 * @method RuleQuery rightJoinBchRul($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BchRul relation
 * @method RuleQuery innerJoinBchRul($relationAlias = null) Adds a INNER JOIN clause to the query using the BchRul relation
 *
 * @method RuleQuery leftJoinLefRul($relationAlias = null) Adds a LEFT JOIN clause to the query using the LefRul relation
 * @method RuleQuery rightJoinLefRul($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LefRul relation
 * @method RuleQuery innerJoinLefRul($relationAlias = null) Adds a INNER JOIN clause to the query using the LefRul relation
 *
 * @method RuleQuery leftJoinRulOption($relationAlias = null) Adds a LEFT JOIN clause to the query using the RulOption relation
 * @method RuleQuery rightJoinRulOption($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RulOption relation
 * @method RuleQuery innerJoinRulOption($relationAlias = null) Adds a INNER JOIN clause to the query using the RulOption relation
 *
 * @method Rule findOne(PropelPDO $con = null) Return the first Rule matching the query
 * @method Rule findOneOrCreate(PropelPDO $con = null) Return the first Rule matching the query, or a new Rule object populated from the query conditions when no match is found
 *
 * @method Rule findOneByRulName(string $rul_name) Return the first Rule filtered by the rul_name column
 * @method Rule findOneByRulDesc(string $rul_desc) Return the first Rule filtered by the rul_desc column
 * @method Rule findOneByRulActif(boolean $rul_actif) Return the first Rule filtered by the rul_actif column
 * @method Rule findOneByTruId(int $tru_id) Return the first Rule filtered by the tru_id column
 * @method Rule findOneByCreatedBy(int $created_by) Return the first Rule filtered by the created_by column
 * @method Rule findOneByCreatedAt(string $created_at) Return the first Rule filtered by the created_at column
 * @method Rule findOneByUpdatedBy(int $updated_by) Return the first Rule filtered by the updated_by column
 * @method Rule findOneByUpdatedAt(string $updated_at) Return the first Rule filtered by the updated_at column
 *
 * @method array findById(int $id) Return Rule objects filtered by the id column
 * @method array findByRulName(string $rul_name) Return Rule objects filtered by the rul_name column
 * @method array findByRulDesc(string $rul_desc) Return Rule objects filtered by the rul_desc column
 * @method array findByRulActif(boolean $rul_actif) Return Rule objects filtered by the rul_actif column
 * @method array findByTruId(int $tru_id) Return Rule objects filtered by the tru_id column
 * @method array findByCreatedBy(int $created_by) Return Rule objects filtered by the created_by column
 * @method array findByCreatedAt(string $created_at) Return Rule objects filtered by the created_at column
 * @method array findByUpdatedBy(int $updated_by) Return Rule objects filtered by the updated_by column
 * @method array findByUpdatedAt(string $updated_at) Return Rule objects filtered by the updated_at column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseRuleQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseRuleQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kzf', $modelName = 'Kzf\\Model\\Rule', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new RuleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   RuleQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return RuleQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof RuleQuery) {
            return $criteria;
        }
        $query = new RuleQuery();
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
     * @return   Rule|Rule[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = RulePeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(RulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Rule A model object, or null if the key is not found
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
     * @return                 Rule A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT id, rul_name, rul_desc, rul_actif, tru_id, created_by, created_at, updated_by, updated_at FROM rule WHERE id = :p0';
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
            $obj = new Rule();
            $obj->hydrate($row);
            RulePeer::addInstanceToPool($obj, (string) $key);
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
     * @return Rule|Rule[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Rule[]|mixed the list of results, formatted by the current formatter
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
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(RulePeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(RulePeer::ID, $keys, Criteria::IN);
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
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(RulePeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(RulePeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulePeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the rul_name column
     *
     * Example usage:
     * <code>
     * $query->filterByRulName('fooValue');   // WHERE rul_name = 'fooValue'
     * $query->filterByRulName('%fooValue%'); // WHERE rul_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rulName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByRulName($rulName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rulName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rulName)) {
                $rulName = str_replace('*', '%', $rulName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RulePeer::RUL_NAME, $rulName, $comparison);
    }

    /**
     * Filter the query on the rul_desc column
     *
     * Example usage:
     * <code>
     * $query->filterByRulDesc('fooValue');   // WHERE rul_desc = 'fooValue'
     * $query->filterByRulDesc('%fooValue%'); // WHERE rul_desc LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rulDesc The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByRulDesc($rulDesc = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rulDesc)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $rulDesc)) {
                $rulDesc = str_replace('*', '%', $rulDesc);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(RulePeer::RUL_DESC, $rulDesc, $comparison);
    }

    /**
     * Filter the query on the rul_actif column
     *
     * Example usage:
     * <code>
     * $query->filterByRulActif(true); // WHERE rul_actif = true
     * $query->filterByRulActif('yes'); // WHERE rul_actif = true
     * </code>
     *
     * @param     boolean|string $rulActif The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByRulActif($rulActif = null, $comparison = null)
    {
        if (is_string($rulActif)) {
            $rulActif = in_array(strtolower($rulActif), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(RulePeer::RUL_ACTIF, $rulActif, $comparison);
    }

    /**
     * Filter the query on the tru_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTruId(1234); // WHERE tru_id = 1234
     * $query->filterByTruId(array(12, 34)); // WHERE tru_id IN (12, 34)
     * $query->filterByTruId(array('min' => 12)); // WHERE tru_id >= 12
     * $query->filterByTruId(array('max' => 12)); // WHERE tru_id <= 12
     * </code>
     *
     * @see       filterByTypeRule()
     *
     * @param     mixed $truId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByTruId($truId = null, $comparison = null)
    {
        if (is_array($truId)) {
            $useMinMax = false;
            if (isset($truId['min'])) {
                $this->addUsingAlias(RulePeer::TRU_ID, $truId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($truId['max'])) {
                $this->addUsingAlias(RulePeer::TRU_ID, $truId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulePeer::TRU_ID, $truId, $comparison);
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
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(RulePeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(RulePeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulePeer::CREATED_BY, $createdBy, $comparison);
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
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(RulePeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(RulePeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulePeer::CREATED_AT, $createdAt, $comparison);
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
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(RulePeer::UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(RulePeer::UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulePeer::UPDATED_BY, $updatedBy, $comparison);
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
     * @return RuleQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(RulePeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(RulePeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(RulePeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related TypeRule object
     *
     * @param   TypeRule|PropelObjectCollection $typeRule The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RuleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTypeRule($typeRule, $comparison = null)
    {
        if ($typeRule instanceof TypeRule) {
            return $this
                ->addUsingAlias(RulePeer::TRU_ID, $typeRule->getId(), $comparison);
        } elseif ($typeRule instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RulePeer::TRU_ID, $typeRule->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTypeRule() only accepts arguments of type TypeRule or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TypeRule relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function joinTypeRule($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TypeRule');

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
            $this->addJoinObject($join, 'TypeRule');
        }

        return $this;
    }

    /**
     * Use the TypeRule relation TypeRule object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\TypeRuleQuery A secondary query class using the current class as primary query
     */
    public function useTypeRuleQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTypeRule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeRule', '\Kzf\Model\TypeRuleQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RuleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByCreatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(RulePeer::CREATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RulePeer::CREATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return RuleQuery The current query, for fluid interface
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
     * @return                 RuleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUpdatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(RulePeer::UPDATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(RulePeer::UPDATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return RuleQuery The current query, for fluid interface
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
     * Filter the query by a related BchRul object
     *
     * @param   BchRul|PropelObjectCollection $bchRul  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RuleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBchRul($bchRul, $comparison = null)
    {
        if ($bchRul instanceof BchRul) {
            return $this
                ->addUsingAlias(RulePeer::ID, $bchRul->getRulId(), $comparison);
        } elseif ($bchRul instanceof PropelObjectCollection) {
            return $this
                ->useBchRulQuery()
                ->filterByPrimaryKeys($bchRul->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBchRul() only accepts arguments of type BchRul or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BchRul relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function joinBchRul($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BchRul');

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
            $this->addJoinObject($join, 'BchRul');
        }

        return $this;
    }

    /**
     * Use the BchRul relation BchRul object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\BchRulQuery A secondary query class using the current class as primary query
     */
    public function useBchRulQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBchRul($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BchRul', '\Kzf\Model\BchRulQuery');
    }

    /**
     * Filter the query by a related LefRul object
     *
     * @param   LefRul|PropelObjectCollection $lefRul  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RuleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLefRul($lefRul, $comparison = null)
    {
        if ($lefRul instanceof LefRul) {
            return $this
                ->addUsingAlias(RulePeer::ID, $lefRul->getRulId(), $comparison);
        } elseif ($lefRul instanceof PropelObjectCollection) {
            return $this
                ->useLefRulQuery()
                ->filterByPrimaryKeys($lefRul->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLefRul() only accepts arguments of type LefRul or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LefRul relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function joinLefRul($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LefRul');

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
            $this->addJoinObject($join, 'LefRul');
        }

        return $this;
    }

    /**
     * Use the LefRul relation LefRul object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\LefRulQuery A secondary query class using the current class as primary query
     */
    public function useLefRulQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLefRul($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LefRul', '\Kzf\Model\LefRulQuery');
    }

    /**
     * Filter the query by a related RulOption object
     *
     * @param   RulOption|PropelObjectCollection $rulOption  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 RuleQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRulOption($rulOption, $comparison = null)
    {
        if ($rulOption instanceof RulOption) {
            return $this
                ->addUsingAlias(RulePeer::ID, $rulOption->getRulId(), $comparison);
        } elseif ($rulOption instanceof PropelObjectCollection) {
            return $this
                ->useRulOptionQuery()
                ->filterByPrimaryKeys($rulOption->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRulOption() only accepts arguments of type RulOption or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RulOption relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function joinRulOption($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RulOption');

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
            $this->addJoinObject($join, 'RulOption');
        }

        return $this;
    }

    /**
     * Use the RulOption relation RulOption object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\RulOptionQuery A secondary query class using the current class as primary query
     */
    public function useRulOptionQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRulOption($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RulOption', '\Kzf\Model\RulOptionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   Rule $rule Object to remove from the list of results
     *
     * @return RuleQuery The current query, for fluid interface
     */
    public function prune($rule = null)
    {
        if ($rule) {
            $this->addUsingAlias(RulePeer::ID, $rule->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

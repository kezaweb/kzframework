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
use Kzf\Model\Leaf;
use Kzf\Model\LefRul;
use Kzf\Model\LefRulPeer;
use Kzf\Model\LefRulQuery;
use Kzf\Model\Rule;
use Kzf\Model\User;

/**
 * Base class that represents a query for the 'lef_rul' table.
 *
 *
 *
 * @method LefRulQuery orderByLefId($order = Criteria::ASC) Order by the lef_id column
 * @method LefRulQuery orderByRulId($order = Criteria::ASC) Order by the rul_id column
 * @method LefRulQuery orderByLerOption($order = Criteria::ASC) Order by the ler_option column
 * @method LefRulQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method LefRulQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method LefRulQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method LefRulQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method LefRulQuery groupByLefId() Group by the lef_id column
 * @method LefRulQuery groupByRulId() Group by the rul_id column
 * @method LefRulQuery groupByLerOption() Group by the ler_option column
 * @method LefRulQuery groupByCreatedBy() Group by the created_by column
 * @method LefRulQuery groupByUpdatedBy() Group by the updated_by column
 * @method LefRulQuery groupByCreatedAt() Group by the created_at column
 * @method LefRulQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method LefRulQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method LefRulQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method LefRulQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method LefRulQuery leftJoinRule($relationAlias = null) Adds a LEFT JOIN clause to the query using the Rule relation
 * @method LefRulQuery rightJoinRule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Rule relation
 * @method LefRulQuery innerJoinRule($relationAlias = null) Adds a INNER JOIN clause to the query using the Rule relation
 *
 * @method LefRulQuery leftJoinLeaf($relationAlias = null) Adds a LEFT JOIN clause to the query using the Leaf relation
 * @method LefRulQuery rightJoinLeaf($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Leaf relation
 * @method LefRulQuery innerJoinLeaf($relationAlias = null) Adds a INNER JOIN clause to the query using the Leaf relation
 *
 * @method LefRulQuery leftJoinUserRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method LefRulQuery rightJoinUserRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method LefRulQuery innerJoinUserRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCreatedBy relation
 *
 * @method LefRulQuery leftJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method LefRulQuery rightJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method LefRulQuery innerJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUpdatedBy relation
 *
 * @method LefRul findOne(PropelPDO $con = null) Return the first LefRul matching the query
 * @method LefRul findOneOrCreate(PropelPDO $con = null) Return the first LefRul matching the query, or a new LefRul object populated from the query conditions when no match is found
 *
 * @method LefRul findOneByLefId(int $lef_id) Return the first LefRul filtered by the lef_id column
 * @method LefRul findOneByRulId(int $rul_id) Return the first LefRul filtered by the rul_id column
 * @method LefRul findOneByLerOption(string $ler_option) Return the first LefRul filtered by the ler_option column
 * @method LefRul findOneByCreatedBy(int $created_by) Return the first LefRul filtered by the created_by column
 * @method LefRul findOneByUpdatedBy(int $updated_by) Return the first LefRul filtered by the updated_by column
 * @method LefRul findOneByCreatedAt(string $created_at) Return the first LefRul filtered by the created_at column
 * @method LefRul findOneByUpdatedAt(string $updated_at) Return the first LefRul filtered by the updated_at column
 *
 * @method array findByLefId(int $lef_id) Return LefRul objects filtered by the lef_id column
 * @method array findByRulId(int $rul_id) Return LefRul objects filtered by the rul_id column
 * @method array findByLerOption(string $ler_option) Return LefRul objects filtered by the ler_option column
 * @method array findByCreatedBy(int $created_by) Return LefRul objects filtered by the created_by column
 * @method array findByUpdatedBy(int $updated_by) Return LefRul objects filtered by the updated_by column
 * @method array findByCreatedAt(string $created_at) Return LefRul objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return LefRul objects filtered by the updated_at column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseLefRulQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseLefRulQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kzf', $modelName = 'Kzf\\Model\\LefRul', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new LefRulQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   LefRulQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return LefRulQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof LefRulQuery) {
            return $criteria;
        }
        $query = new LefRulQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array $key Primary key to use for the query
                         A Primary key composition: [$lef_id, $rul_id]
     * @param     PropelPDO $con an optional connection object
     *
     * @return   LefRul|LefRul[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = LefRulPeer::getInstanceFromPool(serialize(array((string) $key[0], (string) $key[1]))))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(LefRulPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     PropelPDO $con A connection object
     *
     * @return                 LefRul A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT lef_id, rul_id, ler_option, created_by, updated_by, created_at, updated_at FROM lef_rul WHERE lef_id = :p0 AND rul_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            $obj = new LefRul();
            $obj->hydrate($row);
            LefRulPeer::addInstanceToPool($obj, serialize(array((string) $key[0], (string) $key[1])));
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
     * @return LefRul|LefRul[]|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     PropelPDO $con an optional connection object
     *
     * @return PropelObjectCollection|LefRul[]|mixed the list of results, formatted by the current formatter
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(LefRulPeer::LEF_ID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(LefRulPeer::RUL_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(LefRulPeer::LEF_ID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(LefRulPeer::RUL_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByLefId($lefId = null, $comparison = null)
    {
        if (is_array($lefId)) {
            $useMinMax = false;
            if (isset($lefId['min'])) {
                $this->addUsingAlias(LefRulPeer::LEF_ID, $lefId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($lefId['max'])) {
                $this->addUsingAlias(LefRulPeer::LEF_ID, $lefId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LefRulPeer::LEF_ID, $lefId, $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByRulId($rulId = null, $comparison = null)
    {
        if (is_array($rulId)) {
            $useMinMax = false;
            if (isset($rulId['min'])) {
                $this->addUsingAlias(LefRulPeer::RUL_ID, $rulId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rulId['max'])) {
                $this->addUsingAlias(LefRulPeer::RUL_ID, $rulId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LefRulPeer::RUL_ID, $rulId, $comparison);
    }

    /**
     * Filter the query on the ler_option column
     *
     * Example usage:
     * <code>
     * $query->filterByLerOption('fooValue');   // WHERE ler_option = 'fooValue'
     * $query->filterByLerOption('%fooValue%'); // WHERE ler_option LIKE '%fooValue%'
     * </code>
     *
     * @param     string $lerOption The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByLerOption($lerOption = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($lerOption)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $lerOption)) {
                $lerOption = str_replace('*', '%', $lerOption);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(LefRulPeer::LER_OPTION, $lerOption, $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(LefRulPeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(LefRulPeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LefRulPeer::CREATED_BY, $createdBy, $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(LefRulPeer::UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(LefRulPeer::UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LefRulPeer::UPDATED_BY, $updatedBy, $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(LefRulPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(LefRulPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LefRulPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(LefRulPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(LefRulPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(LefRulPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Rule object
     *
     * @param   Rule|PropelObjectCollection $rule The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LefRulQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRule($rule, $comparison = null)
    {
        if ($rule instanceof Rule) {
            return $this
                ->addUsingAlias(LefRulPeer::RUL_ID, $rule->getId(), $comparison);
        } elseif ($rule instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LefRulPeer::RUL_ID, $rule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function joinRule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useRuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinRule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Rule', '\Kzf\Model\RuleQuery');
    }

    /**
     * Filter the query by a related Leaf object
     *
     * @param   Leaf|PropelObjectCollection $leaf The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LefRulQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeaf($leaf, $comparison = null)
    {
        if ($leaf instanceof Leaf) {
            return $this
                ->addUsingAlias(LefRulPeer::LEF_ID, $leaf->getId(), $comparison);
        } elseif ($leaf instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LefRulPeer::LEF_ID, $leaf->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
     */
    public function joinLeaf($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useLeafQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinLeaf($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Leaf', '\Kzf\Model\LeafQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 LefRulQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByCreatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(LefRulPeer::CREATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LefRulPeer::CREATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
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
     * @return                 LefRulQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUpdatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(LefRulPeer::UPDATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(LefRulPeer::UPDATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return LefRulQuery The current query, for fluid interface
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
     * @param   LefRul $lefRul Object to remove from the list of results
     *
     * @return LefRulQuery The current query, for fluid interface
     */
    public function prune($lefRul = null)
    {
        if ($lefRul) {
            $this->addCond('pruneCond0', $this->getAliasedColName(LefRulPeer::LEF_ID), $lefRul->getLefId(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(LefRulPeer::RUL_ID), $lefRul->getRulId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     LefRulQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(LefRulPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     LefRulQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(LefRulPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     LefRulQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(LefRulPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     LefRulQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(LefRulPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     LefRulQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(LefRulPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     LefRulQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(LefRulPeer::CREATED_AT);
    }
}

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
use Kzf\Model\TypeRule;
use Kzf\Model\TypeRuleI18n;
use Kzf\Model\TypeRuleI18nPeer;
use Kzf\Model\TypeRuleI18nQuery;

/**
 * Base class that represents a query for the 'type_rule_i18n' table.
 *
 *
 *
 * @method TypeRuleI18nQuery orderById($order = Criteria::ASC) Order by the id column
 * @method TypeRuleI18nQuery orderByLocal($order = Criteria::ASC) Order by the local column
 * @method TypeRuleI18nQuery orderByTruName($order = Criteria::ASC) Order by the tru_name column
 *
 * @method TypeRuleI18nQuery groupById() Group by the id column
 * @method TypeRuleI18nQuery groupByLocal() Group by the local column
 * @method TypeRuleI18nQuery groupByTruName() Group by the tru_name column
 *
 * @method TypeRuleI18nQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method TypeRuleI18nQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method TypeRuleI18nQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method TypeRuleI18nQuery leftJoinTypeRule($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeRule relation
 * @method TypeRuleI18nQuery rightJoinTypeRule($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeRule relation
 * @method TypeRuleI18nQuery innerJoinTypeRule($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeRule relation
 *
 * @method TypeRuleI18n findOne(PropelPDO $con = null) Return the first TypeRuleI18n matching the query
 * @method TypeRuleI18n findOneOrCreate(PropelPDO $con = null) Return the first TypeRuleI18n matching the query, or a new TypeRuleI18n object populated from the query conditions when no match is found
 *
 * @method TypeRuleI18n findOneByLocal(string $local) Return the first TypeRuleI18n filtered by the local column
 * @method TypeRuleI18n findOneByTruName(string $tru_name) Return the first TypeRuleI18n filtered by the tru_name column
 *
 * @method array findById(int $id) Return TypeRuleI18n objects filtered by the id column
 * @method array findByLocal(string $local) Return TypeRuleI18n objects filtered by the local column
 * @method array findByTruName(string $tru_name) Return TypeRuleI18n objects filtered by the tru_name column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseTypeRuleI18nQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseTypeRuleI18nQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kzf', $modelName = 'Kzf\\Model\\TypeRuleI18n', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new TypeRuleI18nQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   TypeRuleI18nQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return TypeRuleI18nQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof TypeRuleI18nQuery) {
            return $criteria;
        }
        $query = new TypeRuleI18nQuery();
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
     * @return   TypeRuleI18n|TypeRuleI18n[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TypeRuleI18nPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(TypeRuleI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 TypeRuleI18n A model object, or null if the key is not found
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
     * @return                 TypeRuleI18n A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT id, local, tru_name FROM type_rule_i18n WHERE id = :p0';
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
            $obj = new TypeRuleI18n();
            $obj->hydrate($row);
            TypeRuleI18nPeer::addInstanceToPool($obj, (string) $key);
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
     * @return TypeRuleI18n|TypeRuleI18n[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|TypeRuleI18n[]|mixed the list of results, formatted by the current formatter
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
     * @return TypeRuleI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TypeRuleI18nPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return TypeRuleI18nQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TypeRuleI18nPeer::ID, $keys, Criteria::IN);
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
     * @see       filterByTypeRule()
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeRuleI18nQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(TypeRuleI18nPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(TypeRuleI18nPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TypeRuleI18nPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the local column
     *
     * Example usage:
     * <code>
     * $query->filterByLocal('fooValue');   // WHERE local = 'fooValue'
     * $query->filterByLocal('%fooValue%'); // WHERE local LIKE '%fooValue%'
     * </code>
     *
     * @param     string $local The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeRuleI18nQuery The current query, for fluid interface
     */
    public function filterByLocal($local = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($local)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $local)) {
                $local = str_replace('*', '%', $local);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeRuleI18nPeer::LOCAL, $local, $comparison);
    }

    /**
     * Filter the query on the tru_name column
     *
     * Example usage:
     * <code>
     * $query->filterByTruName('fooValue');   // WHERE tru_name = 'fooValue'
     * $query->filterByTruName('%fooValue%'); // WHERE tru_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $truName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return TypeRuleI18nQuery The current query, for fluid interface
     */
    public function filterByTruName($truName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($truName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $truName)) {
                $truName = str_replace('*', '%', $truName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TypeRuleI18nPeer::TRU_NAME, $truName, $comparison);
    }

    /**
     * Filter the query by a related TypeRule object
     *
     * @param   TypeRule|PropelObjectCollection $typeRule The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 TypeRuleI18nQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTypeRule($typeRule, $comparison = null)
    {
        if ($typeRule instanceof TypeRule) {
            return $this
                ->addUsingAlias(TypeRuleI18nPeer::ID, $typeRule->getId(), $comparison);
        } elseif ($typeRule instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(TypeRuleI18nPeer::ID, $typeRule->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return TypeRuleI18nQuery The current query, for fluid interface
     */
    public function joinTypeRule($relationAlias = null, $joinType = Criteria::INNER_JOIN)
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
    public function useTypeRuleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTypeRule($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeRule', '\Kzf\Model\TypeRuleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   TypeRuleI18n $typeRuleI18n Object to remove from the list of results
     *
     * @return TypeRuleI18nQuery The current query, for fluid interface
     */
    public function prune($typeRuleI18n = null)
    {
        if ($typeRuleI18n) {
            $this->addUsingAlias(TypeRuleI18nPeer::ID, $typeRuleI18n->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

}

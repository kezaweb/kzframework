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
use Kzf\Model\Branch;
use Kzf\Model\BranchPeer;
use Kzf\Model\BranchQuery;
use Kzf\Model\Template;
use Kzf\Model\User;

/**
 * Base class that represents a query for the 'branch' table.
 *
 *
 *
 * @method BranchQuery orderById($order = Criteria::ASC) Order by the id column
 * @method BranchQuery orderByBchTitle($order = Criteria::ASC) Order by the bch_title column
 * @method BranchQuery orderByBchActive($order = Criteria::ASC) Order by the bch_active column
 * @method BranchQuery orderByBchPublishedAt($order = Criteria::ASC) Order by the bch_published_at column
 * @method BranchQuery orderByBchLevel($order = Criteria::ASC) Order by the bch_level column
 * @method BranchQuery orderByBchUrl($order = Criteria::ASC) Order by the bch_url column
 * @method BranchQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method BranchQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method BranchQuery orderByTplId($order = Criteria::ASC) Order by the tpl_id column
 * @method BranchQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method BranchQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method BranchQuery groupById() Group by the id column
 * @method BranchQuery groupByBchTitle() Group by the bch_title column
 * @method BranchQuery groupByBchActive() Group by the bch_active column
 * @method BranchQuery groupByBchPublishedAt() Group by the bch_published_at column
 * @method BranchQuery groupByBchLevel() Group by the bch_level column
 * @method BranchQuery groupByBchUrl() Group by the bch_url column
 * @method BranchQuery groupByCreatedBy() Group by the created_by column
 * @method BranchQuery groupByUpdatedBy() Group by the updated_by column
 * @method BranchQuery groupByTplId() Group by the tpl_id column
 * @method BranchQuery groupByCreatedAt() Group by the created_at column
 * @method BranchQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method BranchQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method BranchQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method BranchQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method BranchQuery leftJoinTemplate($relationAlias = null) Adds a LEFT JOIN clause to the query using the Template relation
 * @method BranchQuery rightJoinTemplate($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Template relation
 * @method BranchQuery innerJoinTemplate($relationAlias = null) Adds a INNER JOIN clause to the query using the Template relation
 *
 * @method BranchQuery leftJoinUserRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method BranchQuery rightJoinUserRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method BranchQuery innerJoinUserRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCreatedBy relation
 *
 * @method BranchQuery leftJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method BranchQuery rightJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method BranchQuery innerJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUpdatedBy relation
 *
 * @method BranchQuery leftJoinBchRul($relationAlias = null) Adds a LEFT JOIN clause to the query using the BchRul relation
 * @method BranchQuery rightJoinBchRul($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BchRul relation
 * @method BranchQuery innerJoinBchRul($relationAlias = null) Adds a INNER JOIN clause to the query using the BchRul relation
 *
 * @method Branch findOne(PropelPDO $con = null) Return the first Branch matching the query
 * @method Branch findOneOrCreate(PropelPDO $con = null) Return the first Branch matching the query, or a new Branch object populated from the query conditions when no match is found
 *
 * @method Branch findOneByBchTitle(string $bch_title) Return the first Branch filtered by the bch_title column
 * @method Branch findOneByBchActive(boolean $bch_active) Return the first Branch filtered by the bch_active column
 * @method Branch findOneByBchPublishedAt(string $bch_published_at) Return the first Branch filtered by the bch_published_at column
 * @method Branch findOneByBchLevel(int $bch_level) Return the first Branch filtered by the bch_level column
 * @method Branch findOneByBchUrl(string $bch_url) Return the first Branch filtered by the bch_url column
 * @method Branch findOneByCreatedBy(int $created_by) Return the first Branch filtered by the created_by column
 * @method Branch findOneByUpdatedBy(int $updated_by) Return the first Branch filtered by the updated_by column
 * @method Branch findOneByTplId(int $tpl_id) Return the first Branch filtered by the tpl_id column
 * @method Branch findOneByCreatedAt(string $created_at) Return the first Branch filtered by the created_at column
 * @method Branch findOneByUpdatedAt(string $updated_at) Return the first Branch filtered by the updated_at column
 *
 * @method array findById(int $id) Return Branch objects filtered by the id column
 * @method array findByBchTitle(string $bch_title) Return Branch objects filtered by the bch_title column
 * @method array findByBchActive(boolean $bch_active) Return Branch objects filtered by the bch_active column
 * @method array findByBchPublishedAt(string $bch_published_at) Return Branch objects filtered by the bch_published_at column
 * @method array findByBchLevel(int $bch_level) Return Branch objects filtered by the bch_level column
 * @method array findByBchUrl(string $bch_url) Return Branch objects filtered by the bch_url column
 * @method array findByCreatedBy(int $created_by) Return Branch objects filtered by the created_by column
 * @method array findByUpdatedBy(int $updated_by) Return Branch objects filtered by the updated_by column
 * @method array findByTplId(int $tpl_id) Return Branch objects filtered by the tpl_id column
 * @method array findByCreatedAt(string $created_at) Return Branch objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return Branch objects filtered by the updated_at column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseBranchQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseBranchQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kzf', $modelName = 'Kzf\\Model\\Branch', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new BranchQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   BranchQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return BranchQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof BranchQuery) {
            return $criteria;
        }
        $query = new BranchQuery();
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
     * @return   Branch|Branch[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = BranchPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 Branch A model object, or null if the key is not found
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
     * @return                 Branch A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT id, bch_title, bch_active, bch_published_at, bch_level, bch_url, created_by, updated_by, tpl_id, created_at, updated_at FROM branch WHERE id = :p0';
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
            $obj = new Branch();
            $obj->hydrate($row);
            BranchPeer::addInstanceToPool($obj, (string) $key);
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
     * @return Branch|Branch[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|Branch[]|mixed the list of results, formatted by the current formatter
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
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BranchPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BranchPeer::ID, $keys, Criteria::IN);
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
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(BranchPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(BranchPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the bch_title column
     *
     * Example usage:
     * <code>
     * $query->filterByBchTitle('fooValue');   // WHERE bch_title = 'fooValue'
     * $query->filterByBchTitle('%fooValue%'); // WHERE bch_title LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bchTitle The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByBchTitle($bchTitle = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bchTitle)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bchTitle)) {
                $bchTitle = str_replace('*', '%', $bchTitle);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BranchPeer::BCH_TITLE, $bchTitle, $comparison);
    }

    /**
     * Filter the query on the bch_active column
     *
     * Example usage:
     * <code>
     * $query->filterByBchActive(true); // WHERE bch_active = true
     * $query->filterByBchActive('yes'); // WHERE bch_active = true
     * </code>
     *
     * @param     boolean|string $bchActive The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByBchActive($bchActive = null, $comparison = null)
    {
        if (is_string($bchActive)) {
            $bchActive = in_array(strtolower($bchActive), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(BranchPeer::BCH_ACTIVE, $bchActive, $comparison);
    }

    /**
     * Filter the query on the bch_published_at column
     *
     * Example usage:
     * <code>
     * $query->filterByBchPublishedAt('2011-03-14'); // WHERE bch_published_at = '2011-03-14'
     * $query->filterByBchPublishedAt('now'); // WHERE bch_published_at = '2011-03-14'
     * $query->filterByBchPublishedAt(array('max' => 'yesterday')); // WHERE bch_published_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $bchPublishedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByBchPublishedAt($bchPublishedAt = null, $comparison = null)
    {
        if (is_array($bchPublishedAt)) {
            $useMinMax = false;
            if (isset($bchPublishedAt['min'])) {
                $this->addUsingAlias(BranchPeer::BCH_PUBLISHED_AT, $bchPublishedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bchPublishedAt['max'])) {
                $this->addUsingAlias(BranchPeer::BCH_PUBLISHED_AT, $bchPublishedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchPeer::BCH_PUBLISHED_AT, $bchPublishedAt, $comparison);
    }

    /**
     * Filter the query on the bch_level column
     *
     * Example usage:
     * <code>
     * $query->filterByBchLevel(1234); // WHERE bch_level = 1234
     * $query->filterByBchLevel(array(12, 34)); // WHERE bch_level IN (12, 34)
     * $query->filterByBchLevel(array('min' => 12)); // WHERE bch_level >= 12
     * $query->filterByBchLevel(array('max' => 12)); // WHERE bch_level <= 12
     * </code>
     *
     * @param     mixed $bchLevel The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByBchLevel($bchLevel = null, $comparison = null)
    {
        if (is_array($bchLevel)) {
            $useMinMax = false;
            if (isset($bchLevel['min'])) {
                $this->addUsingAlias(BranchPeer::BCH_LEVEL, $bchLevel['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bchLevel['max'])) {
                $this->addUsingAlias(BranchPeer::BCH_LEVEL, $bchLevel['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchPeer::BCH_LEVEL, $bchLevel, $comparison);
    }

    /**
     * Filter the query on the bch_url column
     *
     * Example usage:
     * <code>
     * $query->filterByBchUrl('fooValue');   // WHERE bch_url = 'fooValue'
     * $query->filterByBchUrl('%fooValue%'); // WHERE bch_url LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bchUrl The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByBchUrl($bchUrl = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bchUrl)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $bchUrl)) {
                $bchUrl = str_replace('*', '%', $bchUrl);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(BranchPeer::BCH_URL, $bchUrl, $comparison);
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
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(BranchPeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(BranchPeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchPeer::CREATED_BY, $createdBy, $comparison);
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
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(BranchPeer::UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(BranchPeer::UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchPeer::UPDATED_BY, $updatedBy, $comparison);
    }

    /**
     * Filter the query on the tpl_id column
     *
     * Example usage:
     * <code>
     * $query->filterByTplId(1234); // WHERE tpl_id = 1234
     * $query->filterByTplId(array(12, 34)); // WHERE tpl_id IN (12, 34)
     * $query->filterByTplId(array('min' => 12)); // WHERE tpl_id >= 12
     * $query->filterByTplId(array('max' => 12)); // WHERE tpl_id <= 12
     * </code>
     *
     * @see       filterByTemplate()
     *
     * @param     mixed $tplId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByTplId($tplId = null, $comparison = null)
    {
        if (is_array($tplId)) {
            $useMinMax = false;
            if (isset($tplId['min'])) {
                $this->addUsingAlias(BranchPeer::TPL_ID, $tplId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($tplId['max'])) {
                $this->addUsingAlias(BranchPeer::TPL_ID, $tplId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchPeer::TPL_ID, $tplId, $comparison);
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
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(BranchPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(BranchPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return BranchQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(BranchPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(BranchPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BranchPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related Template object
     *
     * @param   Template|PropelObjectCollection $template The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BranchQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTemplate($template, $comparison = null)
    {
        if ($template instanceof Template) {
            return $this
                ->addUsingAlias(BranchPeer::TPL_ID, $template->getId(), $comparison);
        } elseif ($template instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BranchPeer::TPL_ID, $template->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByTemplate() only accepts arguments of type Template or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Template relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function joinTemplate($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Template');

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
            $this->addJoinObject($join, 'Template');
        }

        return $this;
    }

    /**
     * Use the Template relation Template object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\TemplateQuery A secondary query class using the current class as primary query
     */
    public function useTemplateQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTemplate($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Template', '\Kzf\Model\TemplateQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 BranchQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByCreatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(BranchPeer::CREATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BranchPeer::CREATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return BranchQuery The current query, for fluid interface
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
     * @return                 BranchQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUpdatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(BranchPeer::UPDATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BranchPeer::UPDATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return BranchQuery The current query, for fluid interface
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
     * @return                 BranchQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBchRul($bchRul, $comparison = null)
    {
        if ($bchRul instanceof BchRul) {
            return $this
                ->addUsingAlias(BranchPeer::ID, $bchRul->getBchId(), $comparison);
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
     * @return BranchQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   Branch $branch Object to remove from the list of results
     *
     * @return BranchQuery The current query, for fluid interface
     */
    public function prune($branch = null)
    {
        if ($branch) {
            $this->addUsingAlias(BranchPeer::ID, $branch->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     BranchQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(BranchPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     BranchQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(BranchPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     BranchQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(BranchPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     BranchQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(BranchPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     BranchQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(BranchPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     BranchQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(BranchPeer::CREATED_AT);
    }
}

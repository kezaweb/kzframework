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
use Kzf\Model\Credential;
use Kzf\Model\Leaf;
use Kzf\Model\LefRul;
use Kzf\Model\RulOption;
use Kzf\Model\Rule;
use Kzf\Model\Template;
use Kzf\Model\TypeRule;
use Kzf\Model\User;
use Kzf\Model\UserPeer;
use Kzf\Model\UserQuery;
use Kzf\Model\UsrCre;

/**
 * Base class that represents a query for the 'user' table.
 *
 *
 *
 * @method UserQuery orderById($order = Criteria::ASC) Order by the id column
 * @method UserQuery orderByUsrFirstName($order = Criteria::ASC) Order by the usr_first_name column
 * @method UserQuery orderByUsrLastName($order = Criteria::ASC) Order by the usr_last_name column
 * @method UserQuery orderByUsrLogin($order = Criteria::ASC) Order by the usr_login column
 * @method UserQuery orderByUsrPassword($order = Criteria::ASC) Order by the usr_password column
 * @method UserQuery orderByUsrCp($order = Criteria::ASC) Order by the usr_cp column
 * @method UserQuery orderByUsrAvatar($order = Criteria::ASC) Order by the usr_avatar column
 * @method UserQuery orderByCreatedBy($order = Criteria::ASC) Order by the created_by column
 * @method UserQuery orderByUpdatedBy($order = Criteria::ASC) Order by the updated_by column
 * @method UserQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method UserQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 *
 * @method UserQuery groupById() Group by the id column
 * @method UserQuery groupByUsrFirstName() Group by the usr_first_name column
 * @method UserQuery groupByUsrLastName() Group by the usr_last_name column
 * @method UserQuery groupByUsrLogin() Group by the usr_login column
 * @method UserQuery groupByUsrPassword() Group by the usr_password column
 * @method UserQuery groupByUsrCp() Group by the usr_cp column
 * @method UserQuery groupByUsrAvatar() Group by the usr_avatar column
 * @method UserQuery groupByCreatedBy() Group by the created_by column
 * @method UserQuery groupByUpdatedBy() Group by the updated_by column
 * @method UserQuery groupByCreatedAt() Group by the created_at column
 * @method UserQuery groupByUpdatedAt() Group by the updated_at column
 *
 * @method UserQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method UserQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method UserQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method UserQuery leftJoinUserRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method UserQuery rightJoinUserRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByCreatedBy relation
 * @method UserQuery innerJoinUserRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method UserQuery rightJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedByUpdatedBy relation
 * @method UserQuery innerJoinUserRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinBchRulRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the BchRulRelatedByCreatedBy relation
 * @method UserQuery rightJoinBchRulRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BchRulRelatedByCreatedBy relation
 * @method UserQuery innerJoinBchRulRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the BchRulRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinBchRulRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the BchRulRelatedByUpdatedBy relation
 * @method UserQuery rightJoinBchRulRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BchRulRelatedByUpdatedBy relation
 * @method UserQuery innerJoinBchRulRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the BchRulRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinBranchRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchRelatedByCreatedBy relation
 * @method UserQuery rightJoinBranchRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchRelatedByCreatedBy relation
 * @method UserQuery innerJoinBranchRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinBranchRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the BranchRelatedByUpdatedBy relation
 * @method UserQuery rightJoinBranchRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the BranchRelatedByUpdatedBy relation
 * @method UserQuery innerJoinBranchRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the BranchRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinCredentialRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the CredentialRelatedByCreatedBy relation
 * @method UserQuery rightJoinCredentialRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CredentialRelatedByCreatedBy relation
 * @method UserQuery innerJoinCredentialRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the CredentialRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinCredentialRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the CredentialRelatedByUpdatedBy relation
 * @method UserQuery rightJoinCredentialRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the CredentialRelatedByUpdatedBy relation
 * @method UserQuery innerJoinCredentialRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the CredentialRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinLeafRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeafRelatedByCreatedBy relation
 * @method UserQuery rightJoinLeafRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeafRelatedByCreatedBy relation
 * @method UserQuery innerJoinLeafRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the LeafRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinLeafRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the LeafRelatedByUpdatedBy relation
 * @method UserQuery rightJoinLeafRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LeafRelatedByUpdatedBy relation
 * @method UserQuery innerJoinLeafRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the LeafRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinLefRulRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the LefRulRelatedByCreatedBy relation
 * @method UserQuery rightJoinLefRulRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LefRulRelatedByCreatedBy relation
 * @method UserQuery innerJoinLefRulRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the LefRulRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinLefRulRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the LefRulRelatedByUpdatedBy relation
 * @method UserQuery rightJoinLefRulRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the LefRulRelatedByUpdatedBy relation
 * @method UserQuery innerJoinLefRulRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the LefRulRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinRulOptionRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the RulOptionRelatedByCreatedBy relation
 * @method UserQuery rightJoinRulOptionRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RulOptionRelatedByCreatedBy relation
 * @method UserQuery innerJoinRulOptionRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the RulOptionRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinRulOptionRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the RulOptionRelatedByUpdatedBy relation
 * @method UserQuery rightJoinRulOptionRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RulOptionRelatedByUpdatedBy relation
 * @method UserQuery innerJoinRulOptionRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the RulOptionRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinRuleRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the RuleRelatedByCreatedBy relation
 * @method UserQuery rightJoinRuleRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RuleRelatedByCreatedBy relation
 * @method UserQuery innerJoinRuleRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the RuleRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinRuleRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the RuleRelatedByUpdatedBy relation
 * @method UserQuery rightJoinRuleRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the RuleRelatedByUpdatedBy relation
 * @method UserQuery innerJoinRuleRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the RuleRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinTemplateRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the TemplateRelatedByCreatedBy relation
 * @method UserQuery rightJoinTemplateRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TemplateRelatedByCreatedBy relation
 * @method UserQuery innerJoinTemplateRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the TemplateRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinTemplateRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the TemplateRelatedByUpdatedBy relation
 * @method UserQuery rightJoinTemplateRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TemplateRelatedByUpdatedBy relation
 * @method UserQuery innerJoinTemplateRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the TemplateRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinTypeRuleRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeRuleRelatedByCreatedBy relation
 * @method UserQuery rightJoinTypeRuleRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeRuleRelatedByCreatedBy relation
 * @method UserQuery innerJoinTypeRuleRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeRuleRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinTypeRuleRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the TypeRuleRelatedByUpdatedBy relation
 * @method UserQuery rightJoinTypeRuleRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the TypeRuleRelatedByUpdatedBy relation
 * @method UserQuery innerJoinTypeRuleRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the TypeRuleRelatedByUpdatedBy relation
 *
 * @method UserQuery leftJoinUserRelatedById0($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedById0 relation
 * @method UserQuery rightJoinUserRelatedById0($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedById0 relation
 * @method UserQuery innerJoinUserRelatedById0($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedById0 relation
 *
 * @method UserQuery leftJoinUserRelatedById1($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserRelatedById1 relation
 * @method UserQuery rightJoinUserRelatedById1($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserRelatedById1 relation
 * @method UserQuery innerJoinUserRelatedById1($relationAlias = null) Adds a INNER JOIN clause to the query using the UserRelatedById1 relation
 *
 * @method UserQuery leftJoinUsrCreRelatedByUsrId($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsrCreRelatedByUsrId relation
 * @method UserQuery rightJoinUsrCreRelatedByUsrId($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsrCreRelatedByUsrId relation
 * @method UserQuery innerJoinUsrCreRelatedByUsrId($relationAlias = null) Adds a INNER JOIN clause to the query using the UsrCreRelatedByUsrId relation
 *
 * @method UserQuery leftJoinUsrCreRelatedByCreatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsrCreRelatedByCreatedBy relation
 * @method UserQuery rightJoinUsrCreRelatedByCreatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsrCreRelatedByCreatedBy relation
 * @method UserQuery innerJoinUsrCreRelatedByCreatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UsrCreRelatedByCreatedBy relation
 *
 * @method UserQuery leftJoinUsrCreRelatedByUpdatedBy($relationAlias = null) Adds a LEFT JOIN clause to the query using the UsrCreRelatedByUpdatedBy relation
 * @method UserQuery rightJoinUsrCreRelatedByUpdatedBy($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UsrCreRelatedByUpdatedBy relation
 * @method UserQuery innerJoinUsrCreRelatedByUpdatedBy($relationAlias = null) Adds a INNER JOIN clause to the query using the UsrCreRelatedByUpdatedBy relation
 *
 * @method User findOne(PropelPDO $con = null) Return the first User matching the query
 * @method User findOneOrCreate(PropelPDO $con = null) Return the first User matching the query, or a new User object populated from the query conditions when no match is found
 *
 * @method User findOneByUsrFirstName(string $usr_first_name) Return the first User filtered by the usr_first_name column
 * @method User findOneByUsrLastName(string $usr_last_name) Return the first User filtered by the usr_last_name column
 * @method User findOneByUsrLogin(string $usr_login) Return the first User filtered by the usr_login column
 * @method User findOneByUsrPassword(string $usr_password) Return the first User filtered by the usr_password column
 * @method User findOneByUsrCp(int $usr_cp) Return the first User filtered by the usr_cp column
 * @method User findOneByUsrAvatar(string $usr_avatar) Return the first User filtered by the usr_avatar column
 * @method User findOneByCreatedBy(int $created_by) Return the first User filtered by the created_by column
 * @method User findOneByUpdatedBy(int $updated_by) Return the first User filtered by the updated_by column
 * @method User findOneByCreatedAt(string $created_at) Return the first User filtered by the created_at column
 * @method User findOneByUpdatedAt(string $updated_at) Return the first User filtered by the updated_at column
 *
 * @method array findById(int $id) Return User objects filtered by the id column
 * @method array findByUsrFirstName(string $usr_first_name) Return User objects filtered by the usr_first_name column
 * @method array findByUsrLastName(string $usr_last_name) Return User objects filtered by the usr_last_name column
 * @method array findByUsrLogin(string $usr_login) Return User objects filtered by the usr_login column
 * @method array findByUsrPassword(string $usr_password) Return User objects filtered by the usr_password column
 * @method array findByUsrCp(int $usr_cp) Return User objects filtered by the usr_cp column
 * @method array findByUsrAvatar(string $usr_avatar) Return User objects filtered by the usr_avatar column
 * @method array findByCreatedBy(int $created_by) Return User objects filtered by the created_by column
 * @method array findByUpdatedBy(int $updated_by) Return User objects filtered by the updated_by column
 * @method array findByCreatedAt(string $created_at) Return User objects filtered by the created_at column
 * @method array findByUpdatedAt(string $updated_at) Return User objects filtered by the updated_at column
 *
 * @package    propel.generator.model.om
 */
abstract class BaseUserQuery extends ModelCriteria
{
    /**
     * Initializes internal state of BaseUserQuery object.
     *
     * @param     string $dbName The dabase name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'kzf', $modelName = 'Kzf\\Model\\User', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new UserQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param   UserQuery|Criteria $criteria Optional Criteria to build the query from
     *
     * @return UserQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof UserQuery) {
            return $criteria;
        }
        $query = new UserQuery();
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
     * @return   User|User[]|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = UserPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is alredy in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
     * @return                 User A model object, or null if the key is not found
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
     * @return                 User A model object, or null if the key is not found
     * @throws PropelException
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT id, usr_first_name, usr_last_name, usr_login, usr_password, usr_cp, usr_avatar, created_by, updated_by, created_at, updated_at FROM user WHERE id = :p0';
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
            $obj = new User();
            $obj->hydrate($row);
            UserPeer::addInstanceToPool($obj, (string) $key);
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
     * @return User|User[]|mixed the result, formatted by the current formatter
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
     * @return PropelObjectCollection|User[]|mixed the list of results, formatted by the current formatter
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(UserPeer::ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(UserPeer::ID, $keys, Criteria::IN);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(UserPeer::ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(UserPeer::ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::ID, $id, $comparison);
    }

    /**
     * Filter the query on the usr_first_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrFirstName('fooValue');   // WHERE usr_first_name = 'fooValue'
     * $query->filterByUsrFirstName('%fooValue%'); // WHERE usr_first_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usrFirstName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUsrFirstName($usrFirstName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usrFirstName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usrFirstName)) {
                $usrFirstName = str_replace('*', '%', $usrFirstName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_FIRST_NAME, $usrFirstName, $comparison);
    }

    /**
     * Filter the query on the usr_last_name column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrLastName('fooValue');   // WHERE usr_last_name = 'fooValue'
     * $query->filterByUsrLastName('%fooValue%'); // WHERE usr_last_name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usrLastName The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUsrLastName($usrLastName = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usrLastName)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usrLastName)) {
                $usrLastName = str_replace('*', '%', $usrLastName);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_LAST_NAME, $usrLastName, $comparison);
    }

    /**
     * Filter the query on the usr_login column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrLogin('fooValue');   // WHERE usr_login = 'fooValue'
     * $query->filterByUsrLogin('%fooValue%'); // WHERE usr_login LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usrLogin The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUsrLogin($usrLogin = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usrLogin)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usrLogin)) {
                $usrLogin = str_replace('*', '%', $usrLogin);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_LOGIN, $usrLogin, $comparison);
    }

    /**
     * Filter the query on the usr_password column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrPassword('fooValue');   // WHERE usr_password = 'fooValue'
     * $query->filterByUsrPassword('%fooValue%'); // WHERE usr_password LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usrPassword The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUsrPassword($usrPassword = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usrPassword)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usrPassword)) {
                $usrPassword = str_replace('*', '%', $usrPassword);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_PASSWORD, $usrPassword, $comparison);
    }

    /**
     * Filter the query on the usr_cp column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrCp(1234); // WHERE usr_cp = 1234
     * $query->filterByUsrCp(array(12, 34)); // WHERE usr_cp IN (12, 34)
     * $query->filterByUsrCp(array('min' => 12)); // WHERE usr_cp >= 12
     * $query->filterByUsrCp(array('max' => 12)); // WHERE usr_cp <= 12
     * </code>
     *
     * @param     mixed $usrCp The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUsrCp($usrCp = null, $comparison = null)
    {
        if (is_array($usrCp)) {
            $useMinMax = false;
            if (isset($usrCp['min'])) {
                $this->addUsingAlias(UserPeer::USR_CP, $usrCp['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($usrCp['max'])) {
                $this->addUsingAlias(UserPeer::USR_CP, $usrCp['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_CP, $usrCp, $comparison);
    }

    /**
     * Filter the query on the usr_avatar column
     *
     * Example usage:
     * <code>
     * $query->filterByUsrAvatar('fooValue');   // WHERE usr_avatar = 'fooValue'
     * $query->filterByUsrAvatar('%fooValue%'); // WHERE usr_avatar LIKE '%fooValue%'
     * </code>
     *
     * @param     string $usrAvatar The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUsrAvatar($usrAvatar = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($usrAvatar)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $usrAvatar)) {
                $usrAvatar = str_replace('*', '%', $usrAvatar);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(UserPeer::USR_AVATAR, $usrAvatar, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByCreatedBy($createdBy = null, $comparison = null)
    {
        if (is_array($createdBy)) {
            $useMinMax = false;
            if (isset($createdBy['min'])) {
                $this->addUsingAlias(UserPeer::CREATED_BY, $createdBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdBy['max'])) {
                $this->addUsingAlias(UserPeer::CREATED_BY, $createdBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::CREATED_BY, $createdBy, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUpdatedBy($updatedBy = null, $comparison = null)
    {
        if (is_array($updatedBy)) {
            $useMinMax = false;
            if (isset($updatedBy['min'])) {
                $this->addUsingAlias(UserPeer::UPDATED_BY, $updatedBy['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedBy['max'])) {
                $this->addUsingAlias(UserPeer::UPDATED_BY, $updatedBy['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::UPDATED_BY, $updatedBy, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(UserPeer::CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(UserPeer::CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::CREATED_AT, $createdAt, $comparison);
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
     * @return UserQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(UserPeer::UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(UserPeer::UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserPeer::UPDATED_AT, $updatedAt, $comparison);
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user The related object(s) to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByCreatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(UserPeer::CREATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeer::CREATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return UserQuery The current query, for fluid interface
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
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedByUpdatedBy($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(UserPeer::UPDATED_BY, $user->getId(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserPeer::UPDATED_BY, $user->toKeyValue('PrimaryKey', 'Id'), $comparison);
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
     * @return UserQuery The current query, for fluid interface
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
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBchRulRelatedByCreatedBy($bchRul, $comparison = null)
    {
        if ($bchRul instanceof BchRul) {
            return $this
                ->addUsingAlias(UserPeer::ID, $bchRul->getCreatedBy(), $comparison);
        } elseif ($bchRul instanceof PropelObjectCollection) {
            return $this
                ->useBchRulRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($bchRul->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBchRulRelatedByCreatedBy() only accepts arguments of type BchRul or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BchRulRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinBchRulRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BchRulRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'BchRulRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the BchRulRelatedByCreatedBy relation BchRul object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\BchRulQuery A secondary query class using the current class as primary query
     */
    public function useBchRulRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBchRulRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BchRulRelatedByCreatedBy', '\Kzf\Model\BchRulQuery');
    }

    /**
     * Filter the query by a related BchRul object
     *
     * @param   BchRul|PropelObjectCollection $bchRul  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBchRulRelatedByUpdatedBy($bchRul, $comparison = null)
    {
        if ($bchRul instanceof BchRul) {
            return $this
                ->addUsingAlias(UserPeer::ID, $bchRul->getUpdatedBy(), $comparison);
        } elseif ($bchRul instanceof PropelObjectCollection) {
            return $this
                ->useBchRulRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($bchRul->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBchRulRelatedByUpdatedBy() only accepts arguments of type BchRul or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BchRulRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinBchRulRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BchRulRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'BchRulRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the BchRulRelatedByUpdatedBy relation BchRul object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\BchRulQuery A secondary query class using the current class as primary query
     */
    public function useBchRulRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBchRulRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BchRulRelatedByUpdatedBy', '\Kzf\Model\BchRulQuery');
    }

    /**
     * Filter the query by a related Branch object
     *
     * @param   Branch|PropelObjectCollection $branch  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBranchRelatedByCreatedBy($branch, $comparison = null)
    {
        if ($branch instanceof Branch) {
            return $this
                ->addUsingAlias(UserPeer::ID, $branch->getCreatedBy(), $comparison);
        } elseif ($branch instanceof PropelObjectCollection) {
            return $this
                ->useBranchRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($branch->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBranchRelatedByCreatedBy() only accepts arguments of type Branch or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BranchRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinBranchRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BranchRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'BranchRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the BranchRelatedByCreatedBy relation Branch object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\BranchQuery A secondary query class using the current class as primary query
     */
    public function useBranchRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBranchRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BranchRelatedByCreatedBy', '\Kzf\Model\BranchQuery');
    }

    /**
     * Filter the query by a related Branch object
     *
     * @param   Branch|PropelObjectCollection $branch  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByBranchRelatedByUpdatedBy($branch, $comparison = null)
    {
        if ($branch instanceof Branch) {
            return $this
                ->addUsingAlias(UserPeer::ID, $branch->getUpdatedBy(), $comparison);
        } elseif ($branch instanceof PropelObjectCollection) {
            return $this
                ->useBranchRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($branch->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBranchRelatedByUpdatedBy() only accepts arguments of type Branch or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the BranchRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinBranchRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('BranchRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'BranchRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the BranchRelatedByUpdatedBy relation Branch object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\BranchQuery A secondary query class using the current class as primary query
     */
    public function useBranchRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinBranchRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'BranchRelatedByUpdatedBy', '\Kzf\Model\BranchQuery');
    }

    /**
     * Filter the query by a related Credential object
     *
     * @param   Credential|PropelObjectCollection $credential  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCredentialRelatedByCreatedBy($credential, $comparison = null)
    {
        if ($credential instanceof Credential) {
            return $this
                ->addUsingAlias(UserPeer::ID, $credential->getCreatedBy(), $comparison);
        } elseif ($credential instanceof PropelObjectCollection) {
            return $this
                ->useCredentialRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($credential->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCredentialRelatedByCreatedBy() only accepts arguments of type Credential or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CredentialRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinCredentialRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CredentialRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'CredentialRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the CredentialRelatedByCreatedBy relation Credential object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\CredentialQuery A secondary query class using the current class as primary query
     */
    public function useCredentialRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCredentialRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CredentialRelatedByCreatedBy', '\Kzf\Model\CredentialQuery');
    }

    /**
     * Filter the query by a related Credential object
     *
     * @param   Credential|PropelObjectCollection $credential  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByCredentialRelatedByUpdatedBy($credential, $comparison = null)
    {
        if ($credential instanceof Credential) {
            return $this
                ->addUsingAlias(UserPeer::ID, $credential->getUpdatedBy(), $comparison);
        } elseif ($credential instanceof PropelObjectCollection) {
            return $this
                ->useCredentialRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($credential->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByCredentialRelatedByUpdatedBy() only accepts arguments of type Credential or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the CredentialRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinCredentialRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('CredentialRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'CredentialRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the CredentialRelatedByUpdatedBy relation Credential object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\CredentialQuery A secondary query class using the current class as primary query
     */
    public function useCredentialRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinCredentialRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'CredentialRelatedByUpdatedBy', '\Kzf\Model\CredentialQuery');
    }

    /**
     * Filter the query by a related Leaf object
     *
     * @param   Leaf|PropelObjectCollection $leaf  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeafRelatedByCreatedBy($leaf, $comparison = null)
    {
        if ($leaf instanceof Leaf) {
            return $this
                ->addUsingAlias(UserPeer::ID, $leaf->getCreatedBy(), $comparison);
        } elseif ($leaf instanceof PropelObjectCollection) {
            return $this
                ->useLeafRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($leaf->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeafRelatedByCreatedBy() only accepts arguments of type Leaf or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeafRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinLeafRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeafRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'LeafRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the LeafRelatedByCreatedBy relation Leaf object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\LeafQuery A secondary query class using the current class as primary query
     */
    public function useLeafRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeafRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeafRelatedByCreatedBy', '\Kzf\Model\LeafQuery');
    }

    /**
     * Filter the query by a related Leaf object
     *
     * @param   Leaf|PropelObjectCollection $leaf  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLeafRelatedByUpdatedBy($leaf, $comparison = null)
    {
        if ($leaf instanceof Leaf) {
            return $this
                ->addUsingAlias(UserPeer::ID, $leaf->getUpdatedBy(), $comparison);
        } elseif ($leaf instanceof PropelObjectCollection) {
            return $this
                ->useLeafRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($leaf->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLeafRelatedByUpdatedBy() only accepts arguments of type Leaf or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LeafRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinLeafRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LeafRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'LeafRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the LeafRelatedByUpdatedBy relation Leaf object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\LeafQuery A secondary query class using the current class as primary query
     */
    public function useLeafRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLeafRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LeafRelatedByUpdatedBy', '\Kzf\Model\LeafQuery');
    }

    /**
     * Filter the query by a related LefRul object
     *
     * @param   LefRul|PropelObjectCollection $lefRul  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLefRulRelatedByCreatedBy($lefRul, $comparison = null)
    {
        if ($lefRul instanceof LefRul) {
            return $this
                ->addUsingAlias(UserPeer::ID, $lefRul->getCreatedBy(), $comparison);
        } elseif ($lefRul instanceof PropelObjectCollection) {
            return $this
                ->useLefRulRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($lefRul->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLefRulRelatedByCreatedBy() only accepts arguments of type LefRul or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LefRulRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinLefRulRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LefRulRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'LefRulRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the LefRulRelatedByCreatedBy relation LefRul object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\LefRulQuery A secondary query class using the current class as primary query
     */
    public function useLefRulRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLefRulRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LefRulRelatedByCreatedBy', '\Kzf\Model\LefRulQuery');
    }

    /**
     * Filter the query by a related LefRul object
     *
     * @param   LefRul|PropelObjectCollection $lefRul  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByLefRulRelatedByUpdatedBy($lefRul, $comparison = null)
    {
        if ($lefRul instanceof LefRul) {
            return $this
                ->addUsingAlias(UserPeer::ID, $lefRul->getUpdatedBy(), $comparison);
        } elseif ($lefRul instanceof PropelObjectCollection) {
            return $this
                ->useLefRulRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($lefRul->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByLefRulRelatedByUpdatedBy() only accepts arguments of type LefRul or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the LefRulRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinLefRulRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('LefRulRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'LefRulRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the LefRulRelatedByUpdatedBy relation LefRul object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\LefRulQuery A secondary query class using the current class as primary query
     */
    public function useLefRulRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinLefRulRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'LefRulRelatedByUpdatedBy', '\Kzf\Model\LefRulQuery');
    }

    /**
     * Filter the query by a related RulOption object
     *
     * @param   RulOption|PropelObjectCollection $rulOption  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRulOptionRelatedByCreatedBy($rulOption, $comparison = null)
    {
        if ($rulOption instanceof RulOption) {
            return $this
                ->addUsingAlias(UserPeer::ID, $rulOption->getCreatedBy(), $comparison);
        } elseif ($rulOption instanceof PropelObjectCollection) {
            return $this
                ->useRulOptionRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($rulOption->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRulOptionRelatedByCreatedBy() only accepts arguments of type RulOption or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RulOptionRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinRulOptionRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RulOptionRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'RulOptionRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the RulOptionRelatedByCreatedBy relation RulOption object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\RulOptionQuery A secondary query class using the current class as primary query
     */
    public function useRulOptionRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRulOptionRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RulOptionRelatedByCreatedBy', '\Kzf\Model\RulOptionQuery');
    }

    /**
     * Filter the query by a related RulOption object
     *
     * @param   RulOption|PropelObjectCollection $rulOption  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRulOptionRelatedByUpdatedBy($rulOption, $comparison = null)
    {
        if ($rulOption instanceof RulOption) {
            return $this
                ->addUsingAlias(UserPeer::ID, $rulOption->getUpdatedBy(), $comparison);
        } elseif ($rulOption instanceof PropelObjectCollection) {
            return $this
                ->useRulOptionRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($rulOption->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRulOptionRelatedByUpdatedBy() only accepts arguments of type RulOption or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RulOptionRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinRulOptionRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RulOptionRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'RulOptionRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the RulOptionRelatedByUpdatedBy relation RulOption object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\RulOptionQuery A secondary query class using the current class as primary query
     */
    public function useRulOptionRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRulOptionRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RulOptionRelatedByUpdatedBy', '\Kzf\Model\RulOptionQuery');
    }

    /**
     * Filter the query by a related Rule object
     *
     * @param   Rule|PropelObjectCollection $rule  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRuleRelatedByCreatedBy($rule, $comparison = null)
    {
        if ($rule instanceof Rule) {
            return $this
                ->addUsingAlias(UserPeer::ID, $rule->getCreatedBy(), $comparison);
        } elseif ($rule instanceof PropelObjectCollection) {
            return $this
                ->useRuleRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($rule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRuleRelatedByCreatedBy() only accepts arguments of type Rule or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RuleRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinRuleRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RuleRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'RuleRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the RuleRelatedByCreatedBy relation Rule object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\RuleQuery A secondary query class using the current class as primary query
     */
    public function useRuleRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRuleRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RuleRelatedByCreatedBy', '\Kzf\Model\RuleQuery');
    }

    /**
     * Filter the query by a related Rule object
     *
     * @param   Rule|PropelObjectCollection $rule  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByRuleRelatedByUpdatedBy($rule, $comparison = null)
    {
        if ($rule instanceof Rule) {
            return $this
                ->addUsingAlias(UserPeer::ID, $rule->getUpdatedBy(), $comparison);
        } elseif ($rule instanceof PropelObjectCollection) {
            return $this
                ->useRuleRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($rule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByRuleRelatedByUpdatedBy() only accepts arguments of type Rule or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the RuleRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinRuleRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('RuleRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'RuleRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the RuleRelatedByUpdatedBy relation Rule object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\RuleQuery A secondary query class using the current class as primary query
     */
    public function useRuleRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinRuleRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'RuleRelatedByUpdatedBy', '\Kzf\Model\RuleQuery');
    }

    /**
     * Filter the query by a related Template object
     *
     * @param   Template|PropelObjectCollection $template  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTemplateRelatedByCreatedBy($template, $comparison = null)
    {
        if ($template instanceof Template) {
            return $this
                ->addUsingAlias(UserPeer::ID, $template->getCreatedBy(), $comparison);
        } elseif ($template instanceof PropelObjectCollection) {
            return $this
                ->useTemplateRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($template->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTemplateRelatedByCreatedBy() only accepts arguments of type Template or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TemplateRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinTemplateRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TemplateRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'TemplateRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the TemplateRelatedByCreatedBy relation Template object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\TemplateQuery A secondary query class using the current class as primary query
     */
    public function useTemplateRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTemplateRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TemplateRelatedByCreatedBy', '\Kzf\Model\TemplateQuery');
    }

    /**
     * Filter the query by a related Template object
     *
     * @param   Template|PropelObjectCollection $template  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTemplateRelatedByUpdatedBy($template, $comparison = null)
    {
        if ($template instanceof Template) {
            return $this
                ->addUsingAlias(UserPeer::ID, $template->getUpdatedBy(), $comparison);
        } elseif ($template instanceof PropelObjectCollection) {
            return $this
                ->useTemplateRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($template->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTemplateRelatedByUpdatedBy() only accepts arguments of type Template or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TemplateRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinTemplateRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TemplateRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'TemplateRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the TemplateRelatedByUpdatedBy relation Template object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\TemplateQuery A secondary query class using the current class as primary query
     */
    public function useTemplateRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTemplateRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TemplateRelatedByUpdatedBy', '\Kzf\Model\TemplateQuery');
    }

    /**
     * Filter the query by a related TypeRule object
     *
     * @param   TypeRule|PropelObjectCollection $typeRule  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTypeRuleRelatedByCreatedBy($typeRule, $comparison = null)
    {
        if ($typeRule instanceof TypeRule) {
            return $this
                ->addUsingAlias(UserPeer::ID, $typeRule->getCreatedBy(), $comparison);
        } elseif ($typeRule instanceof PropelObjectCollection) {
            return $this
                ->useTypeRuleRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($typeRule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTypeRuleRelatedByCreatedBy() only accepts arguments of type TypeRule or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TypeRuleRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinTypeRuleRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TypeRuleRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'TypeRuleRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the TypeRuleRelatedByCreatedBy relation TypeRule object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\TypeRuleQuery A secondary query class using the current class as primary query
     */
    public function useTypeRuleRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTypeRuleRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeRuleRelatedByCreatedBy', '\Kzf\Model\TypeRuleQuery');
    }

    /**
     * Filter the query by a related TypeRule object
     *
     * @param   TypeRule|PropelObjectCollection $typeRule  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByTypeRuleRelatedByUpdatedBy($typeRule, $comparison = null)
    {
        if ($typeRule instanceof TypeRule) {
            return $this
                ->addUsingAlias(UserPeer::ID, $typeRule->getUpdatedBy(), $comparison);
        } elseif ($typeRule instanceof PropelObjectCollection) {
            return $this
                ->useTypeRuleRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($typeRule->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByTypeRuleRelatedByUpdatedBy() only accepts arguments of type TypeRule or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the TypeRuleRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinTypeRuleRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('TypeRuleRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'TypeRuleRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the TypeRuleRelatedByUpdatedBy relation TypeRule object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\TypeRuleQuery A secondary query class using the current class as primary query
     */
    public function useTypeRuleRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinTypeRuleRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'TypeRuleRelatedByUpdatedBy', '\Kzf\Model\TypeRuleQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedById0($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(UserPeer::ID, $user->getCreatedBy(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            return $this
                ->useUserRelatedById0Query()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserRelatedById0() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedById0 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinUserRelatedById0($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedById0');

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
            $this->addJoinObject($join, 'UserRelatedById0');
        }

        return $this;
    }

    /**
     * Use the UserRelatedById0 relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedById0Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedById0($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedById0', '\Kzf\Model\UserQuery');
    }

    /**
     * Filter the query by a related User object
     *
     * @param   User|PropelObjectCollection $user  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUserRelatedById1($user, $comparison = null)
    {
        if ($user instanceof User) {
            return $this
                ->addUsingAlias(UserPeer::ID, $user->getUpdatedBy(), $comparison);
        } elseif ($user instanceof PropelObjectCollection) {
            return $this
                ->useUserRelatedById1Query()
                ->filterByPrimaryKeys($user->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserRelatedById1() only accepts arguments of type User or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserRelatedById1 relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinUserRelatedById1($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserRelatedById1');

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
            $this->addJoinObject($join, 'UserRelatedById1');
        }

        return $this;
    }

    /**
     * Use the UserRelatedById1 relation User object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\UserQuery A secondary query class using the current class as primary query
     */
    public function useUserRelatedById1Query($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUserRelatedById1($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserRelatedById1', '\Kzf\Model\UserQuery');
    }

    /**
     * Filter the query by a related UsrCre object
     *
     * @param   UsrCre|PropelObjectCollection $usrCre  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsrCreRelatedByUsrId($usrCre, $comparison = null)
    {
        if ($usrCre instanceof UsrCre) {
            return $this
                ->addUsingAlias(UserPeer::ID, $usrCre->getUsrId(), $comparison);
        } elseif ($usrCre instanceof PropelObjectCollection) {
            return $this
                ->useUsrCreRelatedByUsrIdQuery()
                ->filterByPrimaryKeys($usrCre->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsrCreRelatedByUsrId() only accepts arguments of type UsrCre or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsrCreRelatedByUsrId relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinUsrCreRelatedByUsrId($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsrCreRelatedByUsrId');

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
            $this->addJoinObject($join, 'UsrCreRelatedByUsrId');
        }

        return $this;
    }

    /**
     * Use the UsrCreRelatedByUsrId relation UsrCre object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\UsrCreQuery A secondary query class using the current class as primary query
     */
    public function useUsrCreRelatedByUsrIdQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsrCreRelatedByUsrId($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsrCreRelatedByUsrId', '\Kzf\Model\UsrCreQuery');
    }

    /**
     * Filter the query by a related UsrCre object
     *
     * @param   UsrCre|PropelObjectCollection $usrCre  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsrCreRelatedByCreatedBy($usrCre, $comparison = null)
    {
        if ($usrCre instanceof UsrCre) {
            return $this
                ->addUsingAlias(UserPeer::ID, $usrCre->getCreatedBy(), $comparison);
        } elseif ($usrCre instanceof PropelObjectCollection) {
            return $this
                ->useUsrCreRelatedByCreatedByQuery()
                ->filterByPrimaryKeys($usrCre->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsrCreRelatedByCreatedBy() only accepts arguments of type UsrCre or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsrCreRelatedByCreatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinUsrCreRelatedByCreatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsrCreRelatedByCreatedBy');

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
            $this->addJoinObject($join, 'UsrCreRelatedByCreatedBy');
        }

        return $this;
    }

    /**
     * Use the UsrCreRelatedByCreatedBy relation UsrCre object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\UsrCreQuery A secondary query class using the current class as primary query
     */
    public function useUsrCreRelatedByCreatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsrCreRelatedByCreatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsrCreRelatedByCreatedBy', '\Kzf\Model\UsrCreQuery');
    }

    /**
     * Filter the query by a related UsrCre object
     *
     * @param   UsrCre|PropelObjectCollection $usrCre  the related object to use as filter
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return                 UserQuery The current query, for fluid interface
     * @throws PropelException - if the provided filter is invalid.
     */
    public function filterByUsrCreRelatedByUpdatedBy($usrCre, $comparison = null)
    {
        if ($usrCre instanceof UsrCre) {
            return $this
                ->addUsingAlias(UserPeer::ID, $usrCre->getUpdatedBy(), $comparison);
        } elseif ($usrCre instanceof PropelObjectCollection) {
            return $this
                ->useUsrCreRelatedByUpdatedByQuery()
                ->filterByPrimaryKeys($usrCre->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUsrCreRelatedByUpdatedBy() only accepts arguments of type UsrCre or PropelCollection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UsrCreRelatedByUpdatedBy relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function joinUsrCreRelatedByUpdatedBy($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UsrCreRelatedByUpdatedBy');

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
            $this->addJoinObject($join, 'UsrCreRelatedByUpdatedBy');
        }

        return $this;
    }

    /**
     * Use the UsrCreRelatedByUpdatedBy relation UsrCre object
     *
     * @see       useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return   \Kzf\Model\UsrCreQuery A secondary query class using the current class as primary query
     */
    public function useUsrCreRelatedByUpdatedByQuery($relationAlias = null, $joinType = Criteria::LEFT_JOIN)
    {
        return $this
            ->joinUsrCreRelatedByUpdatedBy($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UsrCreRelatedByUpdatedBy', '\Kzf\Model\UsrCreQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   User $user Object to remove from the list of results
     *
     * @return UserQuery The current query, for fluid interface
     */
    public function prune($user = null)
    {
        if ($user) {
            $this->addUsingAlias(UserPeer::ID, $user->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(UserPeer::UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserPeer::UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserPeer::UPDATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(UserPeer::CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date desc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(UserPeer::CREATED_AT);
    }

    /**
     * Order by create date asc
     *
     * @return     UserQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(UserPeer::CREATED_AT);
    }
}

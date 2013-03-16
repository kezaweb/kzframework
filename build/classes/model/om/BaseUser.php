<?php

namespace Kzf\Model\om;

use \BaseObject;
use \BasePeer;
use \Criteria;
use \DateTime;
use \Exception;
use \PDO;
use \Persistent;
use \Propel;
use \PropelCollection;
use \PropelDateTime;
use \PropelException;
use \PropelObjectCollection;
use \PropelPDO;
use Kzf\Model\BchRul;
use Kzf\Model\BchRulQuery;
use Kzf\Model\Branch;
use Kzf\Model\BranchQuery;
use Kzf\Model\Credential;
use Kzf\Model\CredentialQuery;
use Kzf\Model\Leaf;
use Kzf\Model\LeafQuery;
use Kzf\Model\LefRul;
use Kzf\Model\LefRulQuery;
use Kzf\Model\NodeTree;
use Kzf\Model\NodeTreeQuery;
use Kzf\Model\RulOption;
use Kzf\Model\RulOptionQuery;
use Kzf\Model\Rule;
use Kzf\Model\RuleQuery;
use Kzf\Model\Template;
use Kzf\Model\TemplateQuery;
use Kzf\Model\TypeRule;
use Kzf\Model\TypeRuleQuery;
use Kzf\Model\User;
use Kzf\Model\UserPeer;
use Kzf\Model\UserQuery;
use Kzf\Model\UsrCre;
use Kzf\Model\UsrCreQuery;

/**
 * Base class that represents a row from the 'user' table.
 *
 *
 *
 * @package    propel.generator.model.om
 */
abstract class BaseUser extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Kzf\\Model\\UserPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        UserPeer
     */
    protected static $peer;

    /**
     * The flag var to prevent infinit loop in deep copy
     * @var       boolean
     */
    protected $startCopy = false;

    /**
     * The value for the id field.
     * @var        int
     */
    protected $id;

    /**
     * The value for the usr_first_name field.
     * @var        string
     */
    protected $usr_first_name;

    /**
     * The value for the usr_last_name field.
     * @var        string
     */
    protected $usr_last_name;

    /**
     * The value for the usr_login field.
     * @var        string
     */
    protected $usr_login;

    /**
     * The value for the usr_password field.
     * @var        string
     */
    protected $usr_password;

    /**
     * The value for the usr_cp field.
     * @var        int
     */
    protected $usr_cp;

    /**
     * The value for the usr_avatar field.
     * @var        string
     */
    protected $usr_avatar;

    /**
     * The value for the created_by field.
     * @var        int
     */
    protected $created_by;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_by field.
     * @var        int
     */
    protected $updated_by;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        User
     */
    protected $aUserRelatedByCreatedBy;

    /**
     * @var        User
     */
    protected $aUserRelatedByUpdatedBy;

    /**
     * @var        PropelObjectCollection|BchRul[] Collection to store aggregation of BchRul objects.
     */
    protected $collBchRulsRelatedByCreatedBy;
    protected $collBchRulsRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|BchRul[] Collection to store aggregation of BchRul objects.
     */
    protected $collBchRulsRelatedByUpdatedBy;
    protected $collBchRulsRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|Branch[] Collection to store aggregation of Branch objects.
     */
    protected $collBranchsRelatedByCreatedBy;
    protected $collBranchsRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|Branch[] Collection to store aggregation of Branch objects.
     */
    protected $collBranchsRelatedByUpdatedBy;
    protected $collBranchsRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|Credential[] Collection to store aggregation of Credential objects.
     */
    protected $collCredentialsRelatedByCreatedBy;
    protected $collCredentialsRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|Credential[] Collection to store aggregation of Credential objects.
     */
    protected $collCredentialsRelatedByUpdatedBy;
    protected $collCredentialsRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|Leaf[] Collection to store aggregation of Leaf objects.
     */
    protected $collLeafsRelatedByCreatedBy;
    protected $collLeafsRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|Leaf[] Collection to store aggregation of Leaf objects.
     */
    protected $collLeafsRelatedByUpdatedBy;
    protected $collLeafsRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|LefRul[] Collection to store aggregation of LefRul objects.
     */
    protected $collLefRulsRelatedByCreatedBy;
    protected $collLefRulsRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|LefRul[] Collection to store aggregation of LefRul objects.
     */
    protected $collLefRulsRelatedByUpdatedBy;
    protected $collLefRulsRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|NodeTree[] Collection to store aggregation of NodeTree objects.
     */
    protected $collNodeTreesRelatedByCreatedBy;
    protected $collNodeTreesRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|NodeTree[] Collection to store aggregation of NodeTree objects.
     */
    protected $collNodeTreesRelatedByUpdatedBy;
    protected $collNodeTreesRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|RulOption[] Collection to store aggregation of RulOption objects.
     */
    protected $collRulOptionsRelatedByCreatedBy;
    protected $collRulOptionsRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|RulOption[] Collection to store aggregation of RulOption objects.
     */
    protected $collRulOptionsRelatedByUpdatedBy;
    protected $collRulOptionsRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|Rule[] Collection to store aggregation of Rule objects.
     */
    protected $collRulesRelatedByCreatedBy;
    protected $collRulesRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|Rule[] Collection to store aggregation of Rule objects.
     */
    protected $collRulesRelatedByUpdatedBy;
    protected $collRulesRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|Template[] Collection to store aggregation of Template objects.
     */
    protected $collTemplatesRelatedByCreatedBy;
    protected $collTemplatesRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|Template[] Collection to store aggregation of Template objects.
     */
    protected $collTemplatesRelatedByUpdatedBy;
    protected $collTemplatesRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|TypeRule[] Collection to store aggregation of TypeRule objects.
     */
    protected $collTypeRulesRelatedByCreatedBy;
    protected $collTypeRulesRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|TypeRule[] Collection to store aggregation of TypeRule objects.
     */
    protected $collTypeRulesRelatedByUpdatedBy;
    protected $collTypeRulesRelatedByUpdatedByPartial;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsersRelatedById0;
    protected $collUsersRelatedById0Partial;

    /**
     * @var        PropelObjectCollection|User[] Collection to store aggregation of User objects.
     */
    protected $collUsersRelatedById1;
    protected $collUsersRelatedById1Partial;

    /**
     * @var        PropelObjectCollection|UsrCre[] Collection to store aggregation of UsrCre objects.
     */
    protected $collUsrCresRelatedByUsrId;
    protected $collUsrCresRelatedByUsrIdPartial;

    /**
     * @var        PropelObjectCollection|UsrCre[] Collection to store aggregation of UsrCre objects.
     */
    protected $collUsrCresRelatedByCreatedBy;
    protected $collUsrCresRelatedByCreatedByPartial;

    /**
     * @var        PropelObjectCollection|UsrCre[] Collection to store aggregation of UsrCre objects.
     */
    protected $collUsrCresRelatedByUpdatedBy;
    protected $collUsrCresRelatedByUpdatedByPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInSave = false;

    /**
     * Flag to prevent endless validation loop, if this object is referenced
     * by another object which falls in this transaction.
     * @var        boolean
     */
    protected $alreadyInValidation = false;

    /**
     * Flag to prevent endless clearAllReferences($deep=true) loop, if this object is referenced
     * @var        boolean
     */
    protected $alreadyInClearAllReferencesDeep = false;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bchRulsRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $bchRulsRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $branchsRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $branchsRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $credentialsRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $credentialsRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leafsRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $leafsRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $lefRulsRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $lefRulsRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nodeTreesRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nodeTreesRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $rulOptionsRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $rulOptionsRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $rulesRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $rulesRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templatesRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $templatesRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $typeRulesRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $typeRulesRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usersRelatedById0ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usersRelatedById1ScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usrCresRelatedByUsrIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usrCresRelatedByCreatedByScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $usrCresRelatedByUpdatedByScheduledForDeletion = null;

    /**
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [usr_first_name] column value.
     *
     * @return string
     */
    public function getUsrFirstName()
    {
        return $this->usr_first_name;
    }

    /**
     * Get the [usr_last_name] column value.
     *
     * @return string
     */
    public function getUsrLastName()
    {
        return $this->usr_last_name;
    }

    /**
     * Get the [usr_login] column value.
     *
     * @return string
     */
    public function getUsrLogin()
    {
        return $this->usr_login;
    }

    /**
     * Get the [usr_password] column value.
     *
     * @return string
     */
    public function getUsrPassword()
    {
        return $this->usr_password;
    }

    /**
     * Get the [usr_cp] column value.
     *
     * @return int
     */
    public function getUsrCp()
    {
        return $this->usr_cp;
    }

    /**
     * Get the [usr_avatar] column value.
     *
     * @return string
     */
    public function getUsrAvatar()
    {
        return $this->usr_avatar;
    }

    /**
     * Get the [created_by] column value.
     *
     * @return int
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * Get the [optionally formatted] temporal [created_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getCreatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->created_at === null) {
            return null;
        }

        if ($this->created_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->created_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->created_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Get the [updated_by] column value.
     *
     * @return int
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
    }

    /**
     * Get the [optionally formatted] temporal [updated_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getUpdatedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->updated_at === null) {
            return null;
        }

        if ($this->updated_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->updated_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at, true), $x);
        }

        if ($format === null) {
            // Because propel.useDateTimeClass is true, we return a DateTime object.
            return $dt;
        }

        if (strpos($format, '%') !== false) {
            return strftime($format, $dt->format('U'));
        }

        return $dt->format($format);

    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = UserPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [usr_first_name] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUsrFirstName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->usr_first_name !== $v) {
            $this->usr_first_name = $v;
            $this->modifiedColumns[] = UserPeer::USR_FIRST_NAME;
        }


        return $this;
    } // setUsrFirstName()

    /**
     * Set the value of [usr_last_name] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUsrLastName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->usr_last_name !== $v) {
            $this->usr_last_name = $v;
            $this->modifiedColumns[] = UserPeer::USR_LAST_NAME;
        }


        return $this;
    } // setUsrLastName()

    /**
     * Set the value of [usr_login] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUsrLogin($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->usr_login !== $v) {
            $this->usr_login = $v;
            $this->modifiedColumns[] = UserPeer::USR_LOGIN;
        }


        return $this;
    } // setUsrLogin()

    /**
     * Set the value of [usr_password] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUsrPassword($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->usr_password !== $v) {
            $this->usr_password = $v;
            $this->modifiedColumns[] = UserPeer::USR_PASSWORD;
        }


        return $this;
    } // setUsrPassword()

    /**
     * Set the value of [usr_cp] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUsrCp($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->usr_cp !== $v) {
            $this->usr_cp = $v;
            $this->modifiedColumns[] = UserPeer::USR_CP;
        }


        return $this;
    } // setUsrCp()

    /**
     * Set the value of [usr_avatar] column.
     *
     * @param string $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUsrAvatar($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->usr_avatar !== $v) {
            $this->usr_avatar = $v;
            $this->modifiedColumns[] = UserPeer::USR_AVATAR;
        }


        return $this;
    } // setUsrAvatar()

    /**
     * Set the value of [created_by] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setCreatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->created_by !== $v) {
            $this->created_by = $v;
            $this->modifiedColumns[] = UserPeer::CREATED_BY;
        }

        if ($this->aUserRelatedByCreatedBy !== null && $this->aUserRelatedByCreatedBy->getId() !== $v) {
            $this->aUserRelatedByCreatedBy = null;
        }


        return $this;
    } // setCreatedBy()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Set the value of [updated_by] column.
     *
     * @param int $v new value
     * @return User The current object (for fluent API support)
     */
    public function setUpdatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->updated_by !== $v) {
            $this->updated_by = $v;
            $this->modifiedColumns[] = UserPeer::UPDATED_BY;
        }

        if ($this->aUserRelatedByUpdatedBy !== null && $this->aUserRelatedByUpdatedBy->getId() !== $v) {
            $this->aUserRelatedByUpdatedBy = null;
        }


        return $this;
    } // setUpdatedBy()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return User The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = UserPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return true
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
     * @param int $startcol 0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false)
    {
        try {

            $this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
            $this->usr_first_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->usr_last_name = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->usr_login = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->usr_password = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
            $this->usr_cp = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->usr_avatar = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->created_by = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->created_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->updated_by = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
            $this->updated_at = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 11; // 11 = UserPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating User object", $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {

        if ($this->aUserRelatedByCreatedBy !== null && $this->created_by !== $this->aUserRelatedByCreatedBy->getId()) {
            $this->aUserRelatedByCreatedBy = null;
        }
        if ($this->aUserRelatedByUpdatedBy !== null && $this->updated_by !== $this->aUserRelatedByUpdatedBy->getId()) {
            $this->aUserRelatedByUpdatedBy = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param boolean $deep (optional) Whether to also de-associated any related objects.
     * @param PropelPDO $con (optional) The PropelPDO connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = UserPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRelatedByCreatedBy = null;
            $this->aUserRelatedByUpdatedBy = null;
            $this->collBchRulsRelatedByCreatedBy = null;

            $this->collBchRulsRelatedByUpdatedBy = null;

            $this->collBranchsRelatedByCreatedBy = null;

            $this->collBranchsRelatedByUpdatedBy = null;

            $this->collCredentialsRelatedByCreatedBy = null;

            $this->collCredentialsRelatedByUpdatedBy = null;

            $this->collLeafsRelatedByCreatedBy = null;

            $this->collLeafsRelatedByUpdatedBy = null;

            $this->collLefRulsRelatedByCreatedBy = null;

            $this->collLefRulsRelatedByUpdatedBy = null;

            $this->collNodeTreesRelatedByCreatedBy = null;

            $this->collNodeTreesRelatedByUpdatedBy = null;

            $this->collRulOptionsRelatedByCreatedBy = null;

            $this->collRulOptionsRelatedByUpdatedBy = null;

            $this->collRulesRelatedByCreatedBy = null;

            $this->collRulesRelatedByUpdatedBy = null;

            $this->collTemplatesRelatedByCreatedBy = null;

            $this->collTemplatesRelatedByUpdatedBy = null;

            $this->collTypeRulesRelatedByCreatedBy = null;

            $this->collTypeRulesRelatedByUpdatedBy = null;

            $this->collUsersRelatedById0 = null;

            $this->collUsersRelatedById1 = null;

            $this->collUsrCresRelatedByUsrId = null;

            $this->collUsrCresRelatedByCreatedBy = null;

            $this->collUsrCresRelatedByUpdatedBy = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param PropelPDO $con
     * @return void
     * @throws PropelException
     * @throws Exception
     * @see        BaseObject::setDeleted()
     * @see        BaseObject::isDeleted()
     */
    public function delete(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = UserQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $con->commit();
                $this->setDeleted(true);
            } else {
                $con->commit();
            }
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @throws Exception
     * @see        doSave()
     */
    public function save(PropelPDO $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getConnection(UserPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                UserPeer::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }
            $con->commit();

            return $affectedRows;
        } catch (Exception $e) {
            $con->rollBack();
            throw $e;
        }
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param PropelPDO $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see        save()
     */
    protected function doSave(PropelPDO $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByCreatedBy !== null) {
                if ($this->aUserRelatedByCreatedBy->isModified() || $this->aUserRelatedByCreatedBy->isNew()) {
                    $affectedRows += $this->aUserRelatedByCreatedBy->save($con);
                }
                $this->setUserRelatedByCreatedBy($this->aUserRelatedByCreatedBy);
            }

            if ($this->aUserRelatedByUpdatedBy !== null) {
                if ($this->aUserRelatedByUpdatedBy->isModified() || $this->aUserRelatedByUpdatedBy->isNew()) {
                    $affectedRows += $this->aUserRelatedByUpdatedBy->save($con);
                }
                $this->setUserRelatedByUpdatedBy($this->aUserRelatedByUpdatedBy);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                } else {
                    $this->doUpdate($con);
                }
                $affectedRows += 1;
                $this->resetModified();
            }

            if ($this->bchRulsRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->bchRulsRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->bchRulsRelatedByCreatedByScheduledForDeletion as $bchRulRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $bchRulRelatedByCreatedBy->save($con);
                    }
                    $this->bchRulsRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collBchRulsRelatedByCreatedBy !== null) {
                foreach ($this->collBchRulsRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->bchRulsRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->bchRulsRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->bchRulsRelatedByUpdatedByScheduledForDeletion as $bchRulRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $bchRulRelatedByUpdatedBy->save($con);
                    }
                    $this->bchRulsRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collBchRulsRelatedByUpdatedBy !== null) {
                foreach ($this->collBchRulsRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->branchsRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->branchsRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->branchsRelatedByCreatedByScheduledForDeletion as $branchRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $branchRelatedByCreatedBy->save($con);
                    }
                    $this->branchsRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collBranchsRelatedByCreatedBy !== null) {
                foreach ($this->collBranchsRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->branchsRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->branchsRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->branchsRelatedByUpdatedByScheduledForDeletion as $branchRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $branchRelatedByUpdatedBy->save($con);
                    }
                    $this->branchsRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collBranchsRelatedByUpdatedBy !== null) {
                foreach ($this->collBranchsRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->credentialsRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->credentialsRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->credentialsRelatedByCreatedByScheduledForDeletion as $credentialRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $credentialRelatedByCreatedBy->save($con);
                    }
                    $this->credentialsRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collCredentialsRelatedByCreatedBy !== null) {
                foreach ($this->collCredentialsRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->credentialsRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->credentialsRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->credentialsRelatedByUpdatedByScheduledForDeletion as $credentialRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $credentialRelatedByUpdatedBy->save($con);
                    }
                    $this->credentialsRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collCredentialsRelatedByUpdatedBy !== null) {
                foreach ($this->collCredentialsRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leafsRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->leafsRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->leafsRelatedByCreatedByScheduledForDeletion as $leafRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $leafRelatedByCreatedBy->save($con);
                    }
                    $this->leafsRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collLeafsRelatedByCreatedBy !== null) {
                foreach ($this->collLeafsRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->leafsRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->leafsRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->leafsRelatedByUpdatedByScheduledForDeletion as $leafRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $leafRelatedByUpdatedBy->save($con);
                    }
                    $this->leafsRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collLeafsRelatedByUpdatedBy !== null) {
                foreach ($this->collLeafsRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lefRulsRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->lefRulsRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->lefRulsRelatedByCreatedByScheduledForDeletion as $lefRulRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $lefRulRelatedByCreatedBy->save($con);
                    }
                    $this->lefRulsRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collLefRulsRelatedByCreatedBy !== null) {
                foreach ($this->collLefRulsRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->lefRulsRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->lefRulsRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->lefRulsRelatedByUpdatedByScheduledForDeletion as $lefRulRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $lefRulRelatedByUpdatedBy->save($con);
                    }
                    $this->lefRulsRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collLefRulsRelatedByUpdatedBy !== null) {
                foreach ($this->collLefRulsRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nodeTreesRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->nodeTreesRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->nodeTreesRelatedByCreatedByScheduledForDeletion as $nodeTreeRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $nodeTreeRelatedByCreatedBy->save($con);
                    }
                    $this->nodeTreesRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collNodeTreesRelatedByCreatedBy !== null) {
                foreach ($this->collNodeTreesRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nodeTreesRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->nodeTreesRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->nodeTreesRelatedByUpdatedByScheduledForDeletion as $nodeTreeRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $nodeTreeRelatedByUpdatedBy->save($con);
                    }
                    $this->nodeTreesRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collNodeTreesRelatedByUpdatedBy !== null) {
                foreach ($this->collNodeTreesRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->rulOptionsRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->rulOptionsRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->rulOptionsRelatedByCreatedByScheduledForDeletion as $rulOptionRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $rulOptionRelatedByCreatedBy->save($con);
                    }
                    $this->rulOptionsRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collRulOptionsRelatedByCreatedBy !== null) {
                foreach ($this->collRulOptionsRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->rulOptionsRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->rulOptionsRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->rulOptionsRelatedByUpdatedByScheduledForDeletion as $rulOptionRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $rulOptionRelatedByUpdatedBy->save($con);
                    }
                    $this->rulOptionsRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collRulOptionsRelatedByUpdatedBy !== null) {
                foreach ($this->collRulOptionsRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->rulesRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->rulesRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->rulesRelatedByCreatedByScheduledForDeletion as $ruleRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $ruleRelatedByCreatedBy->save($con);
                    }
                    $this->rulesRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collRulesRelatedByCreatedBy !== null) {
                foreach ($this->collRulesRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->rulesRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->rulesRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->rulesRelatedByUpdatedByScheduledForDeletion as $ruleRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $ruleRelatedByUpdatedBy->save($con);
                    }
                    $this->rulesRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collRulesRelatedByUpdatedBy !== null) {
                foreach ($this->collRulesRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templatesRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->templatesRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->templatesRelatedByCreatedByScheduledForDeletion as $templateRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $templateRelatedByCreatedBy->save($con);
                    }
                    $this->templatesRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collTemplatesRelatedByCreatedBy !== null) {
                foreach ($this->collTemplatesRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->templatesRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->templatesRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->templatesRelatedByUpdatedByScheduledForDeletion as $templateRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $templateRelatedByUpdatedBy->save($con);
                    }
                    $this->templatesRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collTemplatesRelatedByUpdatedBy !== null) {
                foreach ($this->collTemplatesRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->typeRulesRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->typeRulesRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->typeRulesRelatedByCreatedByScheduledForDeletion as $typeRuleRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $typeRuleRelatedByCreatedBy->save($con);
                    }
                    $this->typeRulesRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collTypeRulesRelatedByCreatedBy !== null) {
                foreach ($this->collTypeRulesRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->typeRulesRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->typeRulesRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->typeRulesRelatedByUpdatedByScheduledForDeletion as $typeRuleRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $typeRuleRelatedByUpdatedBy->save($con);
                    }
                    $this->typeRulesRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collTypeRulesRelatedByUpdatedBy !== null) {
                foreach ($this->collTypeRulesRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usersRelatedById0ScheduledForDeletion !== null) {
                if (!$this->usersRelatedById0ScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersRelatedById0ScheduledForDeletion as $userRelatedById0) {
                        // need to save related object because we set the relation to null
                        $userRelatedById0->save($con);
                    }
                    $this->usersRelatedById0ScheduledForDeletion = null;
                }
            }

            if ($this->collUsersRelatedById0 !== null) {
                foreach ($this->collUsersRelatedById0 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usersRelatedById1ScheduledForDeletion !== null) {
                if (!$this->usersRelatedById1ScheduledForDeletion->isEmpty()) {
                    foreach ($this->usersRelatedById1ScheduledForDeletion as $userRelatedById1) {
                        // need to save related object because we set the relation to null
                        $userRelatedById1->save($con);
                    }
                    $this->usersRelatedById1ScheduledForDeletion = null;
                }
            }

            if ($this->collUsersRelatedById1 !== null) {
                foreach ($this->collUsersRelatedById1 as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usrCresRelatedByUsrIdScheduledForDeletion !== null) {
                if (!$this->usrCresRelatedByUsrIdScheduledForDeletion->isEmpty()) {
                    UsrCreQuery::create()
                        ->filterByPrimaryKeys($this->usrCresRelatedByUsrIdScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->usrCresRelatedByUsrIdScheduledForDeletion = null;
                }
            }

            if ($this->collUsrCresRelatedByUsrId !== null) {
                foreach ($this->collUsrCresRelatedByUsrId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usrCresRelatedByCreatedByScheduledForDeletion !== null) {
                if (!$this->usrCresRelatedByCreatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->usrCresRelatedByCreatedByScheduledForDeletion as $usrCreRelatedByCreatedBy) {
                        // need to save related object because we set the relation to null
                        $usrCreRelatedByCreatedBy->save($con);
                    }
                    $this->usrCresRelatedByCreatedByScheduledForDeletion = null;
                }
            }

            if ($this->collUsrCresRelatedByCreatedBy !== null) {
                foreach ($this->collUsrCresRelatedByCreatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->usrCresRelatedByUpdatedByScheduledForDeletion !== null) {
                if (!$this->usrCresRelatedByUpdatedByScheduledForDeletion->isEmpty()) {
                    foreach ($this->usrCresRelatedByUpdatedByScheduledForDeletion as $usrCreRelatedByUpdatedBy) {
                        // need to save related object because we set the relation to null
                        $usrCreRelatedByUpdatedBy->save($con);
                    }
                    $this->usrCresRelatedByUpdatedByScheduledForDeletion = null;
                }
            }

            if ($this->collUsrCresRelatedByUpdatedBy !== null) {
                foreach ($this->collUsrCresRelatedByUpdatedBy as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param PropelPDO $con
     *
     * @throws PropelException
     * @see        doSave()
     */
    protected function doInsert(PropelPDO $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[] = UserPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . UserPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(UserPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(UserPeer::USR_FIRST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'usr_first_name';
        }
        if ($this->isColumnModified(UserPeer::USR_LAST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'usr_last_name';
        }
        if ($this->isColumnModified(UserPeer::USR_LOGIN)) {
            $modifiedColumns[':p' . $index++]  = 'usr_login';
        }
        if ($this->isColumnModified(UserPeer::USR_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'usr_password';
        }
        if ($this->isColumnModified(UserPeer::USR_CP)) {
            $modifiedColumns[':p' . $index++]  = 'usr_cp';
        }
        if ($this->isColumnModified(UserPeer::USR_AVATAR)) {
            $modifiedColumns[':p' . $index++]  = 'usr_avatar';
        }
        if ($this->isColumnModified(UserPeer::CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'created_by';
        }
        if ($this->isColumnModified(UserPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(UserPeer::UPDATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'updated_by';
        }
        if ($this->isColumnModified(UserPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO user (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'usr_first_name':
                        $stmt->bindValue($identifier, $this->usr_first_name, PDO::PARAM_STR);
                        break;
                    case 'usr_last_name':
                        $stmt->bindValue($identifier, $this->usr_last_name, PDO::PARAM_STR);
                        break;
                    case 'usr_login':
                        $stmt->bindValue($identifier, $this->usr_login, PDO::PARAM_STR);
                        break;
                    case 'usr_password':
                        $stmt->bindValue($identifier, $this->usr_password, PDO::PARAM_STR);
                        break;
                    case 'usr_cp':
                        $stmt->bindValue($identifier, $this->usr_cp, PDO::PARAM_INT);
                        break;
                    case 'usr_avatar':
                        $stmt->bindValue($identifier, $this->usr_avatar, PDO::PARAM_STR);
                        break;
                    case 'created_by':
                        $stmt->bindValue($identifier, $this->created_by, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
                        break;
                    case 'updated_by':
                        $stmt->bindValue($identifier, $this->updated_by, PDO::PARAM_INT);
                        break;
                    case 'updated_at':
                        $stmt->bindValue($identifier, $this->updated_at, PDO::PARAM_STR);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param PropelPDO $con
     *
     * @see        doSave()
     */
    protected function doUpdate(PropelPDO $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();
        BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
    }

    /**
     * Array of ValidationFailed objects.
     * @var        array ValidationFailed[]
     */
    protected $validationFailures = array();

    /**
     * Gets any ValidationFailed objects that resulted from last call to validate().
     *
     *
     * @return array ValidationFailed[]
     * @see        validate()
     */
    public function getValidationFailures()
    {
        return $this->validationFailures;
    }

    /**
     * Validates the objects modified field values and all objects related to this table.
     *
     * If $columns is either a column name or an array of column names
     * only those columns are validated.
     *
     * @param mixed $columns Column name or an array of column names.
     * @return boolean Whether all columns pass validation.
     * @see        doValidate()
     * @see        getValidationFailures()
     */
    public function validate($columns = null)
    {
        $res = $this->doValidate($columns);
        if ($res === true) {
            $this->validationFailures = array();

            return true;
        }

        $this->validationFailures = $res;

        return false;
    }

    /**
     * This function performs the validation work for complex object models.
     *
     * In addition to checking the current object, all related objects will
     * also be validated.  If all pass then <code>true</code> is returned; otherwise
     * an aggreagated array of ValidationFailed objects will be returned.
     *
     * @param array $columns Array of column names to validate.
     * @return mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
     */
    protected function doValidate($columns = null)
    {
        if (!$this->alreadyInValidation) {
            $this->alreadyInValidation = true;
            $retval = null;

            $failureMap = array();


            // We call the validate method on the following object(s) if they
            // were passed to this object by their coresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUserRelatedByCreatedBy !== null) {
                if (!$this->aUserRelatedByCreatedBy->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByCreatedBy->getValidationFailures());
                }
            }

            if ($this->aUserRelatedByUpdatedBy !== null) {
                if (!$this->aUserRelatedByUpdatedBy->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aUserRelatedByUpdatedBy->getValidationFailures());
                }
            }


            if (($retval = UserPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBchRulsRelatedByCreatedBy !== null) {
                    foreach ($this->collBchRulsRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBchRulsRelatedByUpdatedBy !== null) {
                    foreach ($this->collBchRulsRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBranchsRelatedByCreatedBy !== null) {
                    foreach ($this->collBranchsRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collBranchsRelatedByUpdatedBy !== null) {
                    foreach ($this->collBranchsRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCredentialsRelatedByCreatedBy !== null) {
                    foreach ($this->collCredentialsRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collCredentialsRelatedByUpdatedBy !== null) {
                    foreach ($this->collCredentialsRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeafsRelatedByCreatedBy !== null) {
                    foreach ($this->collLeafsRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLeafsRelatedByUpdatedBy !== null) {
                    foreach ($this->collLeafsRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLefRulsRelatedByCreatedBy !== null) {
                    foreach ($this->collLefRulsRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLefRulsRelatedByUpdatedBy !== null) {
                    foreach ($this->collLefRulsRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNodeTreesRelatedByCreatedBy !== null) {
                    foreach ($this->collNodeTreesRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNodeTreesRelatedByUpdatedBy !== null) {
                    foreach ($this->collNodeTreesRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRulOptionsRelatedByCreatedBy !== null) {
                    foreach ($this->collRulOptionsRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRulOptionsRelatedByUpdatedBy !== null) {
                    foreach ($this->collRulOptionsRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRulesRelatedByCreatedBy !== null) {
                    foreach ($this->collRulesRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRulesRelatedByUpdatedBy !== null) {
                    foreach ($this->collRulesRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplatesRelatedByCreatedBy !== null) {
                    foreach ($this->collTemplatesRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTemplatesRelatedByUpdatedBy !== null) {
                    foreach ($this->collTemplatesRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTypeRulesRelatedByCreatedBy !== null) {
                    foreach ($this->collTypeRulesRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collTypeRulesRelatedByUpdatedBy !== null) {
                    foreach ($this->collTypeRulesRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsersRelatedById0 !== null) {
                    foreach ($this->collUsersRelatedById0 as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsersRelatedById1 !== null) {
                    foreach ($this->collUsersRelatedById1 as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsrCresRelatedByUsrId !== null) {
                    foreach ($this->collUsrCresRelatedByUsrId as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsrCresRelatedByCreatedBy !== null) {
                    foreach ($this->collUsrCresRelatedByCreatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collUsrCresRelatedByUpdatedBy !== null) {
                    foreach ($this->collUsrCresRelatedByUpdatedBy as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }


            $this->alreadyInValidation = false;
        }

        return (!empty($failureMap) ? $failureMap : true);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param string $name name
     * @param string $type The type of fieldname the $name is of:
     *               one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *               BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *               Defaults to BasePeer::TYPE_PHPNAME
     * @return mixed Value of field.
     */
    public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getUsrFirstName();
                break;
            case 2:
                return $this->getUsrLastName();
                break;
            case 3:
                return $this->getUsrLogin();
                break;
            case 4:
                return $this->getUsrPassword();
                break;
            case 5:
                return $this->getUsrCp();
                break;
            case 6:
                return $this->getUsrAvatar();
                break;
            case 7:
                return $this->getCreatedBy();
                break;
            case 8:
                return $this->getCreatedAt();
                break;
            case 9:
                return $this->getUpdatedBy();
                break;
            case 10:
                return $this->getUpdatedAt();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                    Defaults to BasePeer::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to true.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (isset($alreadyDumpedObjects['User'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['User'][$this->getPrimaryKey()] = true;
        $keys = UserPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getUsrFirstName(),
            $keys[2] => $this->getUsrLastName(),
            $keys[3] => $this->getUsrLogin(),
            $keys[4] => $this->getUsrPassword(),
            $keys[5] => $this->getUsrCp(),
            $keys[6] => $this->getUsrAvatar(),
            $keys[7] => $this->getCreatedBy(),
            $keys[8] => $this->getCreatedAt(),
            $keys[9] => $this->getUpdatedBy(),
            $keys[10] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aUserRelatedByCreatedBy) {
                $result['UserRelatedByCreatedBy'] = $this->aUserRelatedByCreatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUpdatedBy) {
                $result['UserRelatedByUpdatedBy'] = $this->aUserRelatedByUpdatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBchRulsRelatedByCreatedBy) {
                $result['BchRulsRelatedByCreatedBy'] = $this->collBchRulsRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBchRulsRelatedByUpdatedBy) {
                $result['BchRulsRelatedByUpdatedBy'] = $this->collBchRulsRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBranchsRelatedByCreatedBy) {
                $result['BranchsRelatedByCreatedBy'] = $this->collBranchsRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collBranchsRelatedByUpdatedBy) {
                $result['BranchsRelatedByUpdatedBy'] = $this->collBranchsRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCredentialsRelatedByCreatedBy) {
                $result['CredentialsRelatedByCreatedBy'] = $this->collCredentialsRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collCredentialsRelatedByUpdatedBy) {
                $result['CredentialsRelatedByUpdatedBy'] = $this->collCredentialsRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeafsRelatedByCreatedBy) {
                $result['LeafsRelatedByCreatedBy'] = $this->collLeafsRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLeafsRelatedByUpdatedBy) {
                $result['LeafsRelatedByUpdatedBy'] = $this->collLeafsRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLefRulsRelatedByCreatedBy) {
                $result['LefRulsRelatedByCreatedBy'] = $this->collLefRulsRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collLefRulsRelatedByUpdatedBy) {
                $result['LefRulsRelatedByUpdatedBy'] = $this->collLefRulsRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNodeTreesRelatedByCreatedBy) {
                $result['NodeTreesRelatedByCreatedBy'] = $this->collNodeTreesRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNodeTreesRelatedByUpdatedBy) {
                $result['NodeTreesRelatedByUpdatedBy'] = $this->collNodeTreesRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRulOptionsRelatedByCreatedBy) {
                $result['RulOptionsRelatedByCreatedBy'] = $this->collRulOptionsRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRulOptionsRelatedByUpdatedBy) {
                $result['RulOptionsRelatedByUpdatedBy'] = $this->collRulOptionsRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRulesRelatedByCreatedBy) {
                $result['RulesRelatedByCreatedBy'] = $this->collRulesRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRulesRelatedByUpdatedBy) {
                $result['RulesRelatedByUpdatedBy'] = $this->collRulesRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplatesRelatedByCreatedBy) {
                $result['TemplatesRelatedByCreatedBy'] = $this->collTemplatesRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTemplatesRelatedByUpdatedBy) {
                $result['TemplatesRelatedByUpdatedBy'] = $this->collTemplatesRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTypeRulesRelatedByCreatedBy) {
                $result['TypeRulesRelatedByCreatedBy'] = $this->collTypeRulesRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collTypeRulesRelatedByUpdatedBy) {
                $result['TypeRulesRelatedByUpdatedBy'] = $this->collTypeRulesRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsersRelatedById0) {
                $result['UsersRelatedById0'] = $this->collUsersRelatedById0->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsersRelatedById1) {
                $result['UsersRelatedById1'] = $this->collUsersRelatedById1->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsrCresRelatedByUsrId) {
                $result['UsrCresRelatedByUsrId'] = $this->collUsrCresRelatedByUsrId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsrCresRelatedByCreatedBy) {
                $result['UsrCresRelatedByCreatedBy'] = $this->collUsrCresRelatedByCreatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collUsrCresRelatedByUpdatedBy) {
                $result['UsrCresRelatedByUpdatedBy'] = $this->collUsrCresRelatedByUpdatedBy->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param string $name peer name
     * @param mixed $value field value
     * @param string $type The type of fieldname the $name is of:
     *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
     *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     *                     Defaults to BasePeer::TYPE_PHPNAME
     * @return void
     */
    public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
    {
        $pos = UserPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

        $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param int $pos position in xml schema
     * @param mixed $value field value
     * @return void
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setUsrFirstName($value);
                break;
            case 2:
                $this->setUsrLastName($value);
                break;
            case 3:
                $this->setUsrLogin($value);
                break;
            case 4:
                $this->setUsrPassword($value);
                break;
            case 5:
                $this->setUsrCp($value);
                break;
            case 6:
                $this->setUsrAvatar($value);
                break;
            case 7:
                $this->setCreatedBy($value);
                break;
            case 8:
                $this->setCreatedAt($value);
                break;
            case 9:
                $this->setUpdatedBy($value);
                break;
            case 10:
                $this->setUpdatedAt($value);
                break;
        } // switch()
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
     * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
     * The default key type is the column's BasePeer::TYPE_PHPNAME
     *
     * @param array  $arr     An array to populate the object from.
     * @param string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
    {
        $keys = UserPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setUsrFirstName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setUsrLastName($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setUsrLogin($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setUsrPassword($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setUsrCp($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUsrAvatar($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCreatedBy($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setCreatedAt($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setUpdatedBy($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setUpdatedAt($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);

        if ($this->isColumnModified(UserPeer::ID)) $criteria->add(UserPeer::ID, $this->id);
        if ($this->isColumnModified(UserPeer::USR_FIRST_NAME)) $criteria->add(UserPeer::USR_FIRST_NAME, $this->usr_first_name);
        if ($this->isColumnModified(UserPeer::USR_LAST_NAME)) $criteria->add(UserPeer::USR_LAST_NAME, $this->usr_last_name);
        if ($this->isColumnModified(UserPeer::USR_LOGIN)) $criteria->add(UserPeer::USR_LOGIN, $this->usr_login);
        if ($this->isColumnModified(UserPeer::USR_PASSWORD)) $criteria->add(UserPeer::USR_PASSWORD, $this->usr_password);
        if ($this->isColumnModified(UserPeer::USR_CP)) $criteria->add(UserPeer::USR_CP, $this->usr_cp);
        if ($this->isColumnModified(UserPeer::USR_AVATAR)) $criteria->add(UserPeer::USR_AVATAR, $this->usr_avatar);
        if ($this->isColumnModified(UserPeer::CREATED_BY)) $criteria->add(UserPeer::CREATED_BY, $this->created_by);
        if ($this->isColumnModified(UserPeer::CREATED_AT)) $criteria->add(UserPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(UserPeer::UPDATED_BY)) $criteria->add(UserPeer::UPDATED_BY, $this->updated_by);
        if ($this->isColumnModified(UserPeer::UPDATED_AT)) $criteria->add(UserPeer::UPDATED_AT, $this->updated_at);

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = new Criteria(UserPeer::DATABASE_NAME);
        $criteria->add(UserPeer::ID, $this->id);

        return $criteria;
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param  int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {

        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param object $copyObj An object of User (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setUsrFirstName($this->getUsrFirstName());
        $copyObj->setUsrLastName($this->getUsrLastName());
        $copyObj->setUsrLogin($this->getUsrLogin());
        $copyObj->setUsrPassword($this->getUsrPassword());
        $copyObj->setUsrCp($this->getUsrCp());
        $copyObj->setUsrAvatar($this->getUsrAvatar());
        $copyObj->setCreatedBy($this->getCreatedBy());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedBy($this->getUpdatedBy());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getBchRulsRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBchRulRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBchRulsRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBchRulRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBranchsRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBranchRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getBranchsRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBranchRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCredentialsRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCredentialRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getCredentialsRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addCredentialRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeafsRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeafRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLeafsRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLeafRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLefRulsRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLefRulRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getLefRulsRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLefRulRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNodeTreesRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNodeTreeRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNodeTreesRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNodeTreeRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRulOptionsRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRulOptionRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRulOptionsRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRulOptionRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRulesRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRuleRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRulesRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRuleRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplatesRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplateRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTemplatesRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTemplateRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTypeRulesRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTypeRuleRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getTypeRulesRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addTypeRuleRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsersRelatedById0() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserRelatedById0($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsersRelatedById1() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUserRelatedById1($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsrCresRelatedByUsrId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsrCreRelatedByUsrId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsrCresRelatedByCreatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsrCreRelatedByCreatedBy($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getUsrCresRelatedByUpdatedBy() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addUsrCreRelatedByUpdatedBy($relObj->copy($deepCopy));
                }
            }

            //unflag object copy
            $this->startCopy = false;
        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return User Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Returns a peer instance associated with this om.
     *
     * Since Peer classes are not to have any instance attributes, this method returns the
     * same instance for all member of this class. The method could therefore
     * be static, but this would prevent one from overriding the behavior.
     *
     * @return UserPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new UserPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByCreatedBy(User $v = null)
    {
        if ($v === null) {
            $this->setCreatedBy(NULL);
        } else {
            $this->setCreatedBy($v->getId());
        }

        $this->aUserRelatedByCreatedBy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addUserRelatedById0($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByCreatedBy(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUserRelatedByCreatedBy === null && ($this->created_by !== null) && $doQuery) {
            $this->aUserRelatedByCreatedBy = UserQuery::create()->findPk($this->created_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByCreatedBy->addUsersRelatedById0($this);
             */
        }

        return $this->aUserRelatedByCreatedBy;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return User The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUserRelatedByUpdatedBy(User $v = null)
    {
        if ($v === null) {
            $this->setUpdatedBy(NULL);
        } else {
            $this->setUpdatedBy($v->getId());
        }

        $this->aUserRelatedByUpdatedBy = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the User object, it will not be re-added.
        if ($v !== null) {
            $v->addUserRelatedById1($this);
        }


        return $this;
    }


    /**
     * Get the associated User object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return User The associated User object.
     * @throws PropelException
     */
    public function getUserRelatedByUpdatedBy(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aUserRelatedByUpdatedBy === null && ($this->updated_by !== null) && $doQuery) {
            $this->aUserRelatedByUpdatedBy = UserQuery::create()->findPk($this->updated_by, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUserRelatedByUpdatedBy->addUsersRelatedById1($this);
             */
        }

        return $this->aUserRelatedByUpdatedBy;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('BchRulRelatedByCreatedBy' == $relationName) {
            $this->initBchRulsRelatedByCreatedBy();
        }
        if ('BchRulRelatedByUpdatedBy' == $relationName) {
            $this->initBchRulsRelatedByUpdatedBy();
        }
        if ('BranchRelatedByCreatedBy' == $relationName) {
            $this->initBranchsRelatedByCreatedBy();
        }
        if ('BranchRelatedByUpdatedBy' == $relationName) {
            $this->initBranchsRelatedByUpdatedBy();
        }
        if ('CredentialRelatedByCreatedBy' == $relationName) {
            $this->initCredentialsRelatedByCreatedBy();
        }
        if ('CredentialRelatedByUpdatedBy' == $relationName) {
            $this->initCredentialsRelatedByUpdatedBy();
        }
        if ('LeafRelatedByCreatedBy' == $relationName) {
            $this->initLeafsRelatedByCreatedBy();
        }
        if ('LeafRelatedByUpdatedBy' == $relationName) {
            $this->initLeafsRelatedByUpdatedBy();
        }
        if ('LefRulRelatedByCreatedBy' == $relationName) {
            $this->initLefRulsRelatedByCreatedBy();
        }
        if ('LefRulRelatedByUpdatedBy' == $relationName) {
            $this->initLefRulsRelatedByUpdatedBy();
        }
        if ('NodeTreeRelatedByCreatedBy' == $relationName) {
            $this->initNodeTreesRelatedByCreatedBy();
        }
        if ('NodeTreeRelatedByUpdatedBy' == $relationName) {
            $this->initNodeTreesRelatedByUpdatedBy();
        }
        if ('RulOptionRelatedByCreatedBy' == $relationName) {
            $this->initRulOptionsRelatedByCreatedBy();
        }
        if ('RulOptionRelatedByUpdatedBy' == $relationName) {
            $this->initRulOptionsRelatedByUpdatedBy();
        }
        if ('RuleRelatedByCreatedBy' == $relationName) {
            $this->initRulesRelatedByCreatedBy();
        }
        if ('RuleRelatedByUpdatedBy' == $relationName) {
            $this->initRulesRelatedByUpdatedBy();
        }
        if ('TemplateRelatedByCreatedBy' == $relationName) {
            $this->initTemplatesRelatedByCreatedBy();
        }
        if ('TemplateRelatedByUpdatedBy' == $relationName) {
            $this->initTemplatesRelatedByUpdatedBy();
        }
        if ('TypeRuleRelatedByCreatedBy' == $relationName) {
            $this->initTypeRulesRelatedByCreatedBy();
        }
        if ('TypeRuleRelatedByUpdatedBy' == $relationName) {
            $this->initTypeRulesRelatedByUpdatedBy();
        }
        if ('UserRelatedById0' == $relationName) {
            $this->initUsersRelatedById0();
        }
        if ('UserRelatedById1' == $relationName) {
            $this->initUsersRelatedById1();
        }
        if ('UsrCreRelatedByUsrId' == $relationName) {
            $this->initUsrCresRelatedByUsrId();
        }
        if ('UsrCreRelatedByCreatedBy' == $relationName) {
            $this->initUsrCresRelatedByCreatedBy();
        }
        if ('UsrCreRelatedByUpdatedBy' == $relationName) {
            $this->initUsrCresRelatedByUpdatedBy();
        }
    }

    /**
     * Clears out the collBchRulsRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addBchRulsRelatedByCreatedBy()
     */
    public function clearBchRulsRelatedByCreatedBy()
    {
        $this->collBchRulsRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collBchRulsRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collBchRulsRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialBchRulsRelatedByCreatedBy($v = true)
    {
        $this->collBchRulsRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collBchRulsRelatedByCreatedBy collection.
     *
     * By default this just sets the collBchRulsRelatedByCreatedBy collection to an empty array (like clearcollBchRulsRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBchRulsRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collBchRulsRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collBchRulsRelatedByCreatedBy = new PropelObjectCollection();
        $this->collBchRulsRelatedByCreatedBy->setModel('BchRul');
    }

    /**
     * Gets an array of BchRul objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     * @throws PropelException
     */
    public function getBchRulsRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBchRulsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collBchRulsRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBchRulsRelatedByCreatedBy) {
                // return empty collection
                $this->initBchRulsRelatedByCreatedBy();
            } else {
                $collBchRulsRelatedByCreatedBy = BchRulQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBchRulsRelatedByCreatedByPartial && count($collBchRulsRelatedByCreatedBy)) {
                      $this->initBchRulsRelatedByCreatedBy(false);

                      foreach($collBchRulsRelatedByCreatedBy as $obj) {
                        if (false == $this->collBchRulsRelatedByCreatedBy->contains($obj)) {
                          $this->collBchRulsRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collBchRulsRelatedByCreatedByPartial = true;
                    }

                    $collBchRulsRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collBchRulsRelatedByCreatedBy;
                }

                if($partial && $this->collBchRulsRelatedByCreatedBy) {
                    foreach($this->collBchRulsRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collBchRulsRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collBchRulsRelatedByCreatedBy = $collBchRulsRelatedByCreatedBy;
                $this->collBchRulsRelatedByCreatedByPartial = false;
            }
        }

        return $this->collBchRulsRelatedByCreatedBy;
    }

    /**
     * Sets a collection of BchRulRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bchRulsRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setBchRulsRelatedByCreatedBy(PropelCollection $bchRulsRelatedByCreatedBy, PropelPDO $con = null)
    {
        $bchRulsRelatedByCreatedByToDelete = $this->getBchRulsRelatedByCreatedBy(new Criteria(), $con)->diff($bchRulsRelatedByCreatedBy);

        $this->bchRulsRelatedByCreatedByScheduledForDeletion = unserialize(serialize($bchRulsRelatedByCreatedByToDelete));

        foreach ($bchRulsRelatedByCreatedByToDelete as $bchRulRelatedByCreatedByRemoved) {
            $bchRulRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collBchRulsRelatedByCreatedBy = null;
        foreach ($bchRulsRelatedByCreatedBy as $bchRulRelatedByCreatedBy) {
            $this->addBchRulRelatedByCreatedBy($bchRulRelatedByCreatedBy);
        }

        $this->collBchRulsRelatedByCreatedBy = $bchRulsRelatedByCreatedBy;
        $this->collBchRulsRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BchRul objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BchRul objects.
     * @throws PropelException
     */
    public function countBchRulsRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBchRulsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collBchRulsRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBchRulsRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBchRulsRelatedByCreatedBy());
            }
            $query = BchRulQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collBchRulsRelatedByCreatedBy);
    }

    /**
     * Method called to associate a BchRul object to this object
     * through the BchRul foreign key attribute.
     *
     * @param    BchRul $l BchRul
     * @return User The current object (for fluent API support)
     */
    public function addBchRulRelatedByCreatedBy(BchRul $l)
    {
        if ($this->collBchRulsRelatedByCreatedBy === null) {
            $this->initBchRulsRelatedByCreatedBy();
            $this->collBchRulsRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collBchRulsRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBchRulRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	BchRulRelatedByCreatedBy $bchRulRelatedByCreatedBy The bchRulRelatedByCreatedBy object to add.
     */
    protected function doAddBchRulRelatedByCreatedBy($bchRulRelatedByCreatedBy)
    {
        $this->collBchRulsRelatedByCreatedBy[]= $bchRulRelatedByCreatedBy;
        $bchRulRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	BchRulRelatedByCreatedBy $bchRulRelatedByCreatedBy The bchRulRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeBchRulRelatedByCreatedBy($bchRulRelatedByCreatedBy)
    {
        if ($this->getBchRulsRelatedByCreatedBy()->contains($bchRulRelatedByCreatedBy)) {
            $this->collBchRulsRelatedByCreatedBy->remove($this->collBchRulsRelatedByCreatedBy->search($bchRulRelatedByCreatedBy));
            if (null === $this->bchRulsRelatedByCreatedByScheduledForDeletion) {
                $this->bchRulsRelatedByCreatedByScheduledForDeletion = clone $this->collBchRulsRelatedByCreatedBy;
                $this->bchRulsRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->bchRulsRelatedByCreatedByScheduledForDeletion[]= $bchRulRelatedByCreatedBy;
            $bchRulRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BchRulsRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     */
    public function getBchRulsRelatedByCreatedByJoinRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BchRulQuery::create(null, $criteria);
        $query->joinWith('Rule', $join_behavior);

        return $this->getBchRulsRelatedByCreatedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BchRulsRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     */
    public function getBchRulsRelatedByCreatedByJoinBranch($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BchRulQuery::create(null, $criteria);
        $query->joinWith('Branch', $join_behavior);

        return $this->getBchRulsRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collBchRulsRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addBchRulsRelatedByUpdatedBy()
     */
    public function clearBchRulsRelatedByUpdatedBy()
    {
        $this->collBchRulsRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collBchRulsRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collBchRulsRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialBchRulsRelatedByUpdatedBy($v = true)
    {
        $this->collBchRulsRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collBchRulsRelatedByUpdatedBy collection.
     *
     * By default this just sets the collBchRulsRelatedByUpdatedBy collection to an empty array (like clearcollBchRulsRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBchRulsRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collBchRulsRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collBchRulsRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collBchRulsRelatedByUpdatedBy->setModel('BchRul');
    }

    /**
     * Gets an array of BchRul objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     * @throws PropelException
     */
    public function getBchRulsRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBchRulsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collBchRulsRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBchRulsRelatedByUpdatedBy) {
                // return empty collection
                $this->initBchRulsRelatedByUpdatedBy();
            } else {
                $collBchRulsRelatedByUpdatedBy = BchRulQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBchRulsRelatedByUpdatedByPartial && count($collBchRulsRelatedByUpdatedBy)) {
                      $this->initBchRulsRelatedByUpdatedBy(false);

                      foreach($collBchRulsRelatedByUpdatedBy as $obj) {
                        if (false == $this->collBchRulsRelatedByUpdatedBy->contains($obj)) {
                          $this->collBchRulsRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collBchRulsRelatedByUpdatedByPartial = true;
                    }

                    $collBchRulsRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collBchRulsRelatedByUpdatedBy;
                }

                if($partial && $this->collBchRulsRelatedByUpdatedBy) {
                    foreach($this->collBchRulsRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collBchRulsRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collBchRulsRelatedByUpdatedBy = $collBchRulsRelatedByUpdatedBy;
                $this->collBchRulsRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collBchRulsRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of BchRulRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bchRulsRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setBchRulsRelatedByUpdatedBy(PropelCollection $bchRulsRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $bchRulsRelatedByUpdatedByToDelete = $this->getBchRulsRelatedByUpdatedBy(new Criteria(), $con)->diff($bchRulsRelatedByUpdatedBy);

        $this->bchRulsRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($bchRulsRelatedByUpdatedByToDelete));

        foreach ($bchRulsRelatedByUpdatedByToDelete as $bchRulRelatedByUpdatedByRemoved) {
            $bchRulRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collBchRulsRelatedByUpdatedBy = null;
        foreach ($bchRulsRelatedByUpdatedBy as $bchRulRelatedByUpdatedBy) {
            $this->addBchRulRelatedByUpdatedBy($bchRulRelatedByUpdatedBy);
        }

        $this->collBchRulsRelatedByUpdatedBy = $bchRulsRelatedByUpdatedBy;
        $this->collBchRulsRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related BchRul objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related BchRul objects.
     * @throws PropelException
     */
    public function countBchRulsRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBchRulsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collBchRulsRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBchRulsRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBchRulsRelatedByUpdatedBy());
            }
            $query = BchRulQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collBchRulsRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a BchRul object to this object
     * through the BchRul foreign key attribute.
     *
     * @param    BchRul $l BchRul
     * @return User The current object (for fluent API support)
     */
    public function addBchRulRelatedByUpdatedBy(BchRul $l)
    {
        if ($this->collBchRulsRelatedByUpdatedBy === null) {
            $this->initBchRulsRelatedByUpdatedBy();
            $this->collBchRulsRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collBchRulsRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBchRulRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	BchRulRelatedByUpdatedBy $bchRulRelatedByUpdatedBy The bchRulRelatedByUpdatedBy object to add.
     */
    protected function doAddBchRulRelatedByUpdatedBy($bchRulRelatedByUpdatedBy)
    {
        $this->collBchRulsRelatedByUpdatedBy[]= $bchRulRelatedByUpdatedBy;
        $bchRulRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	BchRulRelatedByUpdatedBy $bchRulRelatedByUpdatedBy The bchRulRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeBchRulRelatedByUpdatedBy($bchRulRelatedByUpdatedBy)
    {
        if ($this->getBchRulsRelatedByUpdatedBy()->contains($bchRulRelatedByUpdatedBy)) {
            $this->collBchRulsRelatedByUpdatedBy->remove($this->collBchRulsRelatedByUpdatedBy->search($bchRulRelatedByUpdatedBy));
            if (null === $this->bchRulsRelatedByUpdatedByScheduledForDeletion) {
                $this->bchRulsRelatedByUpdatedByScheduledForDeletion = clone $this->collBchRulsRelatedByUpdatedBy;
                $this->bchRulsRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->bchRulsRelatedByUpdatedByScheduledForDeletion[]= $bchRulRelatedByUpdatedBy;
            $bchRulRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BchRulsRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     */
    public function getBchRulsRelatedByUpdatedByJoinRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BchRulQuery::create(null, $criteria);
        $query->joinWith('Rule', $join_behavior);

        return $this->getBchRulsRelatedByUpdatedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BchRulsRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     */
    public function getBchRulsRelatedByUpdatedByJoinBranch($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BchRulQuery::create(null, $criteria);
        $query->joinWith('Branch', $join_behavior);

        return $this->getBchRulsRelatedByUpdatedBy($query, $con);
    }

    /**
     * Clears out the collBranchsRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addBranchsRelatedByCreatedBy()
     */
    public function clearBranchsRelatedByCreatedBy()
    {
        $this->collBranchsRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collBranchsRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collBranchsRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialBranchsRelatedByCreatedBy($v = true)
    {
        $this->collBranchsRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collBranchsRelatedByCreatedBy collection.
     *
     * By default this just sets the collBranchsRelatedByCreatedBy collection to an empty array (like clearcollBranchsRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBranchsRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collBranchsRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collBranchsRelatedByCreatedBy = new PropelObjectCollection();
        $this->collBranchsRelatedByCreatedBy->setModel('Branch');
    }

    /**
     * Gets an array of Branch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Branch[] List of Branch objects
     * @throws PropelException
     */
    public function getBranchsRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBranchsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collBranchsRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBranchsRelatedByCreatedBy) {
                // return empty collection
                $this->initBranchsRelatedByCreatedBy();
            } else {
                $collBranchsRelatedByCreatedBy = BranchQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBranchsRelatedByCreatedByPartial && count($collBranchsRelatedByCreatedBy)) {
                      $this->initBranchsRelatedByCreatedBy(false);

                      foreach($collBranchsRelatedByCreatedBy as $obj) {
                        if (false == $this->collBranchsRelatedByCreatedBy->contains($obj)) {
                          $this->collBranchsRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collBranchsRelatedByCreatedByPartial = true;
                    }

                    $collBranchsRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collBranchsRelatedByCreatedBy;
                }

                if($partial && $this->collBranchsRelatedByCreatedBy) {
                    foreach($this->collBranchsRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collBranchsRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collBranchsRelatedByCreatedBy = $collBranchsRelatedByCreatedBy;
                $this->collBranchsRelatedByCreatedByPartial = false;
            }
        }

        return $this->collBranchsRelatedByCreatedBy;
    }

    /**
     * Sets a collection of BranchRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $branchsRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setBranchsRelatedByCreatedBy(PropelCollection $branchsRelatedByCreatedBy, PropelPDO $con = null)
    {
        $branchsRelatedByCreatedByToDelete = $this->getBranchsRelatedByCreatedBy(new Criteria(), $con)->diff($branchsRelatedByCreatedBy);

        $this->branchsRelatedByCreatedByScheduledForDeletion = unserialize(serialize($branchsRelatedByCreatedByToDelete));

        foreach ($branchsRelatedByCreatedByToDelete as $branchRelatedByCreatedByRemoved) {
            $branchRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collBranchsRelatedByCreatedBy = null;
        foreach ($branchsRelatedByCreatedBy as $branchRelatedByCreatedBy) {
            $this->addBranchRelatedByCreatedBy($branchRelatedByCreatedBy);
        }

        $this->collBranchsRelatedByCreatedBy = $branchsRelatedByCreatedBy;
        $this->collBranchsRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Branch objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Branch objects.
     * @throws PropelException
     */
    public function countBranchsRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBranchsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collBranchsRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBranchsRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBranchsRelatedByCreatedBy());
            }
            $query = BranchQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collBranchsRelatedByCreatedBy);
    }

    /**
     * Method called to associate a Branch object to this object
     * through the Branch foreign key attribute.
     *
     * @param    Branch $l Branch
     * @return User The current object (for fluent API support)
     */
    public function addBranchRelatedByCreatedBy(Branch $l)
    {
        if ($this->collBranchsRelatedByCreatedBy === null) {
            $this->initBranchsRelatedByCreatedBy();
            $this->collBranchsRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collBranchsRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBranchRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	BranchRelatedByCreatedBy $branchRelatedByCreatedBy The branchRelatedByCreatedBy object to add.
     */
    protected function doAddBranchRelatedByCreatedBy($branchRelatedByCreatedBy)
    {
        $this->collBranchsRelatedByCreatedBy[]= $branchRelatedByCreatedBy;
        $branchRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	BranchRelatedByCreatedBy $branchRelatedByCreatedBy The branchRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeBranchRelatedByCreatedBy($branchRelatedByCreatedBy)
    {
        if ($this->getBranchsRelatedByCreatedBy()->contains($branchRelatedByCreatedBy)) {
            $this->collBranchsRelatedByCreatedBy->remove($this->collBranchsRelatedByCreatedBy->search($branchRelatedByCreatedBy));
            if (null === $this->branchsRelatedByCreatedByScheduledForDeletion) {
                $this->branchsRelatedByCreatedByScheduledForDeletion = clone $this->collBranchsRelatedByCreatedBy;
                $this->branchsRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->branchsRelatedByCreatedByScheduledForDeletion[]= $branchRelatedByCreatedBy;
            $branchRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BranchsRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Branch[] List of Branch objects
     */
    public function getBranchsRelatedByCreatedByJoinTemplate($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BranchQuery::create(null, $criteria);
        $query->joinWith('Template', $join_behavior);

        return $this->getBranchsRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collBranchsRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addBranchsRelatedByUpdatedBy()
     */
    public function clearBranchsRelatedByUpdatedBy()
    {
        $this->collBranchsRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collBranchsRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collBranchsRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialBranchsRelatedByUpdatedBy($v = true)
    {
        $this->collBranchsRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collBranchsRelatedByUpdatedBy collection.
     *
     * By default this just sets the collBranchsRelatedByUpdatedBy collection to an empty array (like clearcollBranchsRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBranchsRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collBranchsRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collBranchsRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collBranchsRelatedByUpdatedBy->setModel('Branch');
    }

    /**
     * Gets an array of Branch objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Branch[] List of Branch objects
     * @throws PropelException
     */
    public function getBranchsRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBranchsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collBranchsRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBranchsRelatedByUpdatedBy) {
                // return empty collection
                $this->initBranchsRelatedByUpdatedBy();
            } else {
                $collBranchsRelatedByUpdatedBy = BranchQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBranchsRelatedByUpdatedByPartial && count($collBranchsRelatedByUpdatedBy)) {
                      $this->initBranchsRelatedByUpdatedBy(false);

                      foreach($collBranchsRelatedByUpdatedBy as $obj) {
                        if (false == $this->collBranchsRelatedByUpdatedBy->contains($obj)) {
                          $this->collBranchsRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collBranchsRelatedByUpdatedByPartial = true;
                    }

                    $collBranchsRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collBranchsRelatedByUpdatedBy;
                }

                if($partial && $this->collBranchsRelatedByUpdatedBy) {
                    foreach($this->collBranchsRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collBranchsRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collBranchsRelatedByUpdatedBy = $collBranchsRelatedByUpdatedBy;
                $this->collBranchsRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collBranchsRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of BranchRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $branchsRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setBranchsRelatedByUpdatedBy(PropelCollection $branchsRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $branchsRelatedByUpdatedByToDelete = $this->getBranchsRelatedByUpdatedBy(new Criteria(), $con)->diff($branchsRelatedByUpdatedBy);

        $this->branchsRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($branchsRelatedByUpdatedByToDelete));

        foreach ($branchsRelatedByUpdatedByToDelete as $branchRelatedByUpdatedByRemoved) {
            $branchRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collBranchsRelatedByUpdatedBy = null;
        foreach ($branchsRelatedByUpdatedBy as $branchRelatedByUpdatedBy) {
            $this->addBranchRelatedByUpdatedBy($branchRelatedByUpdatedBy);
        }

        $this->collBranchsRelatedByUpdatedBy = $branchsRelatedByUpdatedBy;
        $this->collBranchsRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Branch objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Branch objects.
     * @throws PropelException
     */
    public function countBranchsRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBranchsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collBranchsRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBranchsRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBranchsRelatedByUpdatedBy());
            }
            $query = BranchQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collBranchsRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a Branch object to this object
     * through the Branch foreign key attribute.
     *
     * @param    Branch $l Branch
     * @return User The current object (for fluent API support)
     */
    public function addBranchRelatedByUpdatedBy(Branch $l)
    {
        if ($this->collBranchsRelatedByUpdatedBy === null) {
            $this->initBranchsRelatedByUpdatedBy();
            $this->collBranchsRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collBranchsRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBranchRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	BranchRelatedByUpdatedBy $branchRelatedByUpdatedBy The branchRelatedByUpdatedBy object to add.
     */
    protected function doAddBranchRelatedByUpdatedBy($branchRelatedByUpdatedBy)
    {
        $this->collBranchsRelatedByUpdatedBy[]= $branchRelatedByUpdatedBy;
        $branchRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	BranchRelatedByUpdatedBy $branchRelatedByUpdatedBy The branchRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeBranchRelatedByUpdatedBy($branchRelatedByUpdatedBy)
    {
        if ($this->getBranchsRelatedByUpdatedBy()->contains($branchRelatedByUpdatedBy)) {
            $this->collBranchsRelatedByUpdatedBy->remove($this->collBranchsRelatedByUpdatedBy->search($branchRelatedByUpdatedBy));
            if (null === $this->branchsRelatedByUpdatedByScheduledForDeletion) {
                $this->branchsRelatedByUpdatedByScheduledForDeletion = clone $this->collBranchsRelatedByUpdatedBy;
                $this->branchsRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->branchsRelatedByUpdatedByScheduledForDeletion[]= $branchRelatedByUpdatedBy;
            $branchRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related BranchsRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Branch[] List of Branch objects
     */
    public function getBranchsRelatedByUpdatedByJoinTemplate($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BranchQuery::create(null, $criteria);
        $query->joinWith('Template', $join_behavior);

        return $this->getBranchsRelatedByUpdatedBy($query, $con);
    }

    /**
     * Clears out the collCredentialsRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addCredentialsRelatedByCreatedBy()
     */
    public function clearCredentialsRelatedByCreatedBy()
    {
        $this->collCredentialsRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collCredentialsRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collCredentialsRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialCredentialsRelatedByCreatedBy($v = true)
    {
        $this->collCredentialsRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collCredentialsRelatedByCreatedBy collection.
     *
     * By default this just sets the collCredentialsRelatedByCreatedBy collection to an empty array (like clearcollCredentialsRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCredentialsRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collCredentialsRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collCredentialsRelatedByCreatedBy = new PropelObjectCollection();
        $this->collCredentialsRelatedByCreatedBy->setModel('Credential');
    }

    /**
     * Gets an array of Credential objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Credential[] List of Credential objects
     * @throws PropelException
     */
    public function getCredentialsRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCredentialsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collCredentialsRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCredentialsRelatedByCreatedBy) {
                // return empty collection
                $this->initCredentialsRelatedByCreatedBy();
            } else {
                $collCredentialsRelatedByCreatedBy = CredentialQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCredentialsRelatedByCreatedByPartial && count($collCredentialsRelatedByCreatedBy)) {
                      $this->initCredentialsRelatedByCreatedBy(false);

                      foreach($collCredentialsRelatedByCreatedBy as $obj) {
                        if (false == $this->collCredentialsRelatedByCreatedBy->contains($obj)) {
                          $this->collCredentialsRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collCredentialsRelatedByCreatedByPartial = true;
                    }

                    $collCredentialsRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collCredentialsRelatedByCreatedBy;
                }

                if($partial && $this->collCredentialsRelatedByCreatedBy) {
                    foreach($this->collCredentialsRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collCredentialsRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collCredentialsRelatedByCreatedBy = $collCredentialsRelatedByCreatedBy;
                $this->collCredentialsRelatedByCreatedByPartial = false;
            }
        }

        return $this->collCredentialsRelatedByCreatedBy;
    }

    /**
     * Sets a collection of CredentialRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $credentialsRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setCredentialsRelatedByCreatedBy(PropelCollection $credentialsRelatedByCreatedBy, PropelPDO $con = null)
    {
        $credentialsRelatedByCreatedByToDelete = $this->getCredentialsRelatedByCreatedBy(new Criteria(), $con)->diff($credentialsRelatedByCreatedBy);

        $this->credentialsRelatedByCreatedByScheduledForDeletion = unserialize(serialize($credentialsRelatedByCreatedByToDelete));

        foreach ($credentialsRelatedByCreatedByToDelete as $credentialRelatedByCreatedByRemoved) {
            $credentialRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collCredentialsRelatedByCreatedBy = null;
        foreach ($credentialsRelatedByCreatedBy as $credentialRelatedByCreatedBy) {
            $this->addCredentialRelatedByCreatedBy($credentialRelatedByCreatedBy);
        }

        $this->collCredentialsRelatedByCreatedBy = $credentialsRelatedByCreatedBy;
        $this->collCredentialsRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Credential objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Credential objects.
     * @throws PropelException
     */
    public function countCredentialsRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCredentialsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collCredentialsRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCredentialsRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getCredentialsRelatedByCreatedBy());
            }
            $query = CredentialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collCredentialsRelatedByCreatedBy);
    }

    /**
     * Method called to associate a Credential object to this object
     * through the Credential foreign key attribute.
     *
     * @param    Credential $l Credential
     * @return User The current object (for fluent API support)
     */
    public function addCredentialRelatedByCreatedBy(Credential $l)
    {
        if ($this->collCredentialsRelatedByCreatedBy === null) {
            $this->initCredentialsRelatedByCreatedBy();
            $this->collCredentialsRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collCredentialsRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCredentialRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	CredentialRelatedByCreatedBy $credentialRelatedByCreatedBy The credentialRelatedByCreatedBy object to add.
     */
    protected function doAddCredentialRelatedByCreatedBy($credentialRelatedByCreatedBy)
    {
        $this->collCredentialsRelatedByCreatedBy[]= $credentialRelatedByCreatedBy;
        $credentialRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	CredentialRelatedByCreatedBy $credentialRelatedByCreatedBy The credentialRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeCredentialRelatedByCreatedBy($credentialRelatedByCreatedBy)
    {
        if ($this->getCredentialsRelatedByCreatedBy()->contains($credentialRelatedByCreatedBy)) {
            $this->collCredentialsRelatedByCreatedBy->remove($this->collCredentialsRelatedByCreatedBy->search($credentialRelatedByCreatedBy));
            if (null === $this->credentialsRelatedByCreatedByScheduledForDeletion) {
                $this->credentialsRelatedByCreatedByScheduledForDeletion = clone $this->collCredentialsRelatedByCreatedBy;
                $this->credentialsRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->credentialsRelatedByCreatedByScheduledForDeletion[]= $credentialRelatedByCreatedBy;
            $credentialRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collCredentialsRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addCredentialsRelatedByUpdatedBy()
     */
    public function clearCredentialsRelatedByUpdatedBy()
    {
        $this->collCredentialsRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collCredentialsRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collCredentialsRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialCredentialsRelatedByUpdatedBy($v = true)
    {
        $this->collCredentialsRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collCredentialsRelatedByUpdatedBy collection.
     *
     * By default this just sets the collCredentialsRelatedByUpdatedBy collection to an empty array (like clearcollCredentialsRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initCredentialsRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collCredentialsRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collCredentialsRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collCredentialsRelatedByUpdatedBy->setModel('Credential');
    }

    /**
     * Gets an array of Credential objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Credential[] List of Credential objects
     * @throws PropelException
     */
    public function getCredentialsRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collCredentialsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collCredentialsRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collCredentialsRelatedByUpdatedBy) {
                // return empty collection
                $this->initCredentialsRelatedByUpdatedBy();
            } else {
                $collCredentialsRelatedByUpdatedBy = CredentialQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collCredentialsRelatedByUpdatedByPartial && count($collCredentialsRelatedByUpdatedBy)) {
                      $this->initCredentialsRelatedByUpdatedBy(false);

                      foreach($collCredentialsRelatedByUpdatedBy as $obj) {
                        if (false == $this->collCredentialsRelatedByUpdatedBy->contains($obj)) {
                          $this->collCredentialsRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collCredentialsRelatedByUpdatedByPartial = true;
                    }

                    $collCredentialsRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collCredentialsRelatedByUpdatedBy;
                }

                if($partial && $this->collCredentialsRelatedByUpdatedBy) {
                    foreach($this->collCredentialsRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collCredentialsRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collCredentialsRelatedByUpdatedBy = $collCredentialsRelatedByUpdatedBy;
                $this->collCredentialsRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collCredentialsRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of CredentialRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $credentialsRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setCredentialsRelatedByUpdatedBy(PropelCollection $credentialsRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $credentialsRelatedByUpdatedByToDelete = $this->getCredentialsRelatedByUpdatedBy(new Criteria(), $con)->diff($credentialsRelatedByUpdatedBy);

        $this->credentialsRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($credentialsRelatedByUpdatedByToDelete));

        foreach ($credentialsRelatedByUpdatedByToDelete as $credentialRelatedByUpdatedByRemoved) {
            $credentialRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collCredentialsRelatedByUpdatedBy = null;
        foreach ($credentialsRelatedByUpdatedBy as $credentialRelatedByUpdatedBy) {
            $this->addCredentialRelatedByUpdatedBy($credentialRelatedByUpdatedBy);
        }

        $this->collCredentialsRelatedByUpdatedBy = $credentialsRelatedByUpdatedBy;
        $this->collCredentialsRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Credential objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Credential objects.
     * @throws PropelException
     */
    public function countCredentialsRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collCredentialsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collCredentialsRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collCredentialsRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getCredentialsRelatedByUpdatedBy());
            }
            $query = CredentialQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collCredentialsRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a Credential object to this object
     * through the Credential foreign key attribute.
     *
     * @param    Credential $l Credential
     * @return User The current object (for fluent API support)
     */
    public function addCredentialRelatedByUpdatedBy(Credential $l)
    {
        if ($this->collCredentialsRelatedByUpdatedBy === null) {
            $this->initCredentialsRelatedByUpdatedBy();
            $this->collCredentialsRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collCredentialsRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddCredentialRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	CredentialRelatedByUpdatedBy $credentialRelatedByUpdatedBy The credentialRelatedByUpdatedBy object to add.
     */
    protected function doAddCredentialRelatedByUpdatedBy($credentialRelatedByUpdatedBy)
    {
        $this->collCredentialsRelatedByUpdatedBy[]= $credentialRelatedByUpdatedBy;
        $credentialRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	CredentialRelatedByUpdatedBy $credentialRelatedByUpdatedBy The credentialRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeCredentialRelatedByUpdatedBy($credentialRelatedByUpdatedBy)
    {
        if ($this->getCredentialsRelatedByUpdatedBy()->contains($credentialRelatedByUpdatedBy)) {
            $this->collCredentialsRelatedByUpdatedBy->remove($this->collCredentialsRelatedByUpdatedBy->search($credentialRelatedByUpdatedBy));
            if (null === $this->credentialsRelatedByUpdatedByScheduledForDeletion) {
                $this->credentialsRelatedByUpdatedByScheduledForDeletion = clone $this->collCredentialsRelatedByUpdatedBy;
                $this->credentialsRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->credentialsRelatedByUpdatedByScheduledForDeletion[]= $credentialRelatedByUpdatedBy;
            $credentialRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collLeafsRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addLeafsRelatedByCreatedBy()
     */
    public function clearLeafsRelatedByCreatedBy()
    {
        $this->collLeafsRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collLeafsRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collLeafsRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeafsRelatedByCreatedBy($v = true)
    {
        $this->collLeafsRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collLeafsRelatedByCreatedBy collection.
     *
     * By default this just sets the collLeafsRelatedByCreatedBy collection to an empty array (like clearcollLeafsRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeafsRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collLeafsRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collLeafsRelatedByCreatedBy = new PropelObjectCollection();
        $this->collLeafsRelatedByCreatedBy->setModel('Leaf');
    }

    /**
     * Gets an array of Leaf objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Leaf[] List of Leaf objects
     * @throws PropelException
     */
    public function getLeafsRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeafsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collLeafsRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeafsRelatedByCreatedBy) {
                // return empty collection
                $this->initLeafsRelatedByCreatedBy();
            } else {
                $collLeafsRelatedByCreatedBy = LeafQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeafsRelatedByCreatedByPartial && count($collLeafsRelatedByCreatedBy)) {
                      $this->initLeafsRelatedByCreatedBy(false);

                      foreach($collLeafsRelatedByCreatedBy as $obj) {
                        if (false == $this->collLeafsRelatedByCreatedBy->contains($obj)) {
                          $this->collLeafsRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collLeafsRelatedByCreatedByPartial = true;
                    }

                    $collLeafsRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collLeafsRelatedByCreatedBy;
                }

                if($partial && $this->collLeafsRelatedByCreatedBy) {
                    foreach($this->collLeafsRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collLeafsRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collLeafsRelatedByCreatedBy = $collLeafsRelatedByCreatedBy;
                $this->collLeafsRelatedByCreatedByPartial = false;
            }
        }

        return $this->collLeafsRelatedByCreatedBy;
    }

    /**
     * Sets a collection of LeafRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leafsRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setLeafsRelatedByCreatedBy(PropelCollection $leafsRelatedByCreatedBy, PropelPDO $con = null)
    {
        $leafsRelatedByCreatedByToDelete = $this->getLeafsRelatedByCreatedBy(new Criteria(), $con)->diff($leafsRelatedByCreatedBy);

        $this->leafsRelatedByCreatedByScheduledForDeletion = unserialize(serialize($leafsRelatedByCreatedByToDelete));

        foreach ($leafsRelatedByCreatedByToDelete as $leafRelatedByCreatedByRemoved) {
            $leafRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collLeafsRelatedByCreatedBy = null;
        foreach ($leafsRelatedByCreatedBy as $leafRelatedByCreatedBy) {
            $this->addLeafRelatedByCreatedBy($leafRelatedByCreatedBy);
        }

        $this->collLeafsRelatedByCreatedBy = $leafsRelatedByCreatedBy;
        $this->collLeafsRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Leaf objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Leaf objects.
     * @throws PropelException
     */
    public function countLeafsRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeafsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collLeafsRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeafsRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getLeafsRelatedByCreatedBy());
            }
            $query = LeafQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collLeafsRelatedByCreatedBy);
    }

    /**
     * Method called to associate a Leaf object to this object
     * through the Leaf foreign key attribute.
     *
     * @param    Leaf $l Leaf
     * @return User The current object (for fluent API support)
     */
    public function addLeafRelatedByCreatedBy(Leaf $l)
    {
        if ($this->collLeafsRelatedByCreatedBy === null) {
            $this->initLeafsRelatedByCreatedBy();
            $this->collLeafsRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collLeafsRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeafRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	LeafRelatedByCreatedBy $leafRelatedByCreatedBy The leafRelatedByCreatedBy object to add.
     */
    protected function doAddLeafRelatedByCreatedBy($leafRelatedByCreatedBy)
    {
        $this->collLeafsRelatedByCreatedBy[]= $leafRelatedByCreatedBy;
        $leafRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	LeafRelatedByCreatedBy $leafRelatedByCreatedBy The leafRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeLeafRelatedByCreatedBy($leafRelatedByCreatedBy)
    {
        if ($this->getLeafsRelatedByCreatedBy()->contains($leafRelatedByCreatedBy)) {
            $this->collLeafsRelatedByCreatedBy->remove($this->collLeafsRelatedByCreatedBy->search($leafRelatedByCreatedBy));
            if (null === $this->leafsRelatedByCreatedByScheduledForDeletion) {
                $this->leafsRelatedByCreatedByScheduledForDeletion = clone $this->collLeafsRelatedByCreatedBy;
                $this->leafsRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->leafsRelatedByCreatedByScheduledForDeletion[]= $leafRelatedByCreatedBy;
            $leafRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collLeafsRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addLeafsRelatedByUpdatedBy()
     */
    public function clearLeafsRelatedByUpdatedBy()
    {
        $this->collLeafsRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collLeafsRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collLeafsRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialLeafsRelatedByUpdatedBy($v = true)
    {
        $this->collLeafsRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collLeafsRelatedByUpdatedBy collection.
     *
     * By default this just sets the collLeafsRelatedByUpdatedBy collection to an empty array (like clearcollLeafsRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLeafsRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collLeafsRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collLeafsRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collLeafsRelatedByUpdatedBy->setModel('Leaf');
    }

    /**
     * Gets an array of Leaf objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Leaf[] List of Leaf objects
     * @throws PropelException
     */
    public function getLeafsRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLeafsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collLeafsRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLeafsRelatedByUpdatedBy) {
                // return empty collection
                $this->initLeafsRelatedByUpdatedBy();
            } else {
                $collLeafsRelatedByUpdatedBy = LeafQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLeafsRelatedByUpdatedByPartial && count($collLeafsRelatedByUpdatedBy)) {
                      $this->initLeafsRelatedByUpdatedBy(false);

                      foreach($collLeafsRelatedByUpdatedBy as $obj) {
                        if (false == $this->collLeafsRelatedByUpdatedBy->contains($obj)) {
                          $this->collLeafsRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collLeafsRelatedByUpdatedByPartial = true;
                    }

                    $collLeafsRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collLeafsRelatedByUpdatedBy;
                }

                if($partial && $this->collLeafsRelatedByUpdatedBy) {
                    foreach($this->collLeafsRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collLeafsRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collLeafsRelatedByUpdatedBy = $collLeafsRelatedByUpdatedBy;
                $this->collLeafsRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collLeafsRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of LeafRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $leafsRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setLeafsRelatedByUpdatedBy(PropelCollection $leafsRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $leafsRelatedByUpdatedByToDelete = $this->getLeafsRelatedByUpdatedBy(new Criteria(), $con)->diff($leafsRelatedByUpdatedBy);

        $this->leafsRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($leafsRelatedByUpdatedByToDelete));

        foreach ($leafsRelatedByUpdatedByToDelete as $leafRelatedByUpdatedByRemoved) {
            $leafRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collLeafsRelatedByUpdatedBy = null;
        foreach ($leafsRelatedByUpdatedBy as $leafRelatedByUpdatedBy) {
            $this->addLeafRelatedByUpdatedBy($leafRelatedByUpdatedBy);
        }

        $this->collLeafsRelatedByUpdatedBy = $leafsRelatedByUpdatedBy;
        $this->collLeafsRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Leaf objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Leaf objects.
     * @throws PropelException
     */
    public function countLeafsRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLeafsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collLeafsRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLeafsRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getLeafsRelatedByUpdatedBy());
            }
            $query = LeafQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collLeafsRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a Leaf object to this object
     * through the Leaf foreign key attribute.
     *
     * @param    Leaf $l Leaf
     * @return User The current object (for fluent API support)
     */
    public function addLeafRelatedByUpdatedBy(Leaf $l)
    {
        if ($this->collLeafsRelatedByUpdatedBy === null) {
            $this->initLeafsRelatedByUpdatedBy();
            $this->collLeafsRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collLeafsRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLeafRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	LeafRelatedByUpdatedBy $leafRelatedByUpdatedBy The leafRelatedByUpdatedBy object to add.
     */
    protected function doAddLeafRelatedByUpdatedBy($leafRelatedByUpdatedBy)
    {
        $this->collLeafsRelatedByUpdatedBy[]= $leafRelatedByUpdatedBy;
        $leafRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	LeafRelatedByUpdatedBy $leafRelatedByUpdatedBy The leafRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeLeafRelatedByUpdatedBy($leafRelatedByUpdatedBy)
    {
        if ($this->getLeafsRelatedByUpdatedBy()->contains($leafRelatedByUpdatedBy)) {
            $this->collLeafsRelatedByUpdatedBy->remove($this->collLeafsRelatedByUpdatedBy->search($leafRelatedByUpdatedBy));
            if (null === $this->leafsRelatedByUpdatedByScheduledForDeletion) {
                $this->leafsRelatedByUpdatedByScheduledForDeletion = clone $this->collLeafsRelatedByUpdatedBy;
                $this->leafsRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->leafsRelatedByUpdatedByScheduledForDeletion[]= $leafRelatedByUpdatedBy;
            $leafRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collLefRulsRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addLefRulsRelatedByCreatedBy()
     */
    public function clearLefRulsRelatedByCreatedBy()
    {
        $this->collLefRulsRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collLefRulsRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collLefRulsRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialLefRulsRelatedByCreatedBy($v = true)
    {
        $this->collLefRulsRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collLefRulsRelatedByCreatedBy collection.
     *
     * By default this just sets the collLefRulsRelatedByCreatedBy collection to an empty array (like clearcollLefRulsRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLefRulsRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collLefRulsRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collLefRulsRelatedByCreatedBy = new PropelObjectCollection();
        $this->collLefRulsRelatedByCreatedBy->setModel('LefRul');
    }

    /**
     * Gets an array of LefRul objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     * @throws PropelException
     */
    public function getLefRulsRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLefRulsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collLefRulsRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLefRulsRelatedByCreatedBy) {
                // return empty collection
                $this->initLefRulsRelatedByCreatedBy();
            } else {
                $collLefRulsRelatedByCreatedBy = LefRulQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLefRulsRelatedByCreatedByPartial && count($collLefRulsRelatedByCreatedBy)) {
                      $this->initLefRulsRelatedByCreatedBy(false);

                      foreach($collLefRulsRelatedByCreatedBy as $obj) {
                        if (false == $this->collLefRulsRelatedByCreatedBy->contains($obj)) {
                          $this->collLefRulsRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collLefRulsRelatedByCreatedByPartial = true;
                    }

                    $collLefRulsRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collLefRulsRelatedByCreatedBy;
                }

                if($partial && $this->collLefRulsRelatedByCreatedBy) {
                    foreach($this->collLefRulsRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collLefRulsRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collLefRulsRelatedByCreatedBy = $collLefRulsRelatedByCreatedBy;
                $this->collLefRulsRelatedByCreatedByPartial = false;
            }
        }

        return $this->collLefRulsRelatedByCreatedBy;
    }

    /**
     * Sets a collection of LefRulRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $lefRulsRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setLefRulsRelatedByCreatedBy(PropelCollection $lefRulsRelatedByCreatedBy, PropelPDO $con = null)
    {
        $lefRulsRelatedByCreatedByToDelete = $this->getLefRulsRelatedByCreatedBy(new Criteria(), $con)->diff($lefRulsRelatedByCreatedBy);

        $this->lefRulsRelatedByCreatedByScheduledForDeletion = unserialize(serialize($lefRulsRelatedByCreatedByToDelete));

        foreach ($lefRulsRelatedByCreatedByToDelete as $lefRulRelatedByCreatedByRemoved) {
            $lefRulRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collLefRulsRelatedByCreatedBy = null;
        foreach ($lefRulsRelatedByCreatedBy as $lefRulRelatedByCreatedBy) {
            $this->addLefRulRelatedByCreatedBy($lefRulRelatedByCreatedBy);
        }

        $this->collLefRulsRelatedByCreatedBy = $lefRulsRelatedByCreatedBy;
        $this->collLefRulsRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LefRul objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LefRul objects.
     * @throws PropelException
     */
    public function countLefRulsRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLefRulsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collLefRulsRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLefRulsRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getLefRulsRelatedByCreatedBy());
            }
            $query = LefRulQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collLefRulsRelatedByCreatedBy);
    }

    /**
     * Method called to associate a LefRul object to this object
     * through the LefRul foreign key attribute.
     *
     * @param    LefRul $l LefRul
     * @return User The current object (for fluent API support)
     */
    public function addLefRulRelatedByCreatedBy(LefRul $l)
    {
        if ($this->collLefRulsRelatedByCreatedBy === null) {
            $this->initLefRulsRelatedByCreatedBy();
            $this->collLefRulsRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collLefRulsRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLefRulRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	LefRulRelatedByCreatedBy $lefRulRelatedByCreatedBy The lefRulRelatedByCreatedBy object to add.
     */
    protected function doAddLefRulRelatedByCreatedBy($lefRulRelatedByCreatedBy)
    {
        $this->collLefRulsRelatedByCreatedBy[]= $lefRulRelatedByCreatedBy;
        $lefRulRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	LefRulRelatedByCreatedBy $lefRulRelatedByCreatedBy The lefRulRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeLefRulRelatedByCreatedBy($lefRulRelatedByCreatedBy)
    {
        if ($this->getLefRulsRelatedByCreatedBy()->contains($lefRulRelatedByCreatedBy)) {
            $this->collLefRulsRelatedByCreatedBy->remove($this->collLefRulsRelatedByCreatedBy->search($lefRulRelatedByCreatedBy));
            if (null === $this->lefRulsRelatedByCreatedByScheduledForDeletion) {
                $this->lefRulsRelatedByCreatedByScheduledForDeletion = clone $this->collLefRulsRelatedByCreatedBy;
                $this->lefRulsRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->lefRulsRelatedByCreatedByScheduledForDeletion[]= $lefRulRelatedByCreatedBy;
            $lefRulRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related LefRulsRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     */
    public function getLefRulsRelatedByCreatedByJoinRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LefRulQuery::create(null, $criteria);
        $query->joinWith('Rule', $join_behavior);

        return $this->getLefRulsRelatedByCreatedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related LefRulsRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     */
    public function getLefRulsRelatedByCreatedByJoinLeaf($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LefRulQuery::create(null, $criteria);
        $query->joinWith('Leaf', $join_behavior);

        return $this->getLefRulsRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collLefRulsRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addLefRulsRelatedByUpdatedBy()
     */
    public function clearLefRulsRelatedByUpdatedBy()
    {
        $this->collLefRulsRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collLefRulsRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collLefRulsRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialLefRulsRelatedByUpdatedBy($v = true)
    {
        $this->collLefRulsRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collLefRulsRelatedByUpdatedBy collection.
     *
     * By default this just sets the collLefRulsRelatedByUpdatedBy collection to an empty array (like clearcollLefRulsRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLefRulsRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collLefRulsRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collLefRulsRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collLefRulsRelatedByUpdatedBy->setModel('LefRul');
    }

    /**
     * Gets an array of LefRul objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     * @throws PropelException
     */
    public function getLefRulsRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLefRulsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collLefRulsRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLefRulsRelatedByUpdatedBy) {
                // return empty collection
                $this->initLefRulsRelatedByUpdatedBy();
            } else {
                $collLefRulsRelatedByUpdatedBy = LefRulQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLefRulsRelatedByUpdatedByPartial && count($collLefRulsRelatedByUpdatedBy)) {
                      $this->initLefRulsRelatedByUpdatedBy(false);

                      foreach($collLefRulsRelatedByUpdatedBy as $obj) {
                        if (false == $this->collLefRulsRelatedByUpdatedBy->contains($obj)) {
                          $this->collLefRulsRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collLefRulsRelatedByUpdatedByPartial = true;
                    }

                    $collLefRulsRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collLefRulsRelatedByUpdatedBy;
                }

                if($partial && $this->collLefRulsRelatedByUpdatedBy) {
                    foreach($this->collLefRulsRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collLefRulsRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collLefRulsRelatedByUpdatedBy = $collLefRulsRelatedByUpdatedBy;
                $this->collLefRulsRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collLefRulsRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of LefRulRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $lefRulsRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setLefRulsRelatedByUpdatedBy(PropelCollection $lefRulsRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $lefRulsRelatedByUpdatedByToDelete = $this->getLefRulsRelatedByUpdatedBy(new Criteria(), $con)->diff($lefRulsRelatedByUpdatedBy);

        $this->lefRulsRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($lefRulsRelatedByUpdatedByToDelete));

        foreach ($lefRulsRelatedByUpdatedByToDelete as $lefRulRelatedByUpdatedByRemoved) {
            $lefRulRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collLefRulsRelatedByUpdatedBy = null;
        foreach ($lefRulsRelatedByUpdatedBy as $lefRulRelatedByUpdatedBy) {
            $this->addLefRulRelatedByUpdatedBy($lefRulRelatedByUpdatedBy);
        }

        $this->collLefRulsRelatedByUpdatedBy = $lefRulsRelatedByUpdatedBy;
        $this->collLefRulsRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related LefRul objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related LefRul objects.
     * @throws PropelException
     */
    public function countLefRulsRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLefRulsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collLefRulsRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLefRulsRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getLefRulsRelatedByUpdatedBy());
            }
            $query = LefRulQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collLefRulsRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a LefRul object to this object
     * through the LefRul foreign key attribute.
     *
     * @param    LefRul $l LefRul
     * @return User The current object (for fluent API support)
     */
    public function addLefRulRelatedByUpdatedBy(LefRul $l)
    {
        if ($this->collLefRulsRelatedByUpdatedBy === null) {
            $this->initLefRulsRelatedByUpdatedBy();
            $this->collLefRulsRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collLefRulsRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLefRulRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	LefRulRelatedByUpdatedBy $lefRulRelatedByUpdatedBy The lefRulRelatedByUpdatedBy object to add.
     */
    protected function doAddLefRulRelatedByUpdatedBy($lefRulRelatedByUpdatedBy)
    {
        $this->collLefRulsRelatedByUpdatedBy[]= $lefRulRelatedByUpdatedBy;
        $lefRulRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	LefRulRelatedByUpdatedBy $lefRulRelatedByUpdatedBy The lefRulRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeLefRulRelatedByUpdatedBy($lefRulRelatedByUpdatedBy)
    {
        if ($this->getLefRulsRelatedByUpdatedBy()->contains($lefRulRelatedByUpdatedBy)) {
            $this->collLefRulsRelatedByUpdatedBy->remove($this->collLefRulsRelatedByUpdatedBy->search($lefRulRelatedByUpdatedBy));
            if (null === $this->lefRulsRelatedByUpdatedByScheduledForDeletion) {
                $this->lefRulsRelatedByUpdatedByScheduledForDeletion = clone $this->collLefRulsRelatedByUpdatedBy;
                $this->lefRulsRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->lefRulsRelatedByUpdatedByScheduledForDeletion[]= $lefRulRelatedByUpdatedBy;
            $lefRulRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related LefRulsRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     */
    public function getLefRulsRelatedByUpdatedByJoinRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LefRulQuery::create(null, $criteria);
        $query->joinWith('Rule', $join_behavior);

        return $this->getLefRulsRelatedByUpdatedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related LefRulsRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     */
    public function getLefRulsRelatedByUpdatedByJoinLeaf($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LefRulQuery::create(null, $criteria);
        $query->joinWith('Leaf', $join_behavior);

        return $this->getLefRulsRelatedByUpdatedBy($query, $con);
    }

    /**
     * Clears out the collNodeTreesRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addNodeTreesRelatedByCreatedBy()
     */
    public function clearNodeTreesRelatedByCreatedBy()
    {
        $this->collNodeTreesRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collNodeTreesRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collNodeTreesRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialNodeTreesRelatedByCreatedBy($v = true)
    {
        $this->collNodeTreesRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collNodeTreesRelatedByCreatedBy collection.
     *
     * By default this just sets the collNodeTreesRelatedByCreatedBy collection to an empty array (like clearcollNodeTreesRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNodeTreesRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collNodeTreesRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collNodeTreesRelatedByCreatedBy = new PropelObjectCollection();
        $this->collNodeTreesRelatedByCreatedBy->setModel('NodeTree');
    }

    /**
     * Gets an array of NodeTree objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     * @throws PropelException
     */
    public function getNodeTreesRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collNodeTreesRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNodeTreesRelatedByCreatedBy) {
                // return empty collection
                $this->initNodeTreesRelatedByCreatedBy();
            } else {
                $collNodeTreesRelatedByCreatedBy = NodeTreeQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNodeTreesRelatedByCreatedByPartial && count($collNodeTreesRelatedByCreatedBy)) {
                      $this->initNodeTreesRelatedByCreatedBy(false);

                      foreach($collNodeTreesRelatedByCreatedBy as $obj) {
                        if (false == $this->collNodeTreesRelatedByCreatedBy->contains($obj)) {
                          $this->collNodeTreesRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collNodeTreesRelatedByCreatedByPartial = true;
                    }

                    $collNodeTreesRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collNodeTreesRelatedByCreatedBy;
                }

                if($partial && $this->collNodeTreesRelatedByCreatedBy) {
                    foreach($this->collNodeTreesRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collNodeTreesRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collNodeTreesRelatedByCreatedBy = $collNodeTreesRelatedByCreatedBy;
                $this->collNodeTreesRelatedByCreatedByPartial = false;
            }
        }

        return $this->collNodeTreesRelatedByCreatedBy;
    }

    /**
     * Sets a collection of NodeTreeRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nodeTreesRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setNodeTreesRelatedByCreatedBy(PropelCollection $nodeTreesRelatedByCreatedBy, PropelPDO $con = null)
    {
        $nodeTreesRelatedByCreatedByToDelete = $this->getNodeTreesRelatedByCreatedBy(new Criteria(), $con)->diff($nodeTreesRelatedByCreatedBy);

        $this->nodeTreesRelatedByCreatedByScheduledForDeletion = unserialize(serialize($nodeTreesRelatedByCreatedByToDelete));

        foreach ($nodeTreesRelatedByCreatedByToDelete as $nodeTreeRelatedByCreatedByRemoved) {
            $nodeTreeRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collNodeTreesRelatedByCreatedBy = null;
        foreach ($nodeTreesRelatedByCreatedBy as $nodeTreeRelatedByCreatedBy) {
            $this->addNodeTreeRelatedByCreatedBy($nodeTreeRelatedByCreatedBy);
        }

        $this->collNodeTreesRelatedByCreatedBy = $nodeTreesRelatedByCreatedBy;
        $this->collNodeTreesRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NodeTree objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NodeTree objects.
     * @throws PropelException
     */
    public function countNodeTreesRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collNodeTreesRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNodeTreesRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getNodeTreesRelatedByCreatedBy());
            }
            $query = NodeTreeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collNodeTreesRelatedByCreatedBy);
    }

    /**
     * Method called to associate a NodeTree object to this object
     * through the NodeTree foreign key attribute.
     *
     * @param    NodeTree $l NodeTree
     * @return User The current object (for fluent API support)
     */
    public function addNodeTreeRelatedByCreatedBy(NodeTree $l)
    {
        if ($this->collNodeTreesRelatedByCreatedBy === null) {
            $this->initNodeTreesRelatedByCreatedBy();
            $this->collNodeTreesRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collNodeTreesRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNodeTreeRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	NodeTreeRelatedByCreatedBy $nodeTreeRelatedByCreatedBy The nodeTreeRelatedByCreatedBy object to add.
     */
    protected function doAddNodeTreeRelatedByCreatedBy($nodeTreeRelatedByCreatedBy)
    {
        $this->collNodeTreesRelatedByCreatedBy[]= $nodeTreeRelatedByCreatedBy;
        $nodeTreeRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	NodeTreeRelatedByCreatedBy $nodeTreeRelatedByCreatedBy The nodeTreeRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeNodeTreeRelatedByCreatedBy($nodeTreeRelatedByCreatedBy)
    {
        if ($this->getNodeTreesRelatedByCreatedBy()->contains($nodeTreeRelatedByCreatedBy)) {
            $this->collNodeTreesRelatedByCreatedBy->remove($this->collNodeTreesRelatedByCreatedBy->search($nodeTreeRelatedByCreatedBy));
            if (null === $this->nodeTreesRelatedByCreatedByScheduledForDeletion) {
                $this->nodeTreesRelatedByCreatedByScheduledForDeletion = clone $this->collNodeTreesRelatedByCreatedBy;
                $this->nodeTreesRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->nodeTreesRelatedByCreatedByScheduledForDeletion[]= $nodeTreeRelatedByCreatedBy;
            $nodeTreeRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related NodeTreesRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByCreatedByJoinLeaf($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('Leaf', $join_behavior);

        return $this->getNodeTreesRelatedByCreatedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related NodeTreesRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByCreatedByJoinBranchRelatedByBchId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('BranchRelatedByBchId', $join_behavior);

        return $this->getNodeTreesRelatedByCreatedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related NodeTreesRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByCreatedByJoinBranchRelatedByBchParent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('BranchRelatedByBchParent', $join_behavior);

        return $this->getNodeTreesRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collNodeTreesRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addNodeTreesRelatedByUpdatedBy()
     */
    public function clearNodeTreesRelatedByUpdatedBy()
    {
        $this->collNodeTreesRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collNodeTreesRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collNodeTreesRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialNodeTreesRelatedByUpdatedBy($v = true)
    {
        $this->collNodeTreesRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collNodeTreesRelatedByUpdatedBy collection.
     *
     * By default this just sets the collNodeTreesRelatedByUpdatedBy collection to an empty array (like clearcollNodeTreesRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNodeTreesRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collNodeTreesRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collNodeTreesRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collNodeTreesRelatedByUpdatedBy->setModel('NodeTree');
    }

    /**
     * Gets an array of NodeTree objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     * @throws PropelException
     */
    public function getNodeTreesRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collNodeTreesRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNodeTreesRelatedByUpdatedBy) {
                // return empty collection
                $this->initNodeTreesRelatedByUpdatedBy();
            } else {
                $collNodeTreesRelatedByUpdatedBy = NodeTreeQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNodeTreesRelatedByUpdatedByPartial && count($collNodeTreesRelatedByUpdatedBy)) {
                      $this->initNodeTreesRelatedByUpdatedBy(false);

                      foreach($collNodeTreesRelatedByUpdatedBy as $obj) {
                        if (false == $this->collNodeTreesRelatedByUpdatedBy->contains($obj)) {
                          $this->collNodeTreesRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collNodeTreesRelatedByUpdatedByPartial = true;
                    }

                    $collNodeTreesRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collNodeTreesRelatedByUpdatedBy;
                }

                if($partial && $this->collNodeTreesRelatedByUpdatedBy) {
                    foreach($this->collNodeTreesRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collNodeTreesRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collNodeTreesRelatedByUpdatedBy = $collNodeTreesRelatedByUpdatedBy;
                $this->collNodeTreesRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collNodeTreesRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of NodeTreeRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nodeTreesRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setNodeTreesRelatedByUpdatedBy(PropelCollection $nodeTreesRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $nodeTreesRelatedByUpdatedByToDelete = $this->getNodeTreesRelatedByUpdatedBy(new Criteria(), $con)->diff($nodeTreesRelatedByUpdatedBy);

        $this->nodeTreesRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($nodeTreesRelatedByUpdatedByToDelete));

        foreach ($nodeTreesRelatedByUpdatedByToDelete as $nodeTreeRelatedByUpdatedByRemoved) {
            $nodeTreeRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collNodeTreesRelatedByUpdatedBy = null;
        foreach ($nodeTreesRelatedByUpdatedBy as $nodeTreeRelatedByUpdatedBy) {
            $this->addNodeTreeRelatedByUpdatedBy($nodeTreeRelatedByUpdatedBy);
        }

        $this->collNodeTreesRelatedByUpdatedBy = $nodeTreesRelatedByUpdatedBy;
        $this->collNodeTreesRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related NodeTree objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related NodeTree objects.
     * @throws PropelException
     */
    public function countNodeTreesRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collNodeTreesRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNodeTreesRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getNodeTreesRelatedByUpdatedBy());
            }
            $query = NodeTreeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collNodeTreesRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a NodeTree object to this object
     * through the NodeTree foreign key attribute.
     *
     * @param    NodeTree $l NodeTree
     * @return User The current object (for fluent API support)
     */
    public function addNodeTreeRelatedByUpdatedBy(NodeTree $l)
    {
        if ($this->collNodeTreesRelatedByUpdatedBy === null) {
            $this->initNodeTreesRelatedByUpdatedBy();
            $this->collNodeTreesRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collNodeTreesRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNodeTreeRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	NodeTreeRelatedByUpdatedBy $nodeTreeRelatedByUpdatedBy The nodeTreeRelatedByUpdatedBy object to add.
     */
    protected function doAddNodeTreeRelatedByUpdatedBy($nodeTreeRelatedByUpdatedBy)
    {
        $this->collNodeTreesRelatedByUpdatedBy[]= $nodeTreeRelatedByUpdatedBy;
        $nodeTreeRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	NodeTreeRelatedByUpdatedBy $nodeTreeRelatedByUpdatedBy The nodeTreeRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeNodeTreeRelatedByUpdatedBy($nodeTreeRelatedByUpdatedBy)
    {
        if ($this->getNodeTreesRelatedByUpdatedBy()->contains($nodeTreeRelatedByUpdatedBy)) {
            $this->collNodeTreesRelatedByUpdatedBy->remove($this->collNodeTreesRelatedByUpdatedBy->search($nodeTreeRelatedByUpdatedBy));
            if (null === $this->nodeTreesRelatedByUpdatedByScheduledForDeletion) {
                $this->nodeTreesRelatedByUpdatedByScheduledForDeletion = clone $this->collNodeTreesRelatedByUpdatedBy;
                $this->nodeTreesRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->nodeTreesRelatedByUpdatedByScheduledForDeletion[]= $nodeTreeRelatedByUpdatedBy;
            $nodeTreeRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related NodeTreesRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByUpdatedByJoinLeaf($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('Leaf', $join_behavior);

        return $this->getNodeTreesRelatedByUpdatedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related NodeTreesRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByUpdatedByJoinBranchRelatedByBchId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('BranchRelatedByBchId', $join_behavior);

        return $this->getNodeTreesRelatedByUpdatedBy($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related NodeTreesRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByUpdatedByJoinBranchRelatedByBchParent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('BranchRelatedByBchParent', $join_behavior);

        return $this->getNodeTreesRelatedByUpdatedBy($query, $con);
    }

    /**
     * Clears out the collRulOptionsRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addRulOptionsRelatedByCreatedBy()
     */
    public function clearRulOptionsRelatedByCreatedBy()
    {
        $this->collRulOptionsRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collRulOptionsRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collRulOptionsRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialRulOptionsRelatedByCreatedBy($v = true)
    {
        $this->collRulOptionsRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collRulOptionsRelatedByCreatedBy collection.
     *
     * By default this just sets the collRulOptionsRelatedByCreatedBy collection to an empty array (like clearcollRulOptionsRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRulOptionsRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collRulOptionsRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collRulOptionsRelatedByCreatedBy = new PropelObjectCollection();
        $this->collRulOptionsRelatedByCreatedBy->setModel('RulOption');
    }

    /**
     * Gets an array of RulOption objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|RulOption[] List of RulOption objects
     * @throws PropelException
     */
    public function getRulOptionsRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRulOptionsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collRulOptionsRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRulOptionsRelatedByCreatedBy) {
                // return empty collection
                $this->initRulOptionsRelatedByCreatedBy();
            } else {
                $collRulOptionsRelatedByCreatedBy = RulOptionQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRulOptionsRelatedByCreatedByPartial && count($collRulOptionsRelatedByCreatedBy)) {
                      $this->initRulOptionsRelatedByCreatedBy(false);

                      foreach($collRulOptionsRelatedByCreatedBy as $obj) {
                        if (false == $this->collRulOptionsRelatedByCreatedBy->contains($obj)) {
                          $this->collRulOptionsRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collRulOptionsRelatedByCreatedByPartial = true;
                    }

                    $collRulOptionsRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collRulOptionsRelatedByCreatedBy;
                }

                if($partial && $this->collRulOptionsRelatedByCreatedBy) {
                    foreach($this->collRulOptionsRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collRulOptionsRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collRulOptionsRelatedByCreatedBy = $collRulOptionsRelatedByCreatedBy;
                $this->collRulOptionsRelatedByCreatedByPartial = false;
            }
        }

        return $this->collRulOptionsRelatedByCreatedBy;
    }

    /**
     * Sets a collection of RulOptionRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rulOptionsRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setRulOptionsRelatedByCreatedBy(PropelCollection $rulOptionsRelatedByCreatedBy, PropelPDO $con = null)
    {
        $rulOptionsRelatedByCreatedByToDelete = $this->getRulOptionsRelatedByCreatedBy(new Criteria(), $con)->diff($rulOptionsRelatedByCreatedBy);

        $this->rulOptionsRelatedByCreatedByScheduledForDeletion = unserialize(serialize($rulOptionsRelatedByCreatedByToDelete));

        foreach ($rulOptionsRelatedByCreatedByToDelete as $rulOptionRelatedByCreatedByRemoved) {
            $rulOptionRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collRulOptionsRelatedByCreatedBy = null;
        foreach ($rulOptionsRelatedByCreatedBy as $rulOptionRelatedByCreatedBy) {
            $this->addRulOptionRelatedByCreatedBy($rulOptionRelatedByCreatedBy);
        }

        $this->collRulOptionsRelatedByCreatedBy = $rulOptionsRelatedByCreatedBy;
        $this->collRulOptionsRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RulOption objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related RulOption objects.
     * @throws PropelException
     */
    public function countRulOptionsRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRulOptionsRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collRulOptionsRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRulOptionsRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRulOptionsRelatedByCreatedBy());
            }
            $query = RulOptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collRulOptionsRelatedByCreatedBy);
    }

    /**
     * Method called to associate a RulOption object to this object
     * through the RulOption foreign key attribute.
     *
     * @param    RulOption $l RulOption
     * @return User The current object (for fluent API support)
     */
    public function addRulOptionRelatedByCreatedBy(RulOption $l)
    {
        if ($this->collRulOptionsRelatedByCreatedBy === null) {
            $this->initRulOptionsRelatedByCreatedBy();
            $this->collRulOptionsRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collRulOptionsRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRulOptionRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	RulOptionRelatedByCreatedBy $rulOptionRelatedByCreatedBy The rulOptionRelatedByCreatedBy object to add.
     */
    protected function doAddRulOptionRelatedByCreatedBy($rulOptionRelatedByCreatedBy)
    {
        $this->collRulOptionsRelatedByCreatedBy[]= $rulOptionRelatedByCreatedBy;
        $rulOptionRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	RulOptionRelatedByCreatedBy $rulOptionRelatedByCreatedBy The rulOptionRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeRulOptionRelatedByCreatedBy($rulOptionRelatedByCreatedBy)
    {
        if ($this->getRulOptionsRelatedByCreatedBy()->contains($rulOptionRelatedByCreatedBy)) {
            $this->collRulOptionsRelatedByCreatedBy->remove($this->collRulOptionsRelatedByCreatedBy->search($rulOptionRelatedByCreatedBy));
            if (null === $this->rulOptionsRelatedByCreatedByScheduledForDeletion) {
                $this->rulOptionsRelatedByCreatedByScheduledForDeletion = clone $this->collRulOptionsRelatedByCreatedBy;
                $this->rulOptionsRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->rulOptionsRelatedByCreatedByScheduledForDeletion[]= $rulOptionRelatedByCreatedBy;
            $rulOptionRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RulOptionsRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|RulOption[] List of RulOption objects
     */
    public function getRulOptionsRelatedByCreatedByJoinRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RulOptionQuery::create(null, $criteria);
        $query->joinWith('Rule', $join_behavior);

        return $this->getRulOptionsRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collRulOptionsRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addRulOptionsRelatedByUpdatedBy()
     */
    public function clearRulOptionsRelatedByUpdatedBy()
    {
        $this->collRulOptionsRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collRulOptionsRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collRulOptionsRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialRulOptionsRelatedByUpdatedBy($v = true)
    {
        $this->collRulOptionsRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collRulOptionsRelatedByUpdatedBy collection.
     *
     * By default this just sets the collRulOptionsRelatedByUpdatedBy collection to an empty array (like clearcollRulOptionsRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRulOptionsRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collRulOptionsRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collRulOptionsRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collRulOptionsRelatedByUpdatedBy->setModel('RulOption');
    }

    /**
     * Gets an array of RulOption objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|RulOption[] List of RulOption objects
     * @throws PropelException
     */
    public function getRulOptionsRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRulOptionsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collRulOptionsRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRulOptionsRelatedByUpdatedBy) {
                // return empty collection
                $this->initRulOptionsRelatedByUpdatedBy();
            } else {
                $collRulOptionsRelatedByUpdatedBy = RulOptionQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRulOptionsRelatedByUpdatedByPartial && count($collRulOptionsRelatedByUpdatedBy)) {
                      $this->initRulOptionsRelatedByUpdatedBy(false);

                      foreach($collRulOptionsRelatedByUpdatedBy as $obj) {
                        if (false == $this->collRulOptionsRelatedByUpdatedBy->contains($obj)) {
                          $this->collRulOptionsRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collRulOptionsRelatedByUpdatedByPartial = true;
                    }

                    $collRulOptionsRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collRulOptionsRelatedByUpdatedBy;
                }

                if($partial && $this->collRulOptionsRelatedByUpdatedBy) {
                    foreach($this->collRulOptionsRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collRulOptionsRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collRulOptionsRelatedByUpdatedBy = $collRulOptionsRelatedByUpdatedBy;
                $this->collRulOptionsRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collRulOptionsRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of RulOptionRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rulOptionsRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setRulOptionsRelatedByUpdatedBy(PropelCollection $rulOptionsRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $rulOptionsRelatedByUpdatedByToDelete = $this->getRulOptionsRelatedByUpdatedBy(new Criteria(), $con)->diff($rulOptionsRelatedByUpdatedBy);

        $this->rulOptionsRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($rulOptionsRelatedByUpdatedByToDelete));

        foreach ($rulOptionsRelatedByUpdatedByToDelete as $rulOptionRelatedByUpdatedByRemoved) {
            $rulOptionRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collRulOptionsRelatedByUpdatedBy = null;
        foreach ($rulOptionsRelatedByUpdatedBy as $rulOptionRelatedByUpdatedBy) {
            $this->addRulOptionRelatedByUpdatedBy($rulOptionRelatedByUpdatedBy);
        }

        $this->collRulOptionsRelatedByUpdatedBy = $rulOptionsRelatedByUpdatedBy;
        $this->collRulOptionsRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related RulOption objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related RulOption objects.
     * @throws PropelException
     */
    public function countRulOptionsRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRulOptionsRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collRulOptionsRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRulOptionsRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRulOptionsRelatedByUpdatedBy());
            }
            $query = RulOptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collRulOptionsRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a RulOption object to this object
     * through the RulOption foreign key attribute.
     *
     * @param    RulOption $l RulOption
     * @return User The current object (for fluent API support)
     */
    public function addRulOptionRelatedByUpdatedBy(RulOption $l)
    {
        if ($this->collRulOptionsRelatedByUpdatedBy === null) {
            $this->initRulOptionsRelatedByUpdatedBy();
            $this->collRulOptionsRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collRulOptionsRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRulOptionRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	RulOptionRelatedByUpdatedBy $rulOptionRelatedByUpdatedBy The rulOptionRelatedByUpdatedBy object to add.
     */
    protected function doAddRulOptionRelatedByUpdatedBy($rulOptionRelatedByUpdatedBy)
    {
        $this->collRulOptionsRelatedByUpdatedBy[]= $rulOptionRelatedByUpdatedBy;
        $rulOptionRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	RulOptionRelatedByUpdatedBy $rulOptionRelatedByUpdatedBy The rulOptionRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeRulOptionRelatedByUpdatedBy($rulOptionRelatedByUpdatedBy)
    {
        if ($this->getRulOptionsRelatedByUpdatedBy()->contains($rulOptionRelatedByUpdatedBy)) {
            $this->collRulOptionsRelatedByUpdatedBy->remove($this->collRulOptionsRelatedByUpdatedBy->search($rulOptionRelatedByUpdatedBy));
            if (null === $this->rulOptionsRelatedByUpdatedByScheduledForDeletion) {
                $this->rulOptionsRelatedByUpdatedByScheduledForDeletion = clone $this->collRulOptionsRelatedByUpdatedBy;
                $this->rulOptionsRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->rulOptionsRelatedByUpdatedByScheduledForDeletion[]= $rulOptionRelatedByUpdatedBy;
            $rulOptionRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RulOptionsRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|RulOption[] List of RulOption objects
     */
    public function getRulOptionsRelatedByUpdatedByJoinRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RulOptionQuery::create(null, $criteria);
        $query->joinWith('Rule', $join_behavior);

        return $this->getRulOptionsRelatedByUpdatedBy($query, $con);
    }

    /**
     * Clears out the collRulesRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addRulesRelatedByCreatedBy()
     */
    public function clearRulesRelatedByCreatedBy()
    {
        $this->collRulesRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collRulesRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collRulesRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialRulesRelatedByCreatedBy($v = true)
    {
        $this->collRulesRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collRulesRelatedByCreatedBy collection.
     *
     * By default this just sets the collRulesRelatedByCreatedBy collection to an empty array (like clearcollRulesRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRulesRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collRulesRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collRulesRelatedByCreatedBy = new PropelObjectCollection();
        $this->collRulesRelatedByCreatedBy->setModel('Rule');
    }

    /**
     * Gets an array of Rule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Rule[] List of Rule objects
     * @throws PropelException
     */
    public function getRulesRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRulesRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collRulesRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRulesRelatedByCreatedBy) {
                // return empty collection
                $this->initRulesRelatedByCreatedBy();
            } else {
                $collRulesRelatedByCreatedBy = RuleQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRulesRelatedByCreatedByPartial && count($collRulesRelatedByCreatedBy)) {
                      $this->initRulesRelatedByCreatedBy(false);

                      foreach($collRulesRelatedByCreatedBy as $obj) {
                        if (false == $this->collRulesRelatedByCreatedBy->contains($obj)) {
                          $this->collRulesRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collRulesRelatedByCreatedByPartial = true;
                    }

                    $collRulesRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collRulesRelatedByCreatedBy;
                }

                if($partial && $this->collRulesRelatedByCreatedBy) {
                    foreach($this->collRulesRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collRulesRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collRulesRelatedByCreatedBy = $collRulesRelatedByCreatedBy;
                $this->collRulesRelatedByCreatedByPartial = false;
            }
        }

        return $this->collRulesRelatedByCreatedBy;
    }

    /**
     * Sets a collection of RuleRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rulesRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setRulesRelatedByCreatedBy(PropelCollection $rulesRelatedByCreatedBy, PropelPDO $con = null)
    {
        $rulesRelatedByCreatedByToDelete = $this->getRulesRelatedByCreatedBy(new Criteria(), $con)->diff($rulesRelatedByCreatedBy);

        $this->rulesRelatedByCreatedByScheduledForDeletion = unserialize(serialize($rulesRelatedByCreatedByToDelete));

        foreach ($rulesRelatedByCreatedByToDelete as $ruleRelatedByCreatedByRemoved) {
            $ruleRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collRulesRelatedByCreatedBy = null;
        foreach ($rulesRelatedByCreatedBy as $ruleRelatedByCreatedBy) {
            $this->addRuleRelatedByCreatedBy($ruleRelatedByCreatedBy);
        }

        $this->collRulesRelatedByCreatedBy = $rulesRelatedByCreatedBy;
        $this->collRulesRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Rule objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Rule objects.
     * @throws PropelException
     */
    public function countRulesRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRulesRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collRulesRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRulesRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRulesRelatedByCreatedBy());
            }
            $query = RuleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collRulesRelatedByCreatedBy);
    }

    /**
     * Method called to associate a Rule object to this object
     * through the Rule foreign key attribute.
     *
     * @param    Rule $l Rule
     * @return User The current object (for fluent API support)
     */
    public function addRuleRelatedByCreatedBy(Rule $l)
    {
        if ($this->collRulesRelatedByCreatedBy === null) {
            $this->initRulesRelatedByCreatedBy();
            $this->collRulesRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collRulesRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRuleRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	RuleRelatedByCreatedBy $ruleRelatedByCreatedBy The ruleRelatedByCreatedBy object to add.
     */
    protected function doAddRuleRelatedByCreatedBy($ruleRelatedByCreatedBy)
    {
        $this->collRulesRelatedByCreatedBy[]= $ruleRelatedByCreatedBy;
        $ruleRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	RuleRelatedByCreatedBy $ruleRelatedByCreatedBy The ruleRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeRuleRelatedByCreatedBy($ruleRelatedByCreatedBy)
    {
        if ($this->getRulesRelatedByCreatedBy()->contains($ruleRelatedByCreatedBy)) {
            $this->collRulesRelatedByCreatedBy->remove($this->collRulesRelatedByCreatedBy->search($ruleRelatedByCreatedBy));
            if (null === $this->rulesRelatedByCreatedByScheduledForDeletion) {
                $this->rulesRelatedByCreatedByScheduledForDeletion = clone $this->collRulesRelatedByCreatedBy;
                $this->rulesRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->rulesRelatedByCreatedByScheduledForDeletion[]= $ruleRelatedByCreatedBy;
            $ruleRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RulesRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Rule[] List of Rule objects
     */
    public function getRulesRelatedByCreatedByJoinTypeRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RuleQuery::create(null, $criteria);
        $query->joinWith('TypeRule', $join_behavior);

        return $this->getRulesRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collRulesRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addRulesRelatedByUpdatedBy()
     */
    public function clearRulesRelatedByUpdatedBy()
    {
        $this->collRulesRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collRulesRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collRulesRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialRulesRelatedByUpdatedBy($v = true)
    {
        $this->collRulesRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collRulesRelatedByUpdatedBy collection.
     *
     * By default this just sets the collRulesRelatedByUpdatedBy collection to an empty array (like clearcollRulesRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRulesRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collRulesRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collRulesRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collRulesRelatedByUpdatedBy->setModel('Rule');
    }

    /**
     * Gets an array of Rule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Rule[] List of Rule objects
     * @throws PropelException
     */
    public function getRulesRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRulesRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collRulesRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRulesRelatedByUpdatedBy) {
                // return empty collection
                $this->initRulesRelatedByUpdatedBy();
            } else {
                $collRulesRelatedByUpdatedBy = RuleQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRulesRelatedByUpdatedByPartial && count($collRulesRelatedByUpdatedBy)) {
                      $this->initRulesRelatedByUpdatedBy(false);

                      foreach($collRulesRelatedByUpdatedBy as $obj) {
                        if (false == $this->collRulesRelatedByUpdatedBy->contains($obj)) {
                          $this->collRulesRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collRulesRelatedByUpdatedByPartial = true;
                    }

                    $collRulesRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collRulesRelatedByUpdatedBy;
                }

                if($partial && $this->collRulesRelatedByUpdatedBy) {
                    foreach($this->collRulesRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collRulesRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collRulesRelatedByUpdatedBy = $collRulesRelatedByUpdatedBy;
                $this->collRulesRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collRulesRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of RuleRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rulesRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setRulesRelatedByUpdatedBy(PropelCollection $rulesRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $rulesRelatedByUpdatedByToDelete = $this->getRulesRelatedByUpdatedBy(new Criteria(), $con)->diff($rulesRelatedByUpdatedBy);

        $this->rulesRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($rulesRelatedByUpdatedByToDelete));

        foreach ($rulesRelatedByUpdatedByToDelete as $ruleRelatedByUpdatedByRemoved) {
            $ruleRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collRulesRelatedByUpdatedBy = null;
        foreach ($rulesRelatedByUpdatedBy as $ruleRelatedByUpdatedBy) {
            $this->addRuleRelatedByUpdatedBy($ruleRelatedByUpdatedBy);
        }

        $this->collRulesRelatedByUpdatedBy = $rulesRelatedByUpdatedBy;
        $this->collRulesRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Rule objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Rule objects.
     * @throws PropelException
     */
    public function countRulesRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRulesRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collRulesRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRulesRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRulesRelatedByUpdatedBy());
            }
            $query = RuleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collRulesRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a Rule object to this object
     * through the Rule foreign key attribute.
     *
     * @param    Rule $l Rule
     * @return User The current object (for fluent API support)
     */
    public function addRuleRelatedByUpdatedBy(Rule $l)
    {
        if ($this->collRulesRelatedByUpdatedBy === null) {
            $this->initRulesRelatedByUpdatedBy();
            $this->collRulesRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collRulesRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRuleRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	RuleRelatedByUpdatedBy $ruleRelatedByUpdatedBy The ruleRelatedByUpdatedBy object to add.
     */
    protected function doAddRuleRelatedByUpdatedBy($ruleRelatedByUpdatedBy)
    {
        $this->collRulesRelatedByUpdatedBy[]= $ruleRelatedByUpdatedBy;
        $ruleRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	RuleRelatedByUpdatedBy $ruleRelatedByUpdatedBy The ruleRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeRuleRelatedByUpdatedBy($ruleRelatedByUpdatedBy)
    {
        if ($this->getRulesRelatedByUpdatedBy()->contains($ruleRelatedByUpdatedBy)) {
            $this->collRulesRelatedByUpdatedBy->remove($this->collRulesRelatedByUpdatedBy->search($ruleRelatedByUpdatedBy));
            if (null === $this->rulesRelatedByUpdatedByScheduledForDeletion) {
                $this->rulesRelatedByUpdatedByScheduledForDeletion = clone $this->collRulesRelatedByUpdatedBy;
                $this->rulesRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->rulesRelatedByUpdatedByScheduledForDeletion[]= $ruleRelatedByUpdatedBy;
            $ruleRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related RulesRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|Rule[] List of Rule objects
     */
    public function getRulesRelatedByUpdatedByJoinTypeRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RuleQuery::create(null, $criteria);
        $query->joinWith('TypeRule', $join_behavior);

        return $this->getRulesRelatedByUpdatedBy($query, $con);
    }

    /**
     * Clears out the collTemplatesRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addTemplatesRelatedByCreatedBy()
     */
    public function clearTemplatesRelatedByCreatedBy()
    {
        $this->collTemplatesRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collTemplatesRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplatesRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplatesRelatedByCreatedBy($v = true)
    {
        $this->collTemplatesRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collTemplatesRelatedByCreatedBy collection.
     *
     * By default this just sets the collTemplatesRelatedByCreatedBy collection to an empty array (like clearcollTemplatesRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplatesRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collTemplatesRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collTemplatesRelatedByCreatedBy = new PropelObjectCollection();
        $this->collTemplatesRelatedByCreatedBy->setModel('Template');
    }

    /**
     * Gets an array of Template objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Template[] List of Template objects
     * @throws PropelException
     */
    public function getTemplatesRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collTemplatesRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplatesRelatedByCreatedBy) {
                // return empty collection
                $this->initTemplatesRelatedByCreatedBy();
            } else {
                $collTemplatesRelatedByCreatedBy = TemplateQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplatesRelatedByCreatedByPartial && count($collTemplatesRelatedByCreatedBy)) {
                      $this->initTemplatesRelatedByCreatedBy(false);

                      foreach($collTemplatesRelatedByCreatedBy as $obj) {
                        if (false == $this->collTemplatesRelatedByCreatedBy->contains($obj)) {
                          $this->collTemplatesRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collTemplatesRelatedByCreatedByPartial = true;
                    }

                    $collTemplatesRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collTemplatesRelatedByCreatedBy;
                }

                if($partial && $this->collTemplatesRelatedByCreatedBy) {
                    foreach($this->collTemplatesRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collTemplatesRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collTemplatesRelatedByCreatedBy = $collTemplatesRelatedByCreatedBy;
                $this->collTemplatesRelatedByCreatedByPartial = false;
            }
        }

        return $this->collTemplatesRelatedByCreatedBy;
    }

    /**
     * Sets a collection of TemplateRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templatesRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setTemplatesRelatedByCreatedBy(PropelCollection $templatesRelatedByCreatedBy, PropelPDO $con = null)
    {
        $templatesRelatedByCreatedByToDelete = $this->getTemplatesRelatedByCreatedBy(new Criteria(), $con)->diff($templatesRelatedByCreatedBy);

        $this->templatesRelatedByCreatedByScheduledForDeletion = unserialize(serialize($templatesRelatedByCreatedByToDelete));

        foreach ($templatesRelatedByCreatedByToDelete as $templateRelatedByCreatedByRemoved) {
            $templateRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collTemplatesRelatedByCreatedBy = null;
        foreach ($templatesRelatedByCreatedBy as $templateRelatedByCreatedBy) {
            $this->addTemplateRelatedByCreatedBy($templateRelatedByCreatedBy);
        }

        $this->collTemplatesRelatedByCreatedBy = $templatesRelatedByCreatedBy;
        $this->collTemplatesRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Template objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Template objects.
     * @throws PropelException
     */
    public function countTemplatesRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collTemplatesRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplatesRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTemplatesRelatedByCreatedBy());
            }
            $query = TemplateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collTemplatesRelatedByCreatedBy);
    }

    /**
     * Method called to associate a Template object to this object
     * through the Template foreign key attribute.
     *
     * @param    Template $l Template
     * @return User The current object (for fluent API support)
     */
    public function addTemplateRelatedByCreatedBy(Template $l)
    {
        if ($this->collTemplatesRelatedByCreatedBy === null) {
            $this->initTemplatesRelatedByCreatedBy();
            $this->collTemplatesRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collTemplatesRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplateRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	TemplateRelatedByCreatedBy $templateRelatedByCreatedBy The templateRelatedByCreatedBy object to add.
     */
    protected function doAddTemplateRelatedByCreatedBy($templateRelatedByCreatedBy)
    {
        $this->collTemplatesRelatedByCreatedBy[]= $templateRelatedByCreatedBy;
        $templateRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	TemplateRelatedByCreatedBy $templateRelatedByCreatedBy The templateRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeTemplateRelatedByCreatedBy($templateRelatedByCreatedBy)
    {
        if ($this->getTemplatesRelatedByCreatedBy()->contains($templateRelatedByCreatedBy)) {
            $this->collTemplatesRelatedByCreatedBy->remove($this->collTemplatesRelatedByCreatedBy->search($templateRelatedByCreatedBy));
            if (null === $this->templatesRelatedByCreatedByScheduledForDeletion) {
                $this->templatesRelatedByCreatedByScheduledForDeletion = clone $this->collTemplatesRelatedByCreatedBy;
                $this->templatesRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->templatesRelatedByCreatedByScheduledForDeletion[]= $templateRelatedByCreatedBy;
            $templateRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collTemplatesRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addTemplatesRelatedByUpdatedBy()
     */
    public function clearTemplatesRelatedByUpdatedBy()
    {
        $this->collTemplatesRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collTemplatesRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collTemplatesRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialTemplatesRelatedByUpdatedBy($v = true)
    {
        $this->collTemplatesRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collTemplatesRelatedByUpdatedBy collection.
     *
     * By default this just sets the collTemplatesRelatedByUpdatedBy collection to an empty array (like clearcollTemplatesRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTemplatesRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collTemplatesRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collTemplatesRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collTemplatesRelatedByUpdatedBy->setModel('Template');
    }

    /**
     * Gets an array of Template objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|Template[] List of Template objects
     * @throws PropelException
     */
    public function getTemplatesRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collTemplatesRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTemplatesRelatedByUpdatedBy) {
                // return empty collection
                $this->initTemplatesRelatedByUpdatedBy();
            } else {
                $collTemplatesRelatedByUpdatedBy = TemplateQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTemplatesRelatedByUpdatedByPartial && count($collTemplatesRelatedByUpdatedBy)) {
                      $this->initTemplatesRelatedByUpdatedBy(false);

                      foreach($collTemplatesRelatedByUpdatedBy as $obj) {
                        if (false == $this->collTemplatesRelatedByUpdatedBy->contains($obj)) {
                          $this->collTemplatesRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collTemplatesRelatedByUpdatedByPartial = true;
                    }

                    $collTemplatesRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collTemplatesRelatedByUpdatedBy;
                }

                if($partial && $this->collTemplatesRelatedByUpdatedBy) {
                    foreach($this->collTemplatesRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collTemplatesRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collTemplatesRelatedByUpdatedBy = $collTemplatesRelatedByUpdatedBy;
                $this->collTemplatesRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collTemplatesRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of TemplateRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $templatesRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setTemplatesRelatedByUpdatedBy(PropelCollection $templatesRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $templatesRelatedByUpdatedByToDelete = $this->getTemplatesRelatedByUpdatedBy(new Criteria(), $con)->diff($templatesRelatedByUpdatedBy);

        $this->templatesRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($templatesRelatedByUpdatedByToDelete));

        foreach ($templatesRelatedByUpdatedByToDelete as $templateRelatedByUpdatedByRemoved) {
            $templateRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collTemplatesRelatedByUpdatedBy = null;
        foreach ($templatesRelatedByUpdatedBy as $templateRelatedByUpdatedBy) {
            $this->addTemplateRelatedByUpdatedBy($templateRelatedByUpdatedBy);
        }

        $this->collTemplatesRelatedByUpdatedBy = $templatesRelatedByUpdatedBy;
        $this->collTemplatesRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Template objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related Template objects.
     * @throws PropelException
     */
    public function countTemplatesRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTemplatesRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collTemplatesRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTemplatesRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTemplatesRelatedByUpdatedBy());
            }
            $query = TemplateQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collTemplatesRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a Template object to this object
     * through the Template foreign key attribute.
     *
     * @param    Template $l Template
     * @return User The current object (for fluent API support)
     */
    public function addTemplateRelatedByUpdatedBy(Template $l)
    {
        if ($this->collTemplatesRelatedByUpdatedBy === null) {
            $this->initTemplatesRelatedByUpdatedBy();
            $this->collTemplatesRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collTemplatesRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTemplateRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	TemplateRelatedByUpdatedBy $templateRelatedByUpdatedBy The templateRelatedByUpdatedBy object to add.
     */
    protected function doAddTemplateRelatedByUpdatedBy($templateRelatedByUpdatedBy)
    {
        $this->collTemplatesRelatedByUpdatedBy[]= $templateRelatedByUpdatedBy;
        $templateRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	TemplateRelatedByUpdatedBy $templateRelatedByUpdatedBy The templateRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeTemplateRelatedByUpdatedBy($templateRelatedByUpdatedBy)
    {
        if ($this->getTemplatesRelatedByUpdatedBy()->contains($templateRelatedByUpdatedBy)) {
            $this->collTemplatesRelatedByUpdatedBy->remove($this->collTemplatesRelatedByUpdatedBy->search($templateRelatedByUpdatedBy));
            if (null === $this->templatesRelatedByUpdatedByScheduledForDeletion) {
                $this->templatesRelatedByUpdatedByScheduledForDeletion = clone $this->collTemplatesRelatedByUpdatedBy;
                $this->templatesRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->templatesRelatedByUpdatedByScheduledForDeletion[]= $templateRelatedByUpdatedBy;
            $templateRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collTypeRulesRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addTypeRulesRelatedByCreatedBy()
     */
    public function clearTypeRulesRelatedByCreatedBy()
    {
        $this->collTypeRulesRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collTypeRulesRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collTypeRulesRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialTypeRulesRelatedByCreatedBy($v = true)
    {
        $this->collTypeRulesRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collTypeRulesRelatedByCreatedBy collection.
     *
     * By default this just sets the collTypeRulesRelatedByCreatedBy collection to an empty array (like clearcollTypeRulesRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTypeRulesRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collTypeRulesRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collTypeRulesRelatedByCreatedBy = new PropelObjectCollection();
        $this->collTypeRulesRelatedByCreatedBy->setModel('TypeRule');
    }

    /**
     * Gets an array of TypeRule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TypeRule[] List of TypeRule objects
     * @throws PropelException
     */
    public function getTypeRulesRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTypeRulesRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collTypeRulesRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTypeRulesRelatedByCreatedBy) {
                // return empty collection
                $this->initTypeRulesRelatedByCreatedBy();
            } else {
                $collTypeRulesRelatedByCreatedBy = TypeRuleQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTypeRulesRelatedByCreatedByPartial && count($collTypeRulesRelatedByCreatedBy)) {
                      $this->initTypeRulesRelatedByCreatedBy(false);

                      foreach($collTypeRulesRelatedByCreatedBy as $obj) {
                        if (false == $this->collTypeRulesRelatedByCreatedBy->contains($obj)) {
                          $this->collTypeRulesRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collTypeRulesRelatedByCreatedByPartial = true;
                    }

                    $collTypeRulesRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collTypeRulesRelatedByCreatedBy;
                }

                if($partial && $this->collTypeRulesRelatedByCreatedBy) {
                    foreach($this->collTypeRulesRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collTypeRulesRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collTypeRulesRelatedByCreatedBy = $collTypeRulesRelatedByCreatedBy;
                $this->collTypeRulesRelatedByCreatedByPartial = false;
            }
        }

        return $this->collTypeRulesRelatedByCreatedBy;
    }

    /**
     * Sets a collection of TypeRuleRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $typeRulesRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setTypeRulesRelatedByCreatedBy(PropelCollection $typeRulesRelatedByCreatedBy, PropelPDO $con = null)
    {
        $typeRulesRelatedByCreatedByToDelete = $this->getTypeRulesRelatedByCreatedBy(new Criteria(), $con)->diff($typeRulesRelatedByCreatedBy);

        $this->typeRulesRelatedByCreatedByScheduledForDeletion = unserialize(serialize($typeRulesRelatedByCreatedByToDelete));

        foreach ($typeRulesRelatedByCreatedByToDelete as $typeRuleRelatedByCreatedByRemoved) {
            $typeRuleRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collTypeRulesRelatedByCreatedBy = null;
        foreach ($typeRulesRelatedByCreatedBy as $typeRuleRelatedByCreatedBy) {
            $this->addTypeRuleRelatedByCreatedBy($typeRuleRelatedByCreatedBy);
        }

        $this->collTypeRulesRelatedByCreatedBy = $typeRulesRelatedByCreatedBy;
        $this->collTypeRulesRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TypeRule objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TypeRule objects.
     * @throws PropelException
     */
    public function countTypeRulesRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTypeRulesRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collTypeRulesRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTypeRulesRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTypeRulesRelatedByCreatedBy());
            }
            $query = TypeRuleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collTypeRulesRelatedByCreatedBy);
    }

    /**
     * Method called to associate a TypeRule object to this object
     * through the TypeRule foreign key attribute.
     *
     * @param    TypeRule $l TypeRule
     * @return User The current object (for fluent API support)
     */
    public function addTypeRuleRelatedByCreatedBy(TypeRule $l)
    {
        if ($this->collTypeRulesRelatedByCreatedBy === null) {
            $this->initTypeRulesRelatedByCreatedBy();
            $this->collTypeRulesRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collTypeRulesRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTypeRuleRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	TypeRuleRelatedByCreatedBy $typeRuleRelatedByCreatedBy The typeRuleRelatedByCreatedBy object to add.
     */
    protected function doAddTypeRuleRelatedByCreatedBy($typeRuleRelatedByCreatedBy)
    {
        $this->collTypeRulesRelatedByCreatedBy[]= $typeRuleRelatedByCreatedBy;
        $typeRuleRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	TypeRuleRelatedByCreatedBy $typeRuleRelatedByCreatedBy The typeRuleRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeTypeRuleRelatedByCreatedBy($typeRuleRelatedByCreatedBy)
    {
        if ($this->getTypeRulesRelatedByCreatedBy()->contains($typeRuleRelatedByCreatedBy)) {
            $this->collTypeRulesRelatedByCreatedBy->remove($this->collTypeRulesRelatedByCreatedBy->search($typeRuleRelatedByCreatedBy));
            if (null === $this->typeRulesRelatedByCreatedByScheduledForDeletion) {
                $this->typeRulesRelatedByCreatedByScheduledForDeletion = clone $this->collTypeRulesRelatedByCreatedBy;
                $this->typeRulesRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->typeRulesRelatedByCreatedByScheduledForDeletion[]= $typeRuleRelatedByCreatedBy;
            $typeRuleRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collTypeRulesRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addTypeRulesRelatedByUpdatedBy()
     */
    public function clearTypeRulesRelatedByUpdatedBy()
    {
        $this->collTypeRulesRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collTypeRulesRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collTypeRulesRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialTypeRulesRelatedByUpdatedBy($v = true)
    {
        $this->collTypeRulesRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collTypeRulesRelatedByUpdatedBy collection.
     *
     * By default this just sets the collTypeRulesRelatedByUpdatedBy collection to an empty array (like clearcollTypeRulesRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initTypeRulesRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collTypeRulesRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collTypeRulesRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collTypeRulesRelatedByUpdatedBy->setModel('TypeRule');
    }

    /**
     * Gets an array of TypeRule objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|TypeRule[] List of TypeRule objects
     * @throws PropelException
     */
    public function getTypeRulesRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collTypeRulesRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collTypeRulesRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collTypeRulesRelatedByUpdatedBy) {
                // return empty collection
                $this->initTypeRulesRelatedByUpdatedBy();
            } else {
                $collTypeRulesRelatedByUpdatedBy = TypeRuleQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collTypeRulesRelatedByUpdatedByPartial && count($collTypeRulesRelatedByUpdatedBy)) {
                      $this->initTypeRulesRelatedByUpdatedBy(false);

                      foreach($collTypeRulesRelatedByUpdatedBy as $obj) {
                        if (false == $this->collTypeRulesRelatedByUpdatedBy->contains($obj)) {
                          $this->collTypeRulesRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collTypeRulesRelatedByUpdatedByPartial = true;
                    }

                    $collTypeRulesRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collTypeRulesRelatedByUpdatedBy;
                }

                if($partial && $this->collTypeRulesRelatedByUpdatedBy) {
                    foreach($this->collTypeRulesRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collTypeRulesRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collTypeRulesRelatedByUpdatedBy = $collTypeRulesRelatedByUpdatedBy;
                $this->collTypeRulesRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collTypeRulesRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of TypeRuleRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $typeRulesRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setTypeRulesRelatedByUpdatedBy(PropelCollection $typeRulesRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $typeRulesRelatedByUpdatedByToDelete = $this->getTypeRulesRelatedByUpdatedBy(new Criteria(), $con)->diff($typeRulesRelatedByUpdatedBy);

        $this->typeRulesRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($typeRulesRelatedByUpdatedByToDelete));

        foreach ($typeRulesRelatedByUpdatedByToDelete as $typeRuleRelatedByUpdatedByRemoved) {
            $typeRuleRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collTypeRulesRelatedByUpdatedBy = null;
        foreach ($typeRulesRelatedByUpdatedBy as $typeRuleRelatedByUpdatedBy) {
            $this->addTypeRuleRelatedByUpdatedBy($typeRuleRelatedByUpdatedBy);
        }

        $this->collTypeRulesRelatedByUpdatedBy = $typeRulesRelatedByUpdatedBy;
        $this->collTypeRulesRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related TypeRule objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related TypeRule objects.
     * @throws PropelException
     */
    public function countTypeRulesRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collTypeRulesRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collTypeRulesRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collTypeRulesRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getTypeRulesRelatedByUpdatedBy());
            }
            $query = TypeRuleQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collTypeRulesRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a TypeRule object to this object
     * through the TypeRule foreign key attribute.
     *
     * @param    TypeRule $l TypeRule
     * @return User The current object (for fluent API support)
     */
    public function addTypeRuleRelatedByUpdatedBy(TypeRule $l)
    {
        if ($this->collTypeRulesRelatedByUpdatedBy === null) {
            $this->initTypeRulesRelatedByUpdatedBy();
            $this->collTypeRulesRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collTypeRulesRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddTypeRuleRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	TypeRuleRelatedByUpdatedBy $typeRuleRelatedByUpdatedBy The typeRuleRelatedByUpdatedBy object to add.
     */
    protected function doAddTypeRuleRelatedByUpdatedBy($typeRuleRelatedByUpdatedBy)
    {
        $this->collTypeRulesRelatedByUpdatedBy[]= $typeRuleRelatedByUpdatedBy;
        $typeRuleRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	TypeRuleRelatedByUpdatedBy $typeRuleRelatedByUpdatedBy The typeRuleRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeTypeRuleRelatedByUpdatedBy($typeRuleRelatedByUpdatedBy)
    {
        if ($this->getTypeRulesRelatedByUpdatedBy()->contains($typeRuleRelatedByUpdatedBy)) {
            $this->collTypeRulesRelatedByUpdatedBy->remove($this->collTypeRulesRelatedByUpdatedBy->search($typeRuleRelatedByUpdatedBy));
            if (null === $this->typeRulesRelatedByUpdatedByScheduledForDeletion) {
                $this->typeRulesRelatedByUpdatedByScheduledForDeletion = clone $this->collTypeRulesRelatedByUpdatedBy;
                $this->typeRulesRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->typeRulesRelatedByUpdatedByScheduledForDeletion[]= $typeRuleRelatedByUpdatedBy;
            $typeRuleRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collUsersRelatedById0 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUsersRelatedById0()
     */
    public function clearUsersRelatedById0()
    {
        $this->collUsersRelatedById0 = null; // important to set this to null since that means it is uninitialized
        $this->collUsersRelatedById0Partial = null;

        return $this;
    }

    /**
     * reset is the collUsersRelatedById0 collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsersRelatedById0($v = true)
    {
        $this->collUsersRelatedById0Partial = $v;
    }

    /**
     * Initializes the collUsersRelatedById0 collection.
     *
     * By default this just sets the collUsersRelatedById0 collection to an empty array (like clearcollUsersRelatedById0());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsersRelatedById0($overrideExisting = true)
    {
        if (null !== $this->collUsersRelatedById0 && !$overrideExisting) {
            return;
        }
        $this->collUsersRelatedById0 = new PropelObjectCollection();
        $this->collUsersRelatedById0->setModel('User');
    }

    /**
     * Gets an array of User objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|User[] List of User objects
     * @throws PropelException
     */
    public function getUsersRelatedById0($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedById0Partial && !$this->isNew();
        if (null === $this->collUsersRelatedById0 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById0) {
                // return empty collection
                $this->initUsersRelatedById0();
            } else {
                $collUsersRelatedById0 = UserQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsersRelatedById0Partial && count($collUsersRelatedById0)) {
                      $this->initUsersRelatedById0(false);

                      foreach($collUsersRelatedById0 as $obj) {
                        if (false == $this->collUsersRelatedById0->contains($obj)) {
                          $this->collUsersRelatedById0->append($obj);
                        }
                      }

                      $this->collUsersRelatedById0Partial = true;
                    }

                    $collUsersRelatedById0->getInternalIterator()->rewind();
                    return $collUsersRelatedById0;
                }

                if($partial && $this->collUsersRelatedById0) {
                    foreach($this->collUsersRelatedById0 as $obj) {
                        if($obj->isNew()) {
                            $collUsersRelatedById0[] = $obj;
                        }
                    }
                }

                $this->collUsersRelatedById0 = $collUsersRelatedById0;
                $this->collUsersRelatedById0Partial = false;
            }
        }

        return $this->collUsersRelatedById0;
    }

    /**
     * Sets a collection of UserRelatedById0 objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usersRelatedById0 A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUsersRelatedById0(PropelCollection $usersRelatedById0, PropelPDO $con = null)
    {
        $usersRelatedById0ToDelete = $this->getUsersRelatedById0(new Criteria(), $con)->diff($usersRelatedById0);

        $this->usersRelatedById0ScheduledForDeletion = unserialize(serialize($usersRelatedById0ToDelete));

        foreach ($usersRelatedById0ToDelete as $userRelatedById0Removed) {
            $userRelatedById0Removed->setUserRelatedByCreatedBy(null);
        }

        $this->collUsersRelatedById0 = null;
        foreach ($usersRelatedById0 as $userRelatedById0) {
            $this->addUserRelatedById0($userRelatedById0);
        }

        $this->collUsersRelatedById0 = $usersRelatedById0;
        $this->collUsersRelatedById0Partial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsersRelatedById0(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedById0Partial && !$this->isNew();
        if (null === $this->collUsersRelatedById0 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById0) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getUsersRelatedById0());
            }
            $query = UserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collUsersRelatedById0);
    }

    /**
     * Method called to associate a User object to this object
     * through the User foreign key attribute.
     *
     * @param    User $l User
     * @return User The current object (for fluent API support)
     */
    public function addUserRelatedById0(User $l)
    {
        if ($this->collUsersRelatedById0 === null) {
            $this->initUsersRelatedById0();
            $this->collUsersRelatedById0Partial = true;
        }
        if (!in_array($l, $this->collUsersRelatedById0->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUserRelatedById0($l);
        }

        return $this;
    }

    /**
     * @param	UserRelatedById0 $userRelatedById0 The userRelatedById0 object to add.
     */
    protected function doAddUserRelatedById0($userRelatedById0)
    {
        $this->collUsersRelatedById0[]= $userRelatedById0;
        $userRelatedById0->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	UserRelatedById0 $userRelatedById0 The userRelatedById0 object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUserRelatedById0($userRelatedById0)
    {
        if ($this->getUsersRelatedById0()->contains($userRelatedById0)) {
            $this->collUsersRelatedById0->remove($this->collUsersRelatedById0->search($userRelatedById0));
            if (null === $this->usersRelatedById0ScheduledForDeletion) {
                $this->usersRelatedById0ScheduledForDeletion = clone $this->collUsersRelatedById0;
                $this->usersRelatedById0ScheduledForDeletion->clear();
            }
            $this->usersRelatedById0ScheduledForDeletion[]= $userRelatedById0;
            $userRelatedById0->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collUsersRelatedById1 collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUsersRelatedById1()
     */
    public function clearUsersRelatedById1()
    {
        $this->collUsersRelatedById1 = null; // important to set this to null since that means it is uninitialized
        $this->collUsersRelatedById1Partial = null;

        return $this;
    }

    /**
     * reset is the collUsersRelatedById1 collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsersRelatedById1($v = true)
    {
        $this->collUsersRelatedById1Partial = $v;
    }

    /**
     * Initializes the collUsersRelatedById1 collection.
     *
     * By default this just sets the collUsersRelatedById1 collection to an empty array (like clearcollUsersRelatedById1());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsersRelatedById1($overrideExisting = true)
    {
        if (null !== $this->collUsersRelatedById1 && !$overrideExisting) {
            return;
        }
        $this->collUsersRelatedById1 = new PropelObjectCollection();
        $this->collUsersRelatedById1->setModel('User');
    }

    /**
     * Gets an array of User objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|User[] List of User objects
     * @throws PropelException
     */
    public function getUsersRelatedById1($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedById1Partial && !$this->isNew();
        if (null === $this->collUsersRelatedById1 || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById1) {
                // return empty collection
                $this->initUsersRelatedById1();
            } else {
                $collUsersRelatedById1 = UserQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsersRelatedById1Partial && count($collUsersRelatedById1)) {
                      $this->initUsersRelatedById1(false);

                      foreach($collUsersRelatedById1 as $obj) {
                        if (false == $this->collUsersRelatedById1->contains($obj)) {
                          $this->collUsersRelatedById1->append($obj);
                        }
                      }

                      $this->collUsersRelatedById1Partial = true;
                    }

                    $collUsersRelatedById1->getInternalIterator()->rewind();
                    return $collUsersRelatedById1;
                }

                if($partial && $this->collUsersRelatedById1) {
                    foreach($this->collUsersRelatedById1 as $obj) {
                        if($obj->isNew()) {
                            $collUsersRelatedById1[] = $obj;
                        }
                    }
                }

                $this->collUsersRelatedById1 = $collUsersRelatedById1;
                $this->collUsersRelatedById1Partial = false;
            }
        }

        return $this->collUsersRelatedById1;
    }

    /**
     * Sets a collection of UserRelatedById1 objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usersRelatedById1 A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUsersRelatedById1(PropelCollection $usersRelatedById1, PropelPDO $con = null)
    {
        $usersRelatedById1ToDelete = $this->getUsersRelatedById1(new Criteria(), $con)->diff($usersRelatedById1);

        $this->usersRelatedById1ScheduledForDeletion = unserialize(serialize($usersRelatedById1ToDelete));

        foreach ($usersRelatedById1ToDelete as $userRelatedById1Removed) {
            $userRelatedById1Removed->setUserRelatedByUpdatedBy(null);
        }

        $this->collUsersRelatedById1 = null;
        foreach ($usersRelatedById1 as $userRelatedById1) {
            $this->addUserRelatedById1($userRelatedById1);
        }

        $this->collUsersRelatedById1 = $usersRelatedById1;
        $this->collUsersRelatedById1Partial = false;

        return $this;
    }

    /**
     * Returns the number of related User objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related User objects.
     * @throws PropelException
     */
    public function countUsersRelatedById1(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsersRelatedById1Partial && !$this->isNew();
        if (null === $this->collUsersRelatedById1 || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsersRelatedById1) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getUsersRelatedById1());
            }
            $query = UserQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collUsersRelatedById1);
    }

    /**
     * Method called to associate a User object to this object
     * through the User foreign key attribute.
     *
     * @param    User $l User
     * @return User The current object (for fluent API support)
     */
    public function addUserRelatedById1(User $l)
    {
        if ($this->collUsersRelatedById1 === null) {
            $this->initUsersRelatedById1();
            $this->collUsersRelatedById1Partial = true;
        }
        if (!in_array($l, $this->collUsersRelatedById1->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUserRelatedById1($l);
        }

        return $this;
    }

    /**
     * @param	UserRelatedById1 $userRelatedById1 The userRelatedById1 object to add.
     */
    protected function doAddUserRelatedById1($userRelatedById1)
    {
        $this->collUsersRelatedById1[]= $userRelatedById1;
        $userRelatedById1->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	UserRelatedById1 $userRelatedById1 The userRelatedById1 object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUserRelatedById1($userRelatedById1)
    {
        if ($this->getUsersRelatedById1()->contains($userRelatedById1)) {
            $this->collUsersRelatedById1->remove($this->collUsersRelatedById1->search($userRelatedById1));
            if (null === $this->usersRelatedById1ScheduledForDeletion) {
                $this->usersRelatedById1ScheduledForDeletion = clone $this->collUsersRelatedById1;
                $this->usersRelatedById1ScheduledForDeletion->clear();
            }
            $this->usersRelatedById1ScheduledForDeletion[]= $userRelatedById1;
            $userRelatedById1->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }

    /**
     * Clears out the collUsrCresRelatedByUsrId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUsrCresRelatedByUsrId()
     */
    public function clearUsrCresRelatedByUsrId()
    {
        $this->collUsrCresRelatedByUsrId = null; // important to set this to null since that means it is uninitialized
        $this->collUsrCresRelatedByUsrIdPartial = null;

        return $this;
    }

    /**
     * reset is the collUsrCresRelatedByUsrId collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsrCresRelatedByUsrId($v = true)
    {
        $this->collUsrCresRelatedByUsrIdPartial = $v;
    }

    /**
     * Initializes the collUsrCresRelatedByUsrId collection.
     *
     * By default this just sets the collUsrCresRelatedByUsrId collection to an empty array (like clearcollUsrCresRelatedByUsrId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsrCresRelatedByUsrId($overrideExisting = true)
    {
        if (null !== $this->collUsrCresRelatedByUsrId && !$overrideExisting) {
            return;
        }
        $this->collUsrCresRelatedByUsrId = new PropelObjectCollection();
        $this->collUsrCresRelatedByUsrId->setModel('UsrCre');
    }

    /**
     * Gets an array of UsrCre objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UsrCre[] List of UsrCre objects
     * @throws PropelException
     */
    public function getUsrCresRelatedByUsrId($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsrCresRelatedByUsrIdPartial && !$this->isNew();
        if (null === $this->collUsrCresRelatedByUsrId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsrCresRelatedByUsrId) {
                // return empty collection
                $this->initUsrCresRelatedByUsrId();
            } else {
                $collUsrCresRelatedByUsrId = UsrCreQuery::create(null, $criteria)
                    ->filterByUserRelatedByUsrId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsrCresRelatedByUsrIdPartial && count($collUsrCresRelatedByUsrId)) {
                      $this->initUsrCresRelatedByUsrId(false);

                      foreach($collUsrCresRelatedByUsrId as $obj) {
                        if (false == $this->collUsrCresRelatedByUsrId->contains($obj)) {
                          $this->collUsrCresRelatedByUsrId->append($obj);
                        }
                      }

                      $this->collUsrCresRelatedByUsrIdPartial = true;
                    }

                    $collUsrCresRelatedByUsrId->getInternalIterator()->rewind();
                    return $collUsrCresRelatedByUsrId;
                }

                if($partial && $this->collUsrCresRelatedByUsrId) {
                    foreach($this->collUsrCresRelatedByUsrId as $obj) {
                        if($obj->isNew()) {
                            $collUsrCresRelatedByUsrId[] = $obj;
                        }
                    }
                }

                $this->collUsrCresRelatedByUsrId = $collUsrCresRelatedByUsrId;
                $this->collUsrCresRelatedByUsrIdPartial = false;
            }
        }

        return $this->collUsrCresRelatedByUsrId;
    }

    /**
     * Sets a collection of UsrCreRelatedByUsrId objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usrCresRelatedByUsrId A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUsrCresRelatedByUsrId(PropelCollection $usrCresRelatedByUsrId, PropelPDO $con = null)
    {
        $usrCresRelatedByUsrIdToDelete = $this->getUsrCresRelatedByUsrId(new Criteria(), $con)->diff($usrCresRelatedByUsrId);

        $this->usrCresRelatedByUsrIdScheduledForDeletion = unserialize(serialize($usrCresRelatedByUsrIdToDelete));

        foreach ($usrCresRelatedByUsrIdToDelete as $usrCreRelatedByUsrIdRemoved) {
            $usrCreRelatedByUsrIdRemoved->setUserRelatedByUsrId(null);
        }

        $this->collUsrCresRelatedByUsrId = null;
        foreach ($usrCresRelatedByUsrId as $usrCreRelatedByUsrId) {
            $this->addUsrCreRelatedByUsrId($usrCreRelatedByUsrId);
        }

        $this->collUsrCresRelatedByUsrId = $usrCresRelatedByUsrId;
        $this->collUsrCresRelatedByUsrIdPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UsrCre objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UsrCre objects.
     * @throws PropelException
     */
    public function countUsrCresRelatedByUsrId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsrCresRelatedByUsrIdPartial && !$this->isNew();
        if (null === $this->collUsrCresRelatedByUsrId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsrCresRelatedByUsrId) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getUsrCresRelatedByUsrId());
            }
            $query = UsrCreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUsrId($this)
                ->count($con);
        }

        return count($this->collUsrCresRelatedByUsrId);
    }

    /**
     * Method called to associate a UsrCre object to this object
     * through the UsrCre foreign key attribute.
     *
     * @param    UsrCre $l UsrCre
     * @return User The current object (for fluent API support)
     */
    public function addUsrCreRelatedByUsrId(UsrCre $l)
    {
        if ($this->collUsrCresRelatedByUsrId === null) {
            $this->initUsrCresRelatedByUsrId();
            $this->collUsrCresRelatedByUsrIdPartial = true;
        }
        if (!in_array($l, $this->collUsrCresRelatedByUsrId->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUsrCreRelatedByUsrId($l);
        }

        return $this;
    }

    /**
     * @param	UsrCreRelatedByUsrId $usrCreRelatedByUsrId The usrCreRelatedByUsrId object to add.
     */
    protected function doAddUsrCreRelatedByUsrId($usrCreRelatedByUsrId)
    {
        $this->collUsrCresRelatedByUsrId[]= $usrCreRelatedByUsrId;
        $usrCreRelatedByUsrId->setUserRelatedByUsrId($this);
    }

    /**
     * @param	UsrCreRelatedByUsrId $usrCreRelatedByUsrId The usrCreRelatedByUsrId object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUsrCreRelatedByUsrId($usrCreRelatedByUsrId)
    {
        if ($this->getUsrCresRelatedByUsrId()->contains($usrCreRelatedByUsrId)) {
            $this->collUsrCresRelatedByUsrId->remove($this->collUsrCresRelatedByUsrId->search($usrCreRelatedByUsrId));
            if (null === $this->usrCresRelatedByUsrIdScheduledForDeletion) {
                $this->usrCresRelatedByUsrIdScheduledForDeletion = clone $this->collUsrCresRelatedByUsrId;
                $this->usrCresRelatedByUsrIdScheduledForDeletion->clear();
            }
            $this->usrCresRelatedByUsrIdScheduledForDeletion[]= clone $usrCreRelatedByUsrId;
            $usrCreRelatedByUsrId->setUserRelatedByUsrId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UsrCresRelatedByUsrId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UsrCre[] List of UsrCre objects
     */
    public function getUsrCresRelatedByUsrIdJoinCredential($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UsrCreQuery::create(null, $criteria);
        $query->joinWith('Credential', $join_behavior);

        return $this->getUsrCresRelatedByUsrId($query, $con);
    }

    /**
     * Clears out the collUsrCresRelatedByCreatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUsrCresRelatedByCreatedBy()
     */
    public function clearUsrCresRelatedByCreatedBy()
    {
        $this->collUsrCresRelatedByCreatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collUsrCresRelatedByCreatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collUsrCresRelatedByCreatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsrCresRelatedByCreatedBy($v = true)
    {
        $this->collUsrCresRelatedByCreatedByPartial = $v;
    }

    /**
     * Initializes the collUsrCresRelatedByCreatedBy collection.
     *
     * By default this just sets the collUsrCresRelatedByCreatedBy collection to an empty array (like clearcollUsrCresRelatedByCreatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsrCresRelatedByCreatedBy($overrideExisting = true)
    {
        if (null !== $this->collUsrCresRelatedByCreatedBy && !$overrideExisting) {
            return;
        }
        $this->collUsrCresRelatedByCreatedBy = new PropelObjectCollection();
        $this->collUsrCresRelatedByCreatedBy->setModel('UsrCre');
    }

    /**
     * Gets an array of UsrCre objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UsrCre[] List of UsrCre objects
     * @throws PropelException
     */
    public function getUsrCresRelatedByCreatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsrCresRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collUsrCresRelatedByCreatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsrCresRelatedByCreatedBy) {
                // return empty collection
                $this->initUsrCresRelatedByCreatedBy();
            } else {
                $collUsrCresRelatedByCreatedBy = UsrCreQuery::create(null, $criteria)
                    ->filterByUserRelatedByCreatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsrCresRelatedByCreatedByPartial && count($collUsrCresRelatedByCreatedBy)) {
                      $this->initUsrCresRelatedByCreatedBy(false);

                      foreach($collUsrCresRelatedByCreatedBy as $obj) {
                        if (false == $this->collUsrCresRelatedByCreatedBy->contains($obj)) {
                          $this->collUsrCresRelatedByCreatedBy->append($obj);
                        }
                      }

                      $this->collUsrCresRelatedByCreatedByPartial = true;
                    }

                    $collUsrCresRelatedByCreatedBy->getInternalIterator()->rewind();
                    return $collUsrCresRelatedByCreatedBy;
                }

                if($partial && $this->collUsrCresRelatedByCreatedBy) {
                    foreach($this->collUsrCresRelatedByCreatedBy as $obj) {
                        if($obj->isNew()) {
                            $collUsrCresRelatedByCreatedBy[] = $obj;
                        }
                    }
                }

                $this->collUsrCresRelatedByCreatedBy = $collUsrCresRelatedByCreatedBy;
                $this->collUsrCresRelatedByCreatedByPartial = false;
            }
        }

        return $this->collUsrCresRelatedByCreatedBy;
    }

    /**
     * Sets a collection of UsrCreRelatedByCreatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usrCresRelatedByCreatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUsrCresRelatedByCreatedBy(PropelCollection $usrCresRelatedByCreatedBy, PropelPDO $con = null)
    {
        $usrCresRelatedByCreatedByToDelete = $this->getUsrCresRelatedByCreatedBy(new Criteria(), $con)->diff($usrCresRelatedByCreatedBy);

        $this->usrCresRelatedByCreatedByScheduledForDeletion = unserialize(serialize($usrCresRelatedByCreatedByToDelete));

        foreach ($usrCresRelatedByCreatedByToDelete as $usrCreRelatedByCreatedByRemoved) {
            $usrCreRelatedByCreatedByRemoved->setUserRelatedByCreatedBy(null);
        }

        $this->collUsrCresRelatedByCreatedBy = null;
        foreach ($usrCresRelatedByCreatedBy as $usrCreRelatedByCreatedBy) {
            $this->addUsrCreRelatedByCreatedBy($usrCreRelatedByCreatedBy);
        }

        $this->collUsrCresRelatedByCreatedBy = $usrCresRelatedByCreatedBy;
        $this->collUsrCresRelatedByCreatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UsrCre objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UsrCre objects.
     * @throws PropelException
     */
    public function countUsrCresRelatedByCreatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsrCresRelatedByCreatedByPartial && !$this->isNew();
        if (null === $this->collUsrCresRelatedByCreatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsrCresRelatedByCreatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getUsrCresRelatedByCreatedBy());
            }
            $query = UsrCreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByCreatedBy($this)
                ->count($con);
        }

        return count($this->collUsrCresRelatedByCreatedBy);
    }

    /**
     * Method called to associate a UsrCre object to this object
     * through the UsrCre foreign key attribute.
     *
     * @param    UsrCre $l UsrCre
     * @return User The current object (for fluent API support)
     */
    public function addUsrCreRelatedByCreatedBy(UsrCre $l)
    {
        if ($this->collUsrCresRelatedByCreatedBy === null) {
            $this->initUsrCresRelatedByCreatedBy();
            $this->collUsrCresRelatedByCreatedByPartial = true;
        }
        if (!in_array($l, $this->collUsrCresRelatedByCreatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUsrCreRelatedByCreatedBy($l);
        }

        return $this;
    }

    /**
     * @param	UsrCreRelatedByCreatedBy $usrCreRelatedByCreatedBy The usrCreRelatedByCreatedBy object to add.
     */
    protected function doAddUsrCreRelatedByCreatedBy($usrCreRelatedByCreatedBy)
    {
        $this->collUsrCresRelatedByCreatedBy[]= $usrCreRelatedByCreatedBy;
        $usrCreRelatedByCreatedBy->setUserRelatedByCreatedBy($this);
    }

    /**
     * @param	UsrCreRelatedByCreatedBy $usrCreRelatedByCreatedBy The usrCreRelatedByCreatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUsrCreRelatedByCreatedBy($usrCreRelatedByCreatedBy)
    {
        if ($this->getUsrCresRelatedByCreatedBy()->contains($usrCreRelatedByCreatedBy)) {
            $this->collUsrCresRelatedByCreatedBy->remove($this->collUsrCresRelatedByCreatedBy->search($usrCreRelatedByCreatedBy));
            if (null === $this->usrCresRelatedByCreatedByScheduledForDeletion) {
                $this->usrCresRelatedByCreatedByScheduledForDeletion = clone $this->collUsrCresRelatedByCreatedBy;
                $this->usrCresRelatedByCreatedByScheduledForDeletion->clear();
            }
            $this->usrCresRelatedByCreatedByScheduledForDeletion[]= $usrCreRelatedByCreatedBy;
            $usrCreRelatedByCreatedBy->setUserRelatedByCreatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UsrCresRelatedByCreatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UsrCre[] List of UsrCre objects
     */
    public function getUsrCresRelatedByCreatedByJoinCredential($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UsrCreQuery::create(null, $criteria);
        $query->joinWith('Credential', $join_behavior);

        return $this->getUsrCresRelatedByCreatedBy($query, $con);
    }

    /**
     * Clears out the collUsrCresRelatedByUpdatedBy collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return User The current object (for fluent API support)
     * @see        addUsrCresRelatedByUpdatedBy()
     */
    public function clearUsrCresRelatedByUpdatedBy()
    {
        $this->collUsrCresRelatedByUpdatedBy = null; // important to set this to null since that means it is uninitialized
        $this->collUsrCresRelatedByUpdatedByPartial = null;

        return $this;
    }

    /**
     * reset is the collUsrCresRelatedByUpdatedBy collection loaded partially
     *
     * @return void
     */
    public function resetPartialUsrCresRelatedByUpdatedBy($v = true)
    {
        $this->collUsrCresRelatedByUpdatedByPartial = $v;
    }

    /**
     * Initializes the collUsrCresRelatedByUpdatedBy collection.
     *
     * By default this just sets the collUsrCresRelatedByUpdatedBy collection to an empty array (like clearcollUsrCresRelatedByUpdatedBy());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initUsrCresRelatedByUpdatedBy($overrideExisting = true)
    {
        if (null !== $this->collUsrCresRelatedByUpdatedBy && !$overrideExisting) {
            return;
        }
        $this->collUsrCresRelatedByUpdatedBy = new PropelObjectCollection();
        $this->collUsrCresRelatedByUpdatedBy->setModel('UsrCre');
    }

    /**
     * Gets an array of UsrCre objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this User is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|UsrCre[] List of UsrCre objects
     * @throws PropelException
     */
    public function getUsrCresRelatedByUpdatedBy($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collUsrCresRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collUsrCresRelatedByUpdatedBy || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collUsrCresRelatedByUpdatedBy) {
                // return empty collection
                $this->initUsrCresRelatedByUpdatedBy();
            } else {
                $collUsrCresRelatedByUpdatedBy = UsrCreQuery::create(null, $criteria)
                    ->filterByUserRelatedByUpdatedBy($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collUsrCresRelatedByUpdatedByPartial && count($collUsrCresRelatedByUpdatedBy)) {
                      $this->initUsrCresRelatedByUpdatedBy(false);

                      foreach($collUsrCresRelatedByUpdatedBy as $obj) {
                        if (false == $this->collUsrCresRelatedByUpdatedBy->contains($obj)) {
                          $this->collUsrCresRelatedByUpdatedBy->append($obj);
                        }
                      }

                      $this->collUsrCresRelatedByUpdatedByPartial = true;
                    }

                    $collUsrCresRelatedByUpdatedBy->getInternalIterator()->rewind();
                    return $collUsrCresRelatedByUpdatedBy;
                }

                if($partial && $this->collUsrCresRelatedByUpdatedBy) {
                    foreach($this->collUsrCresRelatedByUpdatedBy as $obj) {
                        if($obj->isNew()) {
                            $collUsrCresRelatedByUpdatedBy[] = $obj;
                        }
                    }
                }

                $this->collUsrCresRelatedByUpdatedBy = $collUsrCresRelatedByUpdatedBy;
                $this->collUsrCresRelatedByUpdatedByPartial = false;
            }
        }

        return $this->collUsrCresRelatedByUpdatedBy;
    }

    /**
     * Sets a collection of UsrCreRelatedByUpdatedBy objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $usrCresRelatedByUpdatedBy A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return User The current object (for fluent API support)
     */
    public function setUsrCresRelatedByUpdatedBy(PropelCollection $usrCresRelatedByUpdatedBy, PropelPDO $con = null)
    {
        $usrCresRelatedByUpdatedByToDelete = $this->getUsrCresRelatedByUpdatedBy(new Criteria(), $con)->diff($usrCresRelatedByUpdatedBy);

        $this->usrCresRelatedByUpdatedByScheduledForDeletion = unserialize(serialize($usrCresRelatedByUpdatedByToDelete));

        foreach ($usrCresRelatedByUpdatedByToDelete as $usrCreRelatedByUpdatedByRemoved) {
            $usrCreRelatedByUpdatedByRemoved->setUserRelatedByUpdatedBy(null);
        }

        $this->collUsrCresRelatedByUpdatedBy = null;
        foreach ($usrCresRelatedByUpdatedBy as $usrCreRelatedByUpdatedBy) {
            $this->addUsrCreRelatedByUpdatedBy($usrCreRelatedByUpdatedBy);
        }

        $this->collUsrCresRelatedByUpdatedBy = $usrCresRelatedByUpdatedBy;
        $this->collUsrCresRelatedByUpdatedByPartial = false;

        return $this;
    }

    /**
     * Returns the number of related UsrCre objects.
     *
     * @param Criteria $criteria
     * @param boolean $distinct
     * @param PropelPDO $con
     * @return int             Count of related UsrCre objects.
     * @throws PropelException
     */
    public function countUsrCresRelatedByUpdatedBy(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collUsrCresRelatedByUpdatedByPartial && !$this->isNew();
        if (null === $this->collUsrCresRelatedByUpdatedBy || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collUsrCresRelatedByUpdatedBy) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getUsrCresRelatedByUpdatedBy());
            }
            $query = UsrCreQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByUserRelatedByUpdatedBy($this)
                ->count($con);
        }

        return count($this->collUsrCresRelatedByUpdatedBy);
    }

    /**
     * Method called to associate a UsrCre object to this object
     * through the UsrCre foreign key attribute.
     *
     * @param    UsrCre $l UsrCre
     * @return User The current object (for fluent API support)
     */
    public function addUsrCreRelatedByUpdatedBy(UsrCre $l)
    {
        if ($this->collUsrCresRelatedByUpdatedBy === null) {
            $this->initUsrCresRelatedByUpdatedBy();
            $this->collUsrCresRelatedByUpdatedByPartial = true;
        }
        if (!in_array($l, $this->collUsrCresRelatedByUpdatedBy->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddUsrCreRelatedByUpdatedBy($l);
        }

        return $this;
    }

    /**
     * @param	UsrCreRelatedByUpdatedBy $usrCreRelatedByUpdatedBy The usrCreRelatedByUpdatedBy object to add.
     */
    protected function doAddUsrCreRelatedByUpdatedBy($usrCreRelatedByUpdatedBy)
    {
        $this->collUsrCresRelatedByUpdatedBy[]= $usrCreRelatedByUpdatedBy;
        $usrCreRelatedByUpdatedBy->setUserRelatedByUpdatedBy($this);
    }

    /**
     * @param	UsrCreRelatedByUpdatedBy $usrCreRelatedByUpdatedBy The usrCreRelatedByUpdatedBy object to remove.
     * @return User The current object (for fluent API support)
     */
    public function removeUsrCreRelatedByUpdatedBy($usrCreRelatedByUpdatedBy)
    {
        if ($this->getUsrCresRelatedByUpdatedBy()->contains($usrCreRelatedByUpdatedBy)) {
            $this->collUsrCresRelatedByUpdatedBy->remove($this->collUsrCresRelatedByUpdatedBy->search($usrCreRelatedByUpdatedBy));
            if (null === $this->usrCresRelatedByUpdatedByScheduledForDeletion) {
                $this->usrCresRelatedByUpdatedByScheduledForDeletion = clone $this->collUsrCresRelatedByUpdatedBy;
                $this->usrCresRelatedByUpdatedByScheduledForDeletion->clear();
            }
            $this->usrCresRelatedByUpdatedByScheduledForDeletion[]= $usrCreRelatedByUpdatedBy;
            $usrCreRelatedByUpdatedBy->setUserRelatedByUpdatedBy(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this User is new, it will return
     * an empty collection; or if this User has previously
     * been saved, it will retrieve related UsrCresRelatedByUpdatedBy from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in User.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|UsrCre[] List of UsrCre objects
     */
    public function getUsrCresRelatedByUpdatedByJoinCredential($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = UsrCreQuery::create(null, $criteria);
        $query->joinWith('Credential', $join_behavior);

        return $this->getUsrCresRelatedByUpdatedBy($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->usr_first_name = null;
        $this->usr_last_name = null;
        $this->usr_login = null;
        $this->usr_password = null;
        $this->usr_cp = null;
        $this->usr_avatar = null;
        $this->created_by = null;
        $this->created_at = null;
        $this->updated_by = null;
        $this->updated_at = null;
        $this->alreadyInSave = false;
        $this->alreadyInValidation = false;
        $this->alreadyInClearAllReferencesDeep = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references to other model objects or collections of model objects.
     *
     * This method is a user-space workaround for PHP's inability to garbage collect
     * objects with circular references (even in PHP 5.3). This is currently necessary
     * when using Propel in certain daemon or large-volumne/high-memory operations.
     *
     * @param boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep && !$this->alreadyInClearAllReferencesDeep) {
            $this->alreadyInClearAllReferencesDeep = true;
            if ($this->collBchRulsRelatedByCreatedBy) {
                foreach ($this->collBchRulsRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBchRulsRelatedByUpdatedBy) {
                foreach ($this->collBchRulsRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBranchsRelatedByCreatedBy) {
                foreach ($this->collBranchsRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collBranchsRelatedByUpdatedBy) {
                foreach ($this->collBranchsRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCredentialsRelatedByCreatedBy) {
                foreach ($this->collCredentialsRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collCredentialsRelatedByUpdatedBy) {
                foreach ($this->collCredentialsRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeafsRelatedByCreatedBy) {
                foreach ($this->collLeafsRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLeafsRelatedByUpdatedBy) {
                foreach ($this->collLeafsRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLefRulsRelatedByCreatedBy) {
                foreach ($this->collLefRulsRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLefRulsRelatedByUpdatedBy) {
                foreach ($this->collLefRulsRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNodeTreesRelatedByCreatedBy) {
                foreach ($this->collNodeTreesRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNodeTreesRelatedByUpdatedBy) {
                foreach ($this->collNodeTreesRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRulOptionsRelatedByCreatedBy) {
                foreach ($this->collRulOptionsRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRulOptionsRelatedByUpdatedBy) {
                foreach ($this->collRulOptionsRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRulesRelatedByCreatedBy) {
                foreach ($this->collRulesRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRulesRelatedByUpdatedBy) {
                foreach ($this->collRulesRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplatesRelatedByCreatedBy) {
                foreach ($this->collTemplatesRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTemplatesRelatedByUpdatedBy) {
                foreach ($this->collTemplatesRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTypeRulesRelatedByCreatedBy) {
                foreach ($this->collTypeRulesRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collTypeRulesRelatedByUpdatedBy) {
                foreach ($this->collTypeRulesRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsersRelatedById0) {
                foreach ($this->collUsersRelatedById0 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsersRelatedById1) {
                foreach ($this->collUsersRelatedById1 as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsrCresRelatedByUsrId) {
                foreach ($this->collUsrCresRelatedByUsrId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsrCresRelatedByCreatedBy) {
                foreach ($this->collUsrCresRelatedByCreatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collUsrCresRelatedByUpdatedBy) {
                foreach ($this->collUsrCresRelatedByUpdatedBy as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aUserRelatedByCreatedBy instanceof Persistent) {
              $this->aUserRelatedByCreatedBy->clearAllReferences($deep);
            }
            if ($this->aUserRelatedByUpdatedBy instanceof Persistent) {
              $this->aUserRelatedByUpdatedBy->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collBchRulsRelatedByCreatedBy instanceof PropelCollection) {
            $this->collBchRulsRelatedByCreatedBy->clearIterator();
        }
        $this->collBchRulsRelatedByCreatedBy = null;
        if ($this->collBchRulsRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collBchRulsRelatedByUpdatedBy->clearIterator();
        }
        $this->collBchRulsRelatedByUpdatedBy = null;
        if ($this->collBranchsRelatedByCreatedBy instanceof PropelCollection) {
            $this->collBranchsRelatedByCreatedBy->clearIterator();
        }
        $this->collBranchsRelatedByCreatedBy = null;
        if ($this->collBranchsRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collBranchsRelatedByUpdatedBy->clearIterator();
        }
        $this->collBranchsRelatedByUpdatedBy = null;
        if ($this->collCredentialsRelatedByCreatedBy instanceof PropelCollection) {
            $this->collCredentialsRelatedByCreatedBy->clearIterator();
        }
        $this->collCredentialsRelatedByCreatedBy = null;
        if ($this->collCredentialsRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collCredentialsRelatedByUpdatedBy->clearIterator();
        }
        $this->collCredentialsRelatedByUpdatedBy = null;
        if ($this->collLeafsRelatedByCreatedBy instanceof PropelCollection) {
            $this->collLeafsRelatedByCreatedBy->clearIterator();
        }
        $this->collLeafsRelatedByCreatedBy = null;
        if ($this->collLeafsRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collLeafsRelatedByUpdatedBy->clearIterator();
        }
        $this->collLeafsRelatedByUpdatedBy = null;
        if ($this->collLefRulsRelatedByCreatedBy instanceof PropelCollection) {
            $this->collLefRulsRelatedByCreatedBy->clearIterator();
        }
        $this->collLefRulsRelatedByCreatedBy = null;
        if ($this->collLefRulsRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collLefRulsRelatedByUpdatedBy->clearIterator();
        }
        $this->collLefRulsRelatedByUpdatedBy = null;
        if ($this->collNodeTreesRelatedByCreatedBy instanceof PropelCollection) {
            $this->collNodeTreesRelatedByCreatedBy->clearIterator();
        }
        $this->collNodeTreesRelatedByCreatedBy = null;
        if ($this->collNodeTreesRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collNodeTreesRelatedByUpdatedBy->clearIterator();
        }
        $this->collNodeTreesRelatedByUpdatedBy = null;
        if ($this->collRulOptionsRelatedByCreatedBy instanceof PropelCollection) {
            $this->collRulOptionsRelatedByCreatedBy->clearIterator();
        }
        $this->collRulOptionsRelatedByCreatedBy = null;
        if ($this->collRulOptionsRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collRulOptionsRelatedByUpdatedBy->clearIterator();
        }
        $this->collRulOptionsRelatedByUpdatedBy = null;
        if ($this->collRulesRelatedByCreatedBy instanceof PropelCollection) {
            $this->collRulesRelatedByCreatedBy->clearIterator();
        }
        $this->collRulesRelatedByCreatedBy = null;
        if ($this->collRulesRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collRulesRelatedByUpdatedBy->clearIterator();
        }
        $this->collRulesRelatedByUpdatedBy = null;
        if ($this->collTemplatesRelatedByCreatedBy instanceof PropelCollection) {
            $this->collTemplatesRelatedByCreatedBy->clearIterator();
        }
        $this->collTemplatesRelatedByCreatedBy = null;
        if ($this->collTemplatesRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collTemplatesRelatedByUpdatedBy->clearIterator();
        }
        $this->collTemplatesRelatedByUpdatedBy = null;
        if ($this->collTypeRulesRelatedByCreatedBy instanceof PropelCollection) {
            $this->collTypeRulesRelatedByCreatedBy->clearIterator();
        }
        $this->collTypeRulesRelatedByCreatedBy = null;
        if ($this->collTypeRulesRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collTypeRulesRelatedByUpdatedBy->clearIterator();
        }
        $this->collTypeRulesRelatedByUpdatedBy = null;
        if ($this->collUsersRelatedById0 instanceof PropelCollection) {
            $this->collUsersRelatedById0->clearIterator();
        }
        $this->collUsersRelatedById0 = null;
        if ($this->collUsersRelatedById1 instanceof PropelCollection) {
            $this->collUsersRelatedById1->clearIterator();
        }
        $this->collUsersRelatedById1 = null;
        if ($this->collUsrCresRelatedByUsrId instanceof PropelCollection) {
            $this->collUsrCresRelatedByUsrId->clearIterator();
        }
        $this->collUsrCresRelatedByUsrId = null;
        if ($this->collUsrCresRelatedByCreatedBy instanceof PropelCollection) {
            $this->collUsrCresRelatedByCreatedBy->clearIterator();
        }
        $this->collUsrCresRelatedByCreatedBy = null;
        if ($this->collUsrCresRelatedByUpdatedBy instanceof PropelCollection) {
            $this->collUsrCresRelatedByUpdatedBy->clearIterator();
        }
        $this->collUsrCresRelatedByUpdatedBy = null;
        $this->aUserRelatedByCreatedBy = null;
        $this->aUserRelatedByUpdatedBy = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(UserPeer::DEFAULT_STRING_FORMAT);
    }

    /**
     * return true is the object is in saving state
     *
     * @return boolean
     */
    public function isAlreadyInSave()
    {
        return $this->alreadyInSave;
    }

}

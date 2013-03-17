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
use Kzf\Model\BranchPeer;
use Kzf\Model\BranchQuery;
use Kzf\Model\NodeTree;
use Kzf\Model\NodeTreeQuery;
use Kzf\Model\Template;
use Kzf\Model\TemplateQuery;
use Kzf\Model\User;
use Kzf\Model\UserQuery;

/**
 * Base class that represents a row from the 'branch' table.
 *
 *
 *
 * @package    propel.generator.model.om
 */
abstract class BaseBranch extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Kzf\\Model\\BranchPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        BranchPeer
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
     * The value for the bch_title field.
     * @var        string
     */
    protected $bch_title;

    /**
     * The value for the bch_active field.
     * @var        boolean
     */
    protected $bch_active;

    /**
     * The value for the bch_published_at field.
     * @var        string
     */
    protected $bch_published_at;

    /**
     * The value for the bch_level field.
     * @var        int
     */
    protected $bch_level;

    /**
     * The value for the bch_url field.
     * @var        string
     */
    protected $bch_url;

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
     * The value for the tpl_id field.
     * @var        int
     */
    protected $tpl_id;

    /**
     * @var        Template
     */
    protected $aTemplate;

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
    protected $collBchRuls;
    protected $collBchRulsPartial;

    /**
     * @var        PropelObjectCollection|NodeTree[] Collection to store aggregation of NodeTree objects.
     */
    protected $collNodeTreesRelatedByBchId;
    protected $collNodeTreesRelatedByBchIdPartial;

    /**
     * @var        PropelObjectCollection|NodeTree[] Collection to store aggregation of NodeTree objects.
     */
    protected $collNodeTreesRelatedByBchParent;
    protected $collNodeTreesRelatedByBchParentPartial;

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
    protected $bchRulsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nodeTreesRelatedByBchIdScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nodeTreesRelatedByBchParentScheduledForDeletion = null;

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
     * Get the [bch_title] column value.
     *
     * @return string
     */
    public function getBchTitle()
    {
        return $this->bch_title;
    }

    /**
     * Get the [bch_active] column value.
     *
     * @return boolean
     */
    public function getBchActive()
    {
        return $this->bch_active;
    }

    /**
     * Get the [optionally formatted] temporal [bch_published_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getBchPublishedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->bch_published_at === null) {
            return null;
        }

        if ($this->bch_published_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->bch_published_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->bch_published_at, true), $x);
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
     * Get the [bch_level] column value.
     *
     * @return int
     */
    public function getBchLevel()
    {
        return $this->bch_level;
    }

    /**
     * Get the [bch_url] column value.
     *
     * @return string
     */
    public function getBchUrl()
    {
        return $this->bch_url;
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
     * Get the [tpl_id] column value.
     *
     * @return int
     */
    public function getTplId()
    {
        return $this->tpl_id;
    }

    /**
     * Set the value of [id] column.
     *
     * @param int $v new value
     * @return Branch The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = BranchPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [bch_title] column.
     *
     * @param string $v new value
     * @return Branch The current object (for fluent API support)
     */
    public function setBchTitle($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->bch_title !== $v) {
            $this->bch_title = $v;
            $this->modifiedColumns[] = BranchPeer::BCH_TITLE;
        }


        return $this;
    } // setBchTitle()

    /**
     * Sets the value of the [bch_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Branch The current object (for fluent API support)
     */
    public function setBchActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->bch_active !== $v) {
            $this->bch_active = $v;
            $this->modifiedColumns[] = BranchPeer::BCH_ACTIVE;
        }


        return $this;
    } // setBchActive()

    /**
     * Sets the value of [bch_published_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Branch The current object (for fluent API support)
     */
    public function setBchPublishedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->bch_published_at !== null || $dt !== null) {
            $currentDateAsString = ($this->bch_published_at !== null && $tmpDt = new DateTime($this->bch_published_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->bch_published_at = $newDateAsString;
                $this->modifiedColumns[] = BranchPeer::BCH_PUBLISHED_AT;
            }
        } // if either are not null


        return $this;
    } // setBchPublishedAt()

    /**
     * Set the value of [bch_level] column.
     *
     * @param int $v new value
     * @return Branch The current object (for fluent API support)
     */
    public function setBchLevel($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->bch_level !== $v) {
            $this->bch_level = $v;
            $this->modifiedColumns[] = BranchPeer::BCH_LEVEL;
        }


        return $this;
    } // setBchLevel()

    /**
     * Set the value of [bch_url] column.
     *
     * @param string $v new value
     * @return Branch The current object (for fluent API support)
     */
    public function setBchUrl($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->bch_url !== $v) {
            $this->bch_url = $v;
            $this->modifiedColumns[] = BranchPeer::BCH_URL;
        }


        return $this;
    } // setBchUrl()

    /**
     * Set the value of [created_by] column.
     *
     * @param int $v new value
     * @return Branch The current object (for fluent API support)
     */
    public function setCreatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->created_by !== $v) {
            $this->created_by = $v;
            $this->modifiedColumns[] = BranchPeer::CREATED_BY;
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
     * @return Branch The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = BranchPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Set the value of [updated_by] column.
     *
     * @param int $v new value
     * @return Branch The current object (for fluent API support)
     */
    public function setUpdatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->updated_by !== $v) {
            $this->updated_by = $v;
            $this->modifiedColumns[] = BranchPeer::UPDATED_BY;
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
     * @return Branch The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = BranchPeer::UPDATED_AT;
            }
        } // if either are not null


        return $this;
    } // setUpdatedAt()

    /**
     * Set the value of [tpl_id] column.
     *
     * @param int $v new value
     * @return Branch The current object (for fluent API support)
     */
    public function setTplId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->tpl_id !== $v) {
            $this->tpl_id = $v;
            $this->modifiedColumns[] = BranchPeer::TPL_ID;
        }

        if ($this->aTemplate !== null && $this->aTemplate->getId() !== $v) {
            $this->aTemplate = null;
        }


        return $this;
    } // setTplId()

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
            $this->bch_title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->bch_active = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->bch_published_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            $this->bch_level = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->bch_url = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
            $this->created_by = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->created_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->updated_by = ($row[$startcol + 8] !== null) ? (int) $row[$startcol + 8] : null;
            $this->updated_at = ($row[$startcol + 9] !== null) ? (string) $row[$startcol + 9] : null;
            $this->tpl_id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 11; // 11 = BranchPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Branch object", $e);
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
        if ($this->aTemplate !== null && $this->tpl_id !== $this->aTemplate->getId()) {
            $this->aTemplate = null;
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
            $con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = BranchPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTemplate = null;
            $this->aUserRelatedByCreatedBy = null;
            $this->aUserRelatedByUpdatedBy = null;
            $this->collBchRuls = null;

            $this->collNodeTreesRelatedByBchId = null;

            $this->collNodeTreesRelatedByBchParent = null;

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
            $con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = BranchQuery::create()
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
            $con = Propel::getConnection(BranchPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                BranchPeer::addInstanceToPool($this);
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

            if ($this->aTemplate !== null) {
                if ($this->aTemplate->isModified() || $this->aTemplate->isNew()) {
                    $affectedRows += $this->aTemplate->save($con);
                }
                $this->setTemplate($this->aTemplate);
            }

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

            if ($this->bchRulsScheduledForDeletion !== null) {
                if (!$this->bchRulsScheduledForDeletion->isEmpty()) {
                    BchRulQuery::create()
                        ->filterByPrimaryKeys($this->bchRulsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->bchRulsScheduledForDeletion = null;
                }
            }

            if ($this->collBchRuls !== null) {
                foreach ($this->collBchRuls as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nodeTreesRelatedByBchIdScheduledForDeletion !== null) {
                if (!$this->nodeTreesRelatedByBchIdScheduledForDeletion->isEmpty()) {
                    foreach ($this->nodeTreesRelatedByBchIdScheduledForDeletion as $nodeTreeRelatedByBchId) {
                        // need to save related object because we set the relation to null
                        $nodeTreeRelatedByBchId->save($con);
                    }
                    $this->nodeTreesRelatedByBchIdScheduledForDeletion = null;
                }
            }

            if ($this->collNodeTreesRelatedByBchId !== null) {
                foreach ($this->collNodeTreesRelatedByBchId as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->nodeTreesRelatedByBchParentScheduledForDeletion !== null) {
                if (!$this->nodeTreesRelatedByBchParentScheduledForDeletion->isEmpty()) {
                    foreach ($this->nodeTreesRelatedByBchParentScheduledForDeletion as $nodeTreeRelatedByBchParent) {
                        // need to save related object because we set the relation to null
                        $nodeTreeRelatedByBchParent->save($con);
                    }
                    $this->nodeTreesRelatedByBchParentScheduledForDeletion = null;
                }
            }

            if ($this->collNodeTreesRelatedByBchParent !== null) {
                foreach ($this->collNodeTreesRelatedByBchParent as $referrerFK) {
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

        $this->modifiedColumns[] = BranchPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . BranchPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(BranchPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(BranchPeer::BCH_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'bch_title';
        }
        if ($this->isColumnModified(BranchPeer::BCH_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'bch_active';
        }
        if ($this->isColumnModified(BranchPeer::BCH_PUBLISHED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'bch_published_at';
        }
        if ($this->isColumnModified(BranchPeer::BCH_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'bch_level';
        }
        if ($this->isColumnModified(BranchPeer::BCH_URL)) {
            $modifiedColumns[':p' . $index++]  = 'bch_url';
        }
        if ($this->isColumnModified(BranchPeer::CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'created_by';
        }
        if ($this->isColumnModified(BranchPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(BranchPeer::UPDATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'updated_by';
        }
        if ($this->isColumnModified(BranchPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }
        if ($this->isColumnModified(BranchPeer::TPL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'tpl_id';
        }

        $sql = sprintf(
            'INSERT INTO branch (%s) VALUES (%s)',
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
                    case 'bch_title':
                        $stmt->bindValue($identifier, $this->bch_title, PDO::PARAM_STR);
                        break;
                    case 'bch_active':
                        $stmt->bindValue($identifier, (int) $this->bch_active, PDO::PARAM_INT);
                        break;
                    case 'bch_published_at':
                        $stmt->bindValue($identifier, $this->bch_published_at, PDO::PARAM_STR);
                        break;
                    case 'bch_level':
                        $stmt->bindValue($identifier, $this->bch_level, PDO::PARAM_INT);
                        break;
                    case 'bch_url':
                        $stmt->bindValue($identifier, $this->bch_url, PDO::PARAM_STR);
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
                    case 'tpl_id':
                        $stmt->bindValue($identifier, $this->tpl_id, PDO::PARAM_INT);
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

            if ($this->aTemplate !== null) {
                if (!$this->aTemplate->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTemplate->getValidationFailures());
                }
            }

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


            if (($retval = BranchPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBchRuls !== null) {
                    foreach ($this->collBchRuls as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNodeTreesRelatedByBchId !== null) {
                    foreach ($this->collNodeTreesRelatedByBchId as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNodeTreesRelatedByBchParent !== null) {
                    foreach ($this->collNodeTreesRelatedByBchParent as $referrerFK) {
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
        $pos = BranchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getBchTitle();
                break;
            case 2:
                return $this->getBchActive();
                break;
            case 3:
                return $this->getBchPublishedAt();
                break;
            case 4:
                return $this->getBchLevel();
                break;
            case 5:
                return $this->getBchUrl();
                break;
            case 6:
                return $this->getCreatedBy();
                break;
            case 7:
                return $this->getCreatedAt();
                break;
            case 8:
                return $this->getUpdatedBy();
                break;
            case 9:
                return $this->getUpdatedAt();
                break;
            case 10:
                return $this->getTplId();
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
        if (isset($alreadyDumpedObjects['Branch'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Branch'][$this->getPrimaryKey()] = true;
        $keys = BranchPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getBchTitle(),
            $keys[2] => $this->getBchActive(),
            $keys[3] => $this->getBchPublishedAt(),
            $keys[4] => $this->getBchLevel(),
            $keys[5] => $this->getBchUrl(),
            $keys[6] => $this->getCreatedBy(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedBy(),
            $keys[9] => $this->getUpdatedAt(),
            $keys[10] => $this->getTplId(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTemplate) {
                $result['Template'] = $this->aTemplate->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByCreatedBy) {
                $result['UserRelatedByCreatedBy'] = $this->aUserRelatedByCreatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUpdatedBy) {
                $result['UserRelatedByUpdatedBy'] = $this->aUserRelatedByUpdatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collBchRuls) {
                $result['BchRuls'] = $this->collBchRuls->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNodeTreesRelatedByBchId) {
                $result['NodeTreesRelatedByBchId'] = $this->collNodeTreesRelatedByBchId->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNodeTreesRelatedByBchParent) {
                $result['NodeTreesRelatedByBchParent'] = $this->collNodeTreesRelatedByBchParent->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = BranchPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setBchTitle($value);
                break;
            case 2:
                $this->setBchActive($value);
                break;
            case 3:
                $this->setBchPublishedAt($value);
                break;
            case 4:
                $this->setBchLevel($value);
                break;
            case 5:
                $this->setBchUrl($value);
                break;
            case 6:
                $this->setCreatedBy($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
                $this->setUpdatedBy($value);
                break;
            case 9:
                $this->setUpdatedAt($value);
                break;
            case 10:
                $this->setTplId($value);
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
        $keys = BranchPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setBchTitle($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setBchActive($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setBchPublishedAt($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setBchLevel($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setBchUrl($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCreatedBy($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUpdatedBy($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setUpdatedAt($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setTplId($arr[$keys[10]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(BranchPeer::DATABASE_NAME);

        if ($this->isColumnModified(BranchPeer::ID)) $criteria->add(BranchPeer::ID, $this->id);
        if ($this->isColumnModified(BranchPeer::BCH_TITLE)) $criteria->add(BranchPeer::BCH_TITLE, $this->bch_title);
        if ($this->isColumnModified(BranchPeer::BCH_ACTIVE)) $criteria->add(BranchPeer::BCH_ACTIVE, $this->bch_active);
        if ($this->isColumnModified(BranchPeer::BCH_PUBLISHED_AT)) $criteria->add(BranchPeer::BCH_PUBLISHED_AT, $this->bch_published_at);
        if ($this->isColumnModified(BranchPeer::BCH_LEVEL)) $criteria->add(BranchPeer::BCH_LEVEL, $this->bch_level);
        if ($this->isColumnModified(BranchPeer::BCH_URL)) $criteria->add(BranchPeer::BCH_URL, $this->bch_url);
        if ($this->isColumnModified(BranchPeer::CREATED_BY)) $criteria->add(BranchPeer::CREATED_BY, $this->created_by);
        if ($this->isColumnModified(BranchPeer::CREATED_AT)) $criteria->add(BranchPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(BranchPeer::UPDATED_BY)) $criteria->add(BranchPeer::UPDATED_BY, $this->updated_by);
        if ($this->isColumnModified(BranchPeer::UPDATED_AT)) $criteria->add(BranchPeer::UPDATED_AT, $this->updated_at);
        if ($this->isColumnModified(BranchPeer::TPL_ID)) $criteria->add(BranchPeer::TPL_ID, $this->tpl_id);

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
        $criteria = new Criteria(BranchPeer::DATABASE_NAME);
        $criteria->add(BranchPeer::ID, $this->id);

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
     * @param object $copyObj An object of Branch (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setBchTitle($this->getBchTitle());
        $copyObj->setBchActive($this->getBchActive());
        $copyObj->setBchPublishedAt($this->getBchPublishedAt());
        $copyObj->setBchLevel($this->getBchLevel());
        $copyObj->setBchUrl($this->getBchUrl());
        $copyObj->setCreatedBy($this->getCreatedBy());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedBy($this->getUpdatedBy());
        $copyObj->setUpdatedAt($this->getUpdatedAt());
        $copyObj->setTplId($this->getTplId());

        if ($deepCopy && !$this->startCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);
            // store object hash to prevent cycle
            $this->startCopy = true;

            foreach ($this->getBchRuls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addBchRul($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNodeTreesRelatedByBchId() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNodeTreeRelatedByBchId($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNodeTreesRelatedByBchParent() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNodeTreeRelatedByBchParent($relObj->copy($deepCopy));
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
     * @return Branch Clone of current object.
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
     * @return BranchPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new BranchPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a Template object.
     *
     * @param             Template $v
     * @return Branch The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTemplate(Template $v = null)
    {
        if ($v === null) {
            $this->setTplId(NULL);
        } else {
            $this->setTplId($v->getId());
        }

        $this->aTemplate = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Template object, it will not be re-added.
        if ($v !== null) {
            $v->addBranch($this);
        }


        return $this;
    }


    /**
     * Get the associated Template object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Template The associated Template object.
     * @throws PropelException
     */
    public function getTemplate(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTemplate === null && ($this->tpl_id !== null) && $doQuery) {
            $this->aTemplate = TemplateQuery::create()->findPk($this->tpl_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTemplate->addBranchs($this);
             */
        }

        return $this->aTemplate;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Branch The current object (for fluent API support)
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
            $v->addBranchRelatedByCreatedBy($this);
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
                $this->aUserRelatedByCreatedBy->addBranchsRelatedByCreatedBy($this);
             */
        }

        return $this->aUserRelatedByCreatedBy;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Branch The current object (for fluent API support)
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
            $v->addBranchRelatedByUpdatedBy($this);
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
                $this->aUserRelatedByUpdatedBy->addBranchsRelatedByUpdatedBy($this);
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
        if ('BchRul' == $relationName) {
            $this->initBchRuls();
        }
        if ('NodeTreeRelatedByBchId' == $relationName) {
            $this->initNodeTreesRelatedByBchId();
        }
        if ('NodeTreeRelatedByBchParent' == $relationName) {
            $this->initNodeTreesRelatedByBchParent();
        }
    }

    /**
     * Clears out the collBchRuls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Branch The current object (for fluent API support)
     * @see        addBchRuls()
     */
    public function clearBchRuls()
    {
        $this->collBchRuls = null; // important to set this to null since that means it is uninitialized
        $this->collBchRulsPartial = null;

        return $this;
    }

    /**
     * reset is the collBchRuls collection loaded partially
     *
     * @return void
     */
    public function resetPartialBchRuls($v = true)
    {
        $this->collBchRulsPartial = $v;
    }

    /**
     * Initializes the collBchRuls collection.
     *
     * By default this just sets the collBchRuls collection to an empty array (like clearcollBchRuls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initBchRuls($overrideExisting = true)
    {
        if (null !== $this->collBchRuls && !$overrideExisting) {
            return;
        }
        $this->collBchRuls = new PropelObjectCollection();
        $this->collBchRuls->setModel('BchRul');
    }

    /**
     * Gets an array of BchRul objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Branch is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     * @throws PropelException
     */
    public function getBchRuls($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collBchRulsPartial && !$this->isNew();
        if (null === $this->collBchRuls || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collBchRuls) {
                // return empty collection
                $this->initBchRuls();
            } else {
                $collBchRuls = BchRulQuery::create(null, $criteria)
                    ->filterByBranch($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collBchRulsPartial && count($collBchRuls)) {
                      $this->initBchRuls(false);

                      foreach($collBchRuls as $obj) {
                        if (false == $this->collBchRuls->contains($obj)) {
                          $this->collBchRuls->append($obj);
                        }
                      }

                      $this->collBchRulsPartial = true;
                    }

                    $collBchRuls->getInternalIterator()->rewind();
                    return $collBchRuls;
                }

                if($partial && $this->collBchRuls) {
                    foreach($this->collBchRuls as $obj) {
                        if($obj->isNew()) {
                            $collBchRuls[] = $obj;
                        }
                    }
                }

                $this->collBchRuls = $collBchRuls;
                $this->collBchRulsPartial = false;
            }
        }

        return $this->collBchRuls;
    }

    /**
     * Sets a collection of BchRul objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $bchRuls A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Branch The current object (for fluent API support)
     */
    public function setBchRuls(PropelCollection $bchRuls, PropelPDO $con = null)
    {
        $bchRulsToDelete = $this->getBchRuls(new Criteria(), $con)->diff($bchRuls);

        $this->bchRulsScheduledForDeletion = unserialize(serialize($bchRulsToDelete));

        foreach ($bchRulsToDelete as $bchRulRemoved) {
            $bchRulRemoved->setBranch(null);
        }

        $this->collBchRuls = null;
        foreach ($bchRuls as $bchRul) {
            $this->addBchRul($bchRul);
        }

        $this->collBchRuls = $bchRuls;
        $this->collBchRulsPartial = false;

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
    public function countBchRuls(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collBchRulsPartial && !$this->isNew();
        if (null === $this->collBchRuls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collBchRuls) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getBchRuls());
            }
            $query = BchRulQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBranch($this)
                ->count($con);
        }

        return count($this->collBchRuls);
    }

    /**
     * Method called to associate a BchRul object to this object
     * through the BchRul foreign key attribute.
     *
     * @param    BchRul $l BchRul
     * @return Branch The current object (for fluent API support)
     */
    public function addBchRul(BchRul $l)
    {
        if ($this->collBchRuls === null) {
            $this->initBchRuls();
            $this->collBchRulsPartial = true;
        }
        if (!in_array($l, $this->collBchRuls->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddBchRul($l);
        }

        return $this;
    }

    /**
     * @param	BchRul $bchRul The bchRul object to add.
     */
    protected function doAddBchRul($bchRul)
    {
        $this->collBchRuls[]= $bchRul;
        $bchRul->setBranch($this);
    }

    /**
     * @param	BchRul $bchRul The bchRul object to remove.
     * @return Branch The current object (for fluent API support)
     */
    public function removeBchRul($bchRul)
    {
        if ($this->getBchRuls()->contains($bchRul)) {
            $this->collBchRuls->remove($this->collBchRuls->search($bchRul));
            if (null === $this->bchRulsScheduledForDeletion) {
                $this->bchRulsScheduledForDeletion = clone $this->collBchRuls;
                $this->bchRulsScheduledForDeletion->clear();
            }
            $this->bchRulsScheduledForDeletion[]= clone $bchRul;
            $bchRul->setBranch(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related BchRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     */
    public function getBchRulsJoinRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BchRulQuery::create(null, $criteria);
        $query->joinWith('Rule', $join_behavior);

        return $this->getBchRuls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related BchRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     */
    public function getBchRulsJoinUserRelatedByCreatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BchRulQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCreatedBy', $join_behavior);

        return $this->getBchRuls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related BchRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     */
    public function getBchRulsJoinUserRelatedByUpdatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BchRulQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUpdatedBy', $join_behavior);

        return $this->getBchRuls($query, $con);
    }

    /**
     * Clears out the collNodeTreesRelatedByBchId collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Branch The current object (for fluent API support)
     * @see        addNodeTreesRelatedByBchId()
     */
    public function clearNodeTreesRelatedByBchId()
    {
        $this->collNodeTreesRelatedByBchId = null; // important to set this to null since that means it is uninitialized
        $this->collNodeTreesRelatedByBchIdPartial = null;

        return $this;
    }

    /**
     * reset is the collNodeTreesRelatedByBchId collection loaded partially
     *
     * @return void
     */
    public function resetPartialNodeTreesRelatedByBchId($v = true)
    {
        $this->collNodeTreesRelatedByBchIdPartial = $v;
    }

    /**
     * Initializes the collNodeTreesRelatedByBchId collection.
     *
     * By default this just sets the collNodeTreesRelatedByBchId collection to an empty array (like clearcollNodeTreesRelatedByBchId());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNodeTreesRelatedByBchId($overrideExisting = true)
    {
        if (null !== $this->collNodeTreesRelatedByBchId && !$overrideExisting) {
            return;
        }
        $this->collNodeTreesRelatedByBchId = new PropelObjectCollection();
        $this->collNodeTreesRelatedByBchId->setModel('NodeTree');
    }

    /**
     * Gets an array of NodeTree objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Branch is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     * @throws PropelException
     */
    public function getNodeTreesRelatedByBchId($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesRelatedByBchIdPartial && !$this->isNew();
        if (null === $this->collNodeTreesRelatedByBchId || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNodeTreesRelatedByBchId) {
                // return empty collection
                $this->initNodeTreesRelatedByBchId();
            } else {
                $collNodeTreesRelatedByBchId = NodeTreeQuery::create(null, $criteria)
                    ->filterByBranchRelatedByBchId($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNodeTreesRelatedByBchIdPartial && count($collNodeTreesRelatedByBchId)) {
                      $this->initNodeTreesRelatedByBchId(false);

                      foreach($collNodeTreesRelatedByBchId as $obj) {
                        if (false == $this->collNodeTreesRelatedByBchId->contains($obj)) {
                          $this->collNodeTreesRelatedByBchId->append($obj);
                        }
                      }

                      $this->collNodeTreesRelatedByBchIdPartial = true;
                    }

                    $collNodeTreesRelatedByBchId->getInternalIterator()->rewind();
                    return $collNodeTreesRelatedByBchId;
                }

                if($partial && $this->collNodeTreesRelatedByBchId) {
                    foreach($this->collNodeTreesRelatedByBchId as $obj) {
                        if($obj->isNew()) {
                            $collNodeTreesRelatedByBchId[] = $obj;
                        }
                    }
                }

                $this->collNodeTreesRelatedByBchId = $collNodeTreesRelatedByBchId;
                $this->collNodeTreesRelatedByBchIdPartial = false;
            }
        }

        return $this->collNodeTreesRelatedByBchId;
    }

    /**
     * Sets a collection of NodeTreeRelatedByBchId objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nodeTreesRelatedByBchId A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Branch The current object (for fluent API support)
     */
    public function setNodeTreesRelatedByBchId(PropelCollection $nodeTreesRelatedByBchId, PropelPDO $con = null)
    {
        $nodeTreesRelatedByBchIdToDelete = $this->getNodeTreesRelatedByBchId(new Criteria(), $con)->diff($nodeTreesRelatedByBchId);

        $this->nodeTreesRelatedByBchIdScheduledForDeletion = unserialize(serialize($nodeTreesRelatedByBchIdToDelete));

        foreach ($nodeTreesRelatedByBchIdToDelete as $nodeTreeRelatedByBchIdRemoved) {
            $nodeTreeRelatedByBchIdRemoved->setBranchRelatedByBchId(null);
        }

        $this->collNodeTreesRelatedByBchId = null;
        foreach ($nodeTreesRelatedByBchId as $nodeTreeRelatedByBchId) {
            $this->addNodeTreeRelatedByBchId($nodeTreeRelatedByBchId);
        }

        $this->collNodeTreesRelatedByBchId = $nodeTreesRelatedByBchId;
        $this->collNodeTreesRelatedByBchIdPartial = false;

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
    public function countNodeTreesRelatedByBchId(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesRelatedByBchIdPartial && !$this->isNew();
        if (null === $this->collNodeTreesRelatedByBchId || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNodeTreesRelatedByBchId) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getNodeTreesRelatedByBchId());
            }
            $query = NodeTreeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBranchRelatedByBchId($this)
                ->count($con);
        }

        return count($this->collNodeTreesRelatedByBchId);
    }

    /**
     * Method called to associate a NodeTree object to this object
     * through the NodeTree foreign key attribute.
     *
     * @param    NodeTree $l NodeTree
     * @return Branch The current object (for fluent API support)
     */
    public function addNodeTreeRelatedByBchId(NodeTree $l)
    {
        if ($this->collNodeTreesRelatedByBchId === null) {
            $this->initNodeTreesRelatedByBchId();
            $this->collNodeTreesRelatedByBchIdPartial = true;
        }
        if (!in_array($l, $this->collNodeTreesRelatedByBchId->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNodeTreeRelatedByBchId($l);
        }

        return $this;
    }

    /**
     * @param	NodeTreeRelatedByBchId $nodeTreeRelatedByBchId The nodeTreeRelatedByBchId object to add.
     */
    protected function doAddNodeTreeRelatedByBchId($nodeTreeRelatedByBchId)
    {
        $this->collNodeTreesRelatedByBchId[]= $nodeTreeRelatedByBchId;
        $nodeTreeRelatedByBchId->setBranchRelatedByBchId($this);
    }

    /**
     * @param	NodeTreeRelatedByBchId $nodeTreeRelatedByBchId The nodeTreeRelatedByBchId object to remove.
     * @return Branch The current object (for fluent API support)
     */
    public function removeNodeTreeRelatedByBchId($nodeTreeRelatedByBchId)
    {
        if ($this->getNodeTreesRelatedByBchId()->contains($nodeTreeRelatedByBchId)) {
            $this->collNodeTreesRelatedByBchId->remove($this->collNodeTreesRelatedByBchId->search($nodeTreeRelatedByBchId));
            if (null === $this->nodeTreesRelatedByBchIdScheduledForDeletion) {
                $this->nodeTreesRelatedByBchIdScheduledForDeletion = clone $this->collNodeTreesRelatedByBchId;
                $this->nodeTreesRelatedByBchIdScheduledForDeletion->clear();
            }
            $this->nodeTreesRelatedByBchIdScheduledForDeletion[]= $nodeTreeRelatedByBchId;
            $nodeTreeRelatedByBchId->setBranchRelatedByBchId(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related NodeTreesRelatedByBchId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByBchIdJoinUserRelatedByCreatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCreatedBy', $join_behavior);

        return $this->getNodeTreesRelatedByBchId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related NodeTreesRelatedByBchId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByBchIdJoinUserRelatedByUpdatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUpdatedBy', $join_behavior);

        return $this->getNodeTreesRelatedByBchId($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related NodeTreesRelatedByBchId from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByBchIdJoinLeaf($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('Leaf', $join_behavior);

        return $this->getNodeTreesRelatedByBchId($query, $con);
    }

    /**
     * Clears out the collNodeTreesRelatedByBchParent collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Branch The current object (for fluent API support)
     * @see        addNodeTreesRelatedByBchParent()
     */
    public function clearNodeTreesRelatedByBchParent()
    {
        $this->collNodeTreesRelatedByBchParent = null; // important to set this to null since that means it is uninitialized
        $this->collNodeTreesRelatedByBchParentPartial = null;

        return $this;
    }

    /**
     * reset is the collNodeTreesRelatedByBchParent collection loaded partially
     *
     * @return void
     */
    public function resetPartialNodeTreesRelatedByBchParent($v = true)
    {
        $this->collNodeTreesRelatedByBchParentPartial = $v;
    }

    /**
     * Initializes the collNodeTreesRelatedByBchParent collection.
     *
     * By default this just sets the collNodeTreesRelatedByBchParent collection to an empty array (like clearcollNodeTreesRelatedByBchParent());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNodeTreesRelatedByBchParent($overrideExisting = true)
    {
        if (null !== $this->collNodeTreesRelatedByBchParent && !$overrideExisting) {
            return;
        }
        $this->collNodeTreesRelatedByBchParent = new PropelObjectCollection();
        $this->collNodeTreesRelatedByBchParent->setModel('NodeTree');
    }

    /**
     * Gets an array of NodeTree objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Branch is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     * @throws PropelException
     */
    public function getNodeTreesRelatedByBchParent($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesRelatedByBchParentPartial && !$this->isNew();
        if (null === $this->collNodeTreesRelatedByBchParent || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNodeTreesRelatedByBchParent) {
                // return empty collection
                $this->initNodeTreesRelatedByBchParent();
            } else {
                $collNodeTreesRelatedByBchParent = NodeTreeQuery::create(null, $criteria)
                    ->filterByBranchRelatedByBchParent($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNodeTreesRelatedByBchParentPartial && count($collNodeTreesRelatedByBchParent)) {
                      $this->initNodeTreesRelatedByBchParent(false);

                      foreach($collNodeTreesRelatedByBchParent as $obj) {
                        if (false == $this->collNodeTreesRelatedByBchParent->contains($obj)) {
                          $this->collNodeTreesRelatedByBchParent->append($obj);
                        }
                      }

                      $this->collNodeTreesRelatedByBchParentPartial = true;
                    }

                    $collNodeTreesRelatedByBchParent->getInternalIterator()->rewind();
                    return $collNodeTreesRelatedByBchParent;
                }

                if($partial && $this->collNodeTreesRelatedByBchParent) {
                    foreach($this->collNodeTreesRelatedByBchParent as $obj) {
                        if($obj->isNew()) {
                            $collNodeTreesRelatedByBchParent[] = $obj;
                        }
                    }
                }

                $this->collNodeTreesRelatedByBchParent = $collNodeTreesRelatedByBchParent;
                $this->collNodeTreesRelatedByBchParentPartial = false;
            }
        }

        return $this->collNodeTreesRelatedByBchParent;
    }

    /**
     * Sets a collection of NodeTreeRelatedByBchParent objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nodeTreesRelatedByBchParent A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Branch The current object (for fluent API support)
     */
    public function setNodeTreesRelatedByBchParent(PropelCollection $nodeTreesRelatedByBchParent, PropelPDO $con = null)
    {
        $nodeTreesRelatedByBchParentToDelete = $this->getNodeTreesRelatedByBchParent(new Criteria(), $con)->diff($nodeTreesRelatedByBchParent);

        $this->nodeTreesRelatedByBchParentScheduledForDeletion = unserialize(serialize($nodeTreesRelatedByBchParentToDelete));

        foreach ($nodeTreesRelatedByBchParentToDelete as $nodeTreeRelatedByBchParentRemoved) {
            $nodeTreeRelatedByBchParentRemoved->setBranchRelatedByBchParent(null);
        }

        $this->collNodeTreesRelatedByBchParent = null;
        foreach ($nodeTreesRelatedByBchParent as $nodeTreeRelatedByBchParent) {
            $this->addNodeTreeRelatedByBchParent($nodeTreeRelatedByBchParent);
        }

        $this->collNodeTreesRelatedByBchParent = $nodeTreesRelatedByBchParent;
        $this->collNodeTreesRelatedByBchParentPartial = false;

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
    public function countNodeTreesRelatedByBchParent(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesRelatedByBchParentPartial && !$this->isNew();
        if (null === $this->collNodeTreesRelatedByBchParent || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNodeTreesRelatedByBchParent) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getNodeTreesRelatedByBchParent());
            }
            $query = NodeTreeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByBranchRelatedByBchParent($this)
                ->count($con);
        }

        return count($this->collNodeTreesRelatedByBchParent);
    }

    /**
     * Method called to associate a NodeTree object to this object
     * through the NodeTree foreign key attribute.
     *
     * @param    NodeTree $l NodeTree
     * @return Branch The current object (for fluent API support)
     */
    public function addNodeTreeRelatedByBchParent(NodeTree $l)
    {
        if ($this->collNodeTreesRelatedByBchParent === null) {
            $this->initNodeTreesRelatedByBchParent();
            $this->collNodeTreesRelatedByBchParentPartial = true;
        }
        if (!in_array($l, $this->collNodeTreesRelatedByBchParent->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNodeTreeRelatedByBchParent($l);
        }

        return $this;
    }

    /**
     * @param	NodeTreeRelatedByBchParent $nodeTreeRelatedByBchParent The nodeTreeRelatedByBchParent object to add.
     */
    protected function doAddNodeTreeRelatedByBchParent($nodeTreeRelatedByBchParent)
    {
        $this->collNodeTreesRelatedByBchParent[]= $nodeTreeRelatedByBchParent;
        $nodeTreeRelatedByBchParent->setBranchRelatedByBchParent($this);
    }

    /**
     * @param	NodeTreeRelatedByBchParent $nodeTreeRelatedByBchParent The nodeTreeRelatedByBchParent object to remove.
     * @return Branch The current object (for fluent API support)
     */
    public function removeNodeTreeRelatedByBchParent($nodeTreeRelatedByBchParent)
    {
        if ($this->getNodeTreesRelatedByBchParent()->contains($nodeTreeRelatedByBchParent)) {
            $this->collNodeTreesRelatedByBchParent->remove($this->collNodeTreesRelatedByBchParent->search($nodeTreeRelatedByBchParent));
            if (null === $this->nodeTreesRelatedByBchParentScheduledForDeletion) {
                $this->nodeTreesRelatedByBchParentScheduledForDeletion = clone $this->collNodeTreesRelatedByBchParent;
                $this->nodeTreesRelatedByBchParentScheduledForDeletion->clear();
            }
            $this->nodeTreesRelatedByBchParentScheduledForDeletion[]= $nodeTreeRelatedByBchParent;
            $nodeTreeRelatedByBchParent->setBranchRelatedByBchParent(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related NodeTreesRelatedByBchParent from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByBchParentJoinUserRelatedByCreatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCreatedBy', $join_behavior);

        return $this->getNodeTreesRelatedByBchParent($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related NodeTreesRelatedByBchParent from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByBchParentJoinUserRelatedByUpdatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUpdatedBy', $join_behavior);

        return $this->getNodeTreesRelatedByBchParent($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Branch is new, it will return
     * an empty collection; or if this Branch has previously
     * been saved, it will retrieve related NodeTreesRelatedByBchParent from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Branch.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesRelatedByBchParentJoinLeaf($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('Leaf', $join_behavior);

        return $this->getNodeTreesRelatedByBchParent($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->bch_title = null;
        $this->bch_active = null;
        $this->bch_published_at = null;
        $this->bch_level = null;
        $this->bch_url = null;
        $this->created_by = null;
        $this->created_at = null;
        $this->updated_by = null;
        $this->updated_at = null;
        $this->tpl_id = null;
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
            if ($this->collBchRuls) {
                foreach ($this->collBchRuls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNodeTreesRelatedByBchId) {
                foreach ($this->collNodeTreesRelatedByBchId as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNodeTreesRelatedByBchParent) {
                foreach ($this->collNodeTreesRelatedByBchParent as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aTemplate instanceof Persistent) {
              $this->aTemplate->clearAllReferences($deep);
            }
            if ($this->aUserRelatedByCreatedBy instanceof Persistent) {
              $this->aUserRelatedByCreatedBy->clearAllReferences($deep);
            }
            if ($this->aUserRelatedByUpdatedBy instanceof Persistent) {
              $this->aUserRelatedByUpdatedBy->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        if ($this->collBchRuls instanceof PropelCollection) {
            $this->collBchRuls->clearIterator();
        }
        $this->collBchRuls = null;
        if ($this->collNodeTreesRelatedByBchId instanceof PropelCollection) {
            $this->collNodeTreesRelatedByBchId->clearIterator();
        }
        $this->collNodeTreesRelatedByBchId = null;
        if ($this->collNodeTreesRelatedByBchParent instanceof PropelCollection) {
            $this->collNodeTreesRelatedByBchParent->clearIterator();
        }
        $this->collNodeTreesRelatedByBchParent = null;
        $this->aTemplate = null;
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
        return (string) $this->exportTo(BranchPeer::DEFAULT_STRING_FORMAT);
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
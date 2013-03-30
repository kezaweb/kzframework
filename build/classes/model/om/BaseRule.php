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
use Kzf\Model\LefRul;
use Kzf\Model\LefRulQuery;
use Kzf\Model\RulOption;
use Kzf\Model\RulOptionQuery;
use Kzf\Model\Rule;
use Kzf\Model\RulePeer;
use Kzf\Model\RuleQuery;
use Kzf\Model\TypeRule;
use Kzf\Model\TypeRuleQuery;
use Kzf\Model\User;
use Kzf\Model\UserQuery;

/**
 * Base class that represents a row from the 'rule' table.
 *
 *
 *
 * @package    propel.generator.model.om
 */
abstract class BaseRule extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Kzf\\Model\\RulePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        RulePeer
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
     * The value for the rul_name field.
     * @var        string
     */
    protected $rul_name;

    /**
     * The value for the rul_desc field.
     * @var        string
     */
    protected $rul_desc;

    /**
     * The value for the rul_actif field.
     * @var        boolean
     */
    protected $rul_actif;

    /**
     * The value for the tru_id field.
     * @var        int
     */
    protected $tru_id;

    /**
     * The value for the created_by field.
     * @var        int
     */
    protected $created_by;

    /**
     * The value for the updated_by field.
     * @var        int
     */
    protected $updated_by;

    /**
     * The value for the created_at field.
     * @var        string
     */
    protected $created_at;

    /**
     * The value for the updated_at field.
     * @var        string
     */
    protected $updated_at;

    /**
     * @var        TypeRule
     */
    protected $aTypeRule;

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
     * @var        PropelObjectCollection|LefRul[] Collection to store aggregation of LefRul objects.
     */
    protected $collLefRuls;
    protected $collLefRulsPartial;

    /**
     * @var        PropelObjectCollection|RulOption[] Collection to store aggregation of RulOption objects.
     */
    protected $collRulOptions;
    protected $collRulOptionsPartial;

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
    protected $lefRulsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $rulOptionsScheduledForDeletion = null;

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
     * Get the [rul_name] column value.
     *
     * @return string
     */
    public function getRulName()
    {
        return $this->rul_name;
    }

    /**
     * Get the [rul_desc] column value.
     *
     * @return string
     */
    public function getRulDesc()
    {
        return $this->rul_desc;
    }

    /**
     * Get the [rul_actif] column value.
     *
     * @return boolean
     */
    public function getRulActif()
    {
        return $this->rul_actif;
    }

    /**
     * Get the [tru_id] column value.
     *
     * @return int
     */
    public function getTruId()
    {
        return $this->tru_id;
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
     * Get the [updated_by] column value.
     *
     * @return int
     */
    public function getUpdatedBy()
    {
        return $this->updated_by;
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
     * @return Rule The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = RulePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [rul_name] column.
     *
     * @param string $v new value
     * @return Rule The current object (for fluent API support)
     */
    public function setRulName($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->rul_name !== $v) {
            $this->rul_name = $v;
            $this->modifiedColumns[] = RulePeer::RUL_NAME;
        }


        return $this;
    } // setRulName()

    /**
     * Set the value of [rul_desc] column.
     *
     * @param string $v new value
     * @return Rule The current object (for fluent API support)
     */
    public function setRulDesc($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->rul_desc !== $v) {
            $this->rul_desc = $v;
            $this->modifiedColumns[] = RulePeer::RUL_DESC;
        }


        return $this;
    } // setRulDesc()

    /**
     * Sets the value of the [rul_actif] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Rule The current object (for fluent API support)
     */
    public function setRulActif($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->rul_actif !== $v) {
            $this->rul_actif = $v;
            $this->modifiedColumns[] = RulePeer::RUL_ACTIF;
        }


        return $this;
    } // setRulActif()

    /**
     * Set the value of [tru_id] column.
     *
     * @param int $v new value
     * @return Rule The current object (for fluent API support)
     */
    public function setTruId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->tru_id !== $v) {
            $this->tru_id = $v;
            $this->modifiedColumns[] = RulePeer::TRU_ID;
        }

        if ($this->aTypeRule !== null && $this->aTypeRule->getId() !== $v) {
            $this->aTypeRule = null;
        }


        return $this;
    } // setTruId()

    /**
     * Set the value of [created_by] column.
     *
     * @param int $v new value
     * @return Rule The current object (for fluent API support)
     */
    public function setCreatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->created_by !== $v) {
            $this->created_by = $v;
            $this->modifiedColumns[] = RulePeer::CREATED_BY;
        }

        if ($this->aUserRelatedByCreatedBy !== null && $this->aUserRelatedByCreatedBy->getId() !== $v) {
            $this->aUserRelatedByCreatedBy = null;
        }


        return $this;
    } // setCreatedBy()

    /**
     * Set the value of [updated_by] column.
     *
     * @param int $v new value
     * @return Rule The current object (for fluent API support)
     */
    public function setUpdatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->updated_by !== $v) {
            $this->updated_by = $v;
            $this->modifiedColumns[] = RulePeer::UPDATED_BY;
        }

        if ($this->aUserRelatedByUpdatedBy !== null && $this->aUserRelatedByUpdatedBy->getId() !== $v) {
            $this->aUserRelatedByUpdatedBy = null;
        }


        return $this;
    } // setUpdatedBy()

    /**
     * Sets the value of [created_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rule The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = RulePeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Sets the value of [updated_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Rule The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = RulePeer::UPDATED_AT;
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
            $this->rul_name = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->rul_desc = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
            $this->rul_actif = ($row[$startcol + 3] !== null) ? (boolean) $row[$startcol + 3] : null;
            $this->tru_id = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->created_by = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->updated_by = ($row[$startcol + 6] !== null) ? (int) $row[$startcol + 6] : null;
            $this->created_at = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 9; // 9 = RulePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Rule object", $e);
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

        if ($this->aTypeRule !== null && $this->tru_id !== $this->aTypeRule->getId()) {
            $this->aTypeRule = null;
        }
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
            $con = Propel::getConnection(RulePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = RulePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aTypeRule = null;
            $this->aUserRelatedByCreatedBy = null;
            $this->aUserRelatedByUpdatedBy = null;
            $this->collBchRuls = null;

            $this->collLefRuls = null;

            $this->collRulOptions = null;

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
            $con = Propel::getConnection(RulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = RuleQuery::create()
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
            $con = Propel::getConnection(RulePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        $isInsert = $this->isNew();
        try {
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
                // timestampable behavior
                if (!$this->isColumnModified(RulePeer::CREATED_AT)) {
                    $this->setCreatedAt(time());
                }
                if (!$this->isColumnModified(RulePeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            } else {
                $ret = $ret && $this->preUpdate($con);
                // timestampable behavior
                if ($this->isModified() && !$this->isColumnModified(RulePeer::UPDATED_AT)) {
                    $this->setUpdatedAt(time());
                }
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                RulePeer::addInstanceToPool($this);
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

            if ($this->aTypeRule !== null) {
                if ($this->aTypeRule->isModified() || $this->aTypeRule->isNew()) {
                    $affectedRows += $this->aTypeRule->save($con);
                }
                $this->setTypeRule($this->aTypeRule);
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

            if ($this->lefRulsScheduledForDeletion !== null) {
                if (!$this->lefRulsScheduledForDeletion->isEmpty()) {
                    LefRulQuery::create()
                        ->filterByPrimaryKeys($this->lefRulsScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->lefRulsScheduledForDeletion = null;
                }
            }

            if ($this->collLefRuls !== null) {
                foreach ($this->collLefRuls as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->rulOptionsScheduledForDeletion !== null) {
                if (!$this->rulOptionsScheduledForDeletion->isEmpty()) {
                    foreach ($this->rulOptionsScheduledForDeletion as $rulOption) {
                        // need to save related object because we set the relation to null
                        $rulOption->save($con);
                    }
                    $this->rulOptionsScheduledForDeletion = null;
                }
            }

            if ($this->collRulOptions !== null) {
                foreach ($this->collRulOptions as $referrerFK) {
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

        $this->modifiedColumns[] = RulePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . RulePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(RulePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(RulePeer::RUL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'rul_name';
        }
        if ($this->isColumnModified(RulePeer::RUL_DESC)) {
            $modifiedColumns[':p' . $index++]  = 'rul_desc';
        }
        if ($this->isColumnModified(RulePeer::RUL_ACTIF)) {
            $modifiedColumns[':p' . $index++]  = 'rul_actif';
        }
        if ($this->isColumnModified(RulePeer::TRU_ID)) {
            $modifiedColumns[':p' . $index++]  = 'tru_id';
        }
        if ($this->isColumnModified(RulePeer::CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'created_by';
        }
        if ($this->isColumnModified(RulePeer::UPDATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'updated_by';
        }
        if ($this->isColumnModified(RulePeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(RulePeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO rule (%s) VALUES (%s)',
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
                    case 'rul_name':
                        $stmt->bindValue($identifier, $this->rul_name, PDO::PARAM_STR);
                        break;
                    case 'rul_desc':
                        $stmt->bindValue($identifier, $this->rul_desc, PDO::PARAM_STR);
                        break;
                    case 'rul_actif':
                        $stmt->bindValue($identifier, (int) $this->rul_actif, PDO::PARAM_INT);
                        break;
                    case 'tru_id':
                        $stmt->bindValue($identifier, $this->tru_id, PDO::PARAM_INT);
                        break;
                    case 'created_by':
                        $stmt->bindValue($identifier, $this->created_by, PDO::PARAM_INT);
                        break;
                    case 'updated_by':
                        $stmt->bindValue($identifier, $this->updated_by, PDO::PARAM_INT);
                        break;
                    case 'created_at':
                        $stmt->bindValue($identifier, $this->created_at, PDO::PARAM_STR);
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

            if ($this->aTypeRule !== null) {
                if (!$this->aTypeRule->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aTypeRule->getValidationFailures());
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


            if (($retval = RulePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collBchRuls !== null) {
                    foreach ($this->collBchRuls as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collLefRuls !== null) {
                    foreach ($this->collLefRuls as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collRulOptions !== null) {
                    foreach ($this->collRulOptions as $referrerFK) {
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
        $pos = RulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getRulName();
                break;
            case 2:
                return $this->getRulDesc();
                break;
            case 3:
                return $this->getRulActif();
                break;
            case 4:
                return $this->getTruId();
                break;
            case 5:
                return $this->getCreatedBy();
                break;
            case 6:
                return $this->getUpdatedBy();
                break;
            case 7:
                return $this->getCreatedAt();
                break;
            case 8:
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
        if (isset($alreadyDumpedObjects['Rule'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Rule'][$this->getPrimaryKey()] = true;
        $keys = RulePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getRulName(),
            $keys[2] => $this->getRulDesc(),
            $keys[3] => $this->getRulActif(),
            $keys[4] => $this->getTruId(),
            $keys[5] => $this->getCreatedBy(),
            $keys[6] => $this->getUpdatedBy(),
            $keys[7] => $this->getCreatedAt(),
            $keys[8] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aTypeRule) {
                $result['TypeRule'] = $this->aTypeRule->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
            if (null !== $this->collLefRuls) {
                $result['LefRuls'] = $this->collLefRuls->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collRulOptions) {
                $result['RulOptions'] = $this->collRulOptions->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = RulePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setRulName($value);
                break;
            case 2:
                $this->setRulDesc($value);
                break;
            case 3:
                $this->setRulActif($value);
                break;
            case 4:
                $this->setTruId($value);
                break;
            case 5:
                $this->setCreatedBy($value);
                break;
            case 6:
                $this->setUpdatedBy($value);
                break;
            case 7:
                $this->setCreatedAt($value);
                break;
            case 8:
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
        $keys = RulePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setRulName($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setRulDesc($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setRulActif($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setTruId($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCreatedBy($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setUpdatedBy($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(RulePeer::DATABASE_NAME);

        if ($this->isColumnModified(RulePeer::ID)) $criteria->add(RulePeer::ID, $this->id);
        if ($this->isColumnModified(RulePeer::RUL_NAME)) $criteria->add(RulePeer::RUL_NAME, $this->rul_name);
        if ($this->isColumnModified(RulePeer::RUL_DESC)) $criteria->add(RulePeer::RUL_DESC, $this->rul_desc);
        if ($this->isColumnModified(RulePeer::RUL_ACTIF)) $criteria->add(RulePeer::RUL_ACTIF, $this->rul_actif);
        if ($this->isColumnModified(RulePeer::TRU_ID)) $criteria->add(RulePeer::TRU_ID, $this->tru_id);
        if ($this->isColumnModified(RulePeer::CREATED_BY)) $criteria->add(RulePeer::CREATED_BY, $this->created_by);
        if ($this->isColumnModified(RulePeer::UPDATED_BY)) $criteria->add(RulePeer::UPDATED_BY, $this->updated_by);
        if ($this->isColumnModified(RulePeer::CREATED_AT)) $criteria->add(RulePeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(RulePeer::UPDATED_AT)) $criteria->add(RulePeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(RulePeer::DATABASE_NAME);
        $criteria->add(RulePeer::ID, $this->id);

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
     * @param object $copyObj An object of Rule (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setRulName($this->getRulName());
        $copyObj->setRulDesc($this->getRulDesc());
        $copyObj->setRulActif($this->getRulActif());
        $copyObj->setTruId($this->getTruId());
        $copyObj->setCreatedBy($this->getCreatedBy());
        $copyObj->setUpdatedBy($this->getUpdatedBy());
        $copyObj->setCreatedAt($this->getCreatedAt());
        $copyObj->setUpdatedAt($this->getUpdatedAt());

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

            foreach ($this->getLefRuls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLefRul($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getRulOptions() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addRulOption($relObj->copy($deepCopy));
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
     * @return Rule Clone of current object.
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
     * @return RulePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new RulePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a TypeRule object.
     *
     * @param             TypeRule $v
     * @return Rule The current object (for fluent API support)
     * @throws PropelException
     */
    public function setTypeRule(TypeRule $v = null)
    {
        if ($v === null) {
            $this->setTruId(NULL);
        } else {
            $this->setTruId($v->getId());
        }

        $this->aTypeRule = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the TypeRule object, it will not be re-added.
        if ($v !== null) {
            $v->addRule($this);
        }


        return $this;
    }


    /**
     * Get the associated TypeRule object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return TypeRule The associated TypeRule object.
     * @throws PropelException
     */
    public function getTypeRule(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aTypeRule === null && ($this->tru_id !== null) && $doQuery) {
            $this->aTypeRule = TypeRuleQuery::create()->findPk($this->tru_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aTypeRule->addRules($this);
             */
        }

        return $this->aTypeRule;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Rule The current object (for fluent API support)
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
            $v->addRuleRelatedByCreatedBy($this);
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
                $this->aUserRelatedByCreatedBy->addRulesRelatedByCreatedBy($this);
             */
        }

        return $this->aUserRelatedByCreatedBy;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Rule The current object (for fluent API support)
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
            $v->addRuleRelatedByUpdatedBy($this);
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
                $this->aUserRelatedByUpdatedBy->addRulesRelatedByUpdatedBy($this);
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
        if ('LefRul' == $relationName) {
            $this->initLefRuls();
        }
        if ('RulOption' == $relationName) {
            $this->initRulOptions();
        }
    }

    /**
     * Clears out the collBchRuls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Rule The current object (for fluent API support)
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
     * If this Rule is new, it will return
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
                    ->filterByRule($this)
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
     * @return Rule The current object (for fluent API support)
     */
    public function setBchRuls(PropelCollection $bchRuls, PropelPDO $con = null)
    {
        $bchRulsToDelete = $this->getBchRuls(new Criteria(), $con)->diff($bchRuls);

        $this->bchRulsScheduledForDeletion = unserialize(serialize($bchRulsToDelete));

        foreach ($bchRulsToDelete as $bchRulRemoved) {
            $bchRulRemoved->setRule(null);
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
                ->filterByRule($this)
                ->count($con);
        }

        return count($this->collBchRuls);
    }

    /**
     * Method called to associate a BchRul object to this object
     * through the BchRul foreign key attribute.
     *
     * @param    BchRul $l BchRul
     * @return Rule The current object (for fluent API support)
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
        $bchRul->setRule($this);
    }

    /**
     * @param	BchRul $bchRul The bchRul object to remove.
     * @return Rule The current object (for fluent API support)
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
            $bchRul->setRule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Rule is new, it will return
     * an empty collection; or if this Rule has previously
     * been saved, it will retrieve related BchRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Rule.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|BchRul[] List of BchRul objects
     */
    public function getBchRulsJoinBranch($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = BchRulQuery::create(null, $criteria);
        $query->joinWith('Branch', $join_behavior);

        return $this->getBchRuls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Rule is new, it will return
     * an empty collection; or if this Rule has previously
     * been saved, it will retrieve related BchRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Rule.
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
     * Otherwise if this Rule is new, it will return
     * an empty collection; or if this Rule has previously
     * been saved, it will retrieve related BchRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Rule.
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
     * Clears out the collLefRuls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Rule The current object (for fluent API support)
     * @see        addLefRuls()
     */
    public function clearLefRuls()
    {
        $this->collLefRuls = null; // important to set this to null since that means it is uninitialized
        $this->collLefRulsPartial = null;

        return $this;
    }

    /**
     * reset is the collLefRuls collection loaded partially
     *
     * @return void
     */
    public function resetPartialLefRuls($v = true)
    {
        $this->collLefRulsPartial = $v;
    }

    /**
     * Initializes the collLefRuls collection.
     *
     * By default this just sets the collLefRuls collection to an empty array (like clearcollLefRuls());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initLefRuls($overrideExisting = true)
    {
        if (null !== $this->collLefRuls && !$overrideExisting) {
            return;
        }
        $this->collLefRuls = new PropelObjectCollection();
        $this->collLefRuls->setModel('LefRul');
    }

    /**
     * Gets an array of LefRul objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Rule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     * @throws PropelException
     */
    public function getLefRuls($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collLefRulsPartial && !$this->isNew();
        if (null === $this->collLefRuls || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collLefRuls) {
                // return empty collection
                $this->initLefRuls();
            } else {
                $collLefRuls = LefRulQuery::create(null, $criteria)
                    ->filterByRule($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collLefRulsPartial && count($collLefRuls)) {
                      $this->initLefRuls(false);

                      foreach($collLefRuls as $obj) {
                        if (false == $this->collLefRuls->contains($obj)) {
                          $this->collLefRuls->append($obj);
                        }
                      }

                      $this->collLefRulsPartial = true;
                    }

                    $collLefRuls->getInternalIterator()->rewind();
                    return $collLefRuls;
                }

                if($partial && $this->collLefRuls) {
                    foreach($this->collLefRuls as $obj) {
                        if($obj->isNew()) {
                            $collLefRuls[] = $obj;
                        }
                    }
                }

                $this->collLefRuls = $collLefRuls;
                $this->collLefRulsPartial = false;
            }
        }

        return $this->collLefRuls;
    }

    /**
     * Sets a collection of LefRul objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $lefRuls A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Rule The current object (for fluent API support)
     */
    public function setLefRuls(PropelCollection $lefRuls, PropelPDO $con = null)
    {
        $lefRulsToDelete = $this->getLefRuls(new Criteria(), $con)->diff($lefRuls);

        $this->lefRulsScheduledForDeletion = unserialize(serialize($lefRulsToDelete));

        foreach ($lefRulsToDelete as $lefRulRemoved) {
            $lefRulRemoved->setRule(null);
        }

        $this->collLefRuls = null;
        foreach ($lefRuls as $lefRul) {
            $this->addLefRul($lefRul);
        }

        $this->collLefRuls = $lefRuls;
        $this->collLefRulsPartial = false;

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
    public function countLefRuls(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collLefRulsPartial && !$this->isNew();
        if (null === $this->collLefRuls || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collLefRuls) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getLefRuls());
            }
            $query = LefRulQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRule($this)
                ->count($con);
        }

        return count($this->collLefRuls);
    }

    /**
     * Method called to associate a LefRul object to this object
     * through the LefRul foreign key attribute.
     *
     * @param    LefRul $l LefRul
     * @return Rule The current object (for fluent API support)
     */
    public function addLefRul(LefRul $l)
    {
        if ($this->collLefRuls === null) {
            $this->initLefRuls();
            $this->collLefRulsPartial = true;
        }
        if (!in_array($l, $this->collLefRuls->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddLefRul($l);
        }

        return $this;
    }

    /**
     * @param	LefRul $lefRul The lefRul object to add.
     */
    protected function doAddLefRul($lefRul)
    {
        $this->collLefRuls[]= $lefRul;
        $lefRul->setRule($this);
    }

    /**
     * @param	LefRul $lefRul The lefRul object to remove.
     * @return Rule The current object (for fluent API support)
     */
    public function removeLefRul($lefRul)
    {
        if ($this->getLefRuls()->contains($lefRul)) {
            $this->collLefRuls->remove($this->collLefRuls->search($lefRul));
            if (null === $this->lefRulsScheduledForDeletion) {
                $this->lefRulsScheduledForDeletion = clone $this->collLefRuls;
                $this->lefRulsScheduledForDeletion->clear();
            }
            $this->lefRulsScheduledForDeletion[]= clone $lefRul;
            $lefRul->setRule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Rule is new, it will return
     * an empty collection; or if this Rule has previously
     * been saved, it will retrieve related LefRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Rule.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     */
    public function getLefRulsJoinLeaf($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LefRulQuery::create(null, $criteria);
        $query->joinWith('Leaf', $join_behavior);

        return $this->getLefRuls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Rule is new, it will return
     * an empty collection; or if this Rule has previously
     * been saved, it will retrieve related LefRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Rule.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     */
    public function getLefRulsJoinUserRelatedByCreatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LefRulQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCreatedBy', $join_behavior);

        return $this->getLefRuls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Rule is new, it will return
     * an empty collection; or if this Rule has previously
     * been saved, it will retrieve related LefRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Rule.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     */
    public function getLefRulsJoinUserRelatedByUpdatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LefRulQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUpdatedBy', $join_behavior);

        return $this->getLefRuls($query, $con);
    }

    /**
     * Clears out the collRulOptions collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Rule The current object (for fluent API support)
     * @see        addRulOptions()
     */
    public function clearRulOptions()
    {
        $this->collRulOptions = null; // important to set this to null since that means it is uninitialized
        $this->collRulOptionsPartial = null;

        return $this;
    }

    /**
     * reset is the collRulOptions collection loaded partially
     *
     * @return void
     */
    public function resetPartialRulOptions($v = true)
    {
        $this->collRulOptionsPartial = $v;
    }

    /**
     * Initializes the collRulOptions collection.
     *
     * By default this just sets the collRulOptions collection to an empty array (like clearcollRulOptions());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initRulOptions($overrideExisting = true)
    {
        if (null !== $this->collRulOptions && !$overrideExisting) {
            return;
        }
        $this->collRulOptions = new PropelObjectCollection();
        $this->collRulOptions->setModel('RulOption');
    }

    /**
     * Gets an array of RulOption objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Rule is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|RulOption[] List of RulOption objects
     * @throws PropelException
     */
    public function getRulOptions($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collRulOptionsPartial && !$this->isNew();
        if (null === $this->collRulOptions || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collRulOptions) {
                // return empty collection
                $this->initRulOptions();
            } else {
                $collRulOptions = RulOptionQuery::create(null, $criteria)
                    ->filterByRule($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collRulOptionsPartial && count($collRulOptions)) {
                      $this->initRulOptions(false);

                      foreach($collRulOptions as $obj) {
                        if (false == $this->collRulOptions->contains($obj)) {
                          $this->collRulOptions->append($obj);
                        }
                      }

                      $this->collRulOptionsPartial = true;
                    }

                    $collRulOptions->getInternalIterator()->rewind();
                    return $collRulOptions;
                }

                if($partial && $this->collRulOptions) {
                    foreach($this->collRulOptions as $obj) {
                        if($obj->isNew()) {
                            $collRulOptions[] = $obj;
                        }
                    }
                }

                $this->collRulOptions = $collRulOptions;
                $this->collRulOptionsPartial = false;
            }
        }

        return $this->collRulOptions;
    }

    /**
     * Sets a collection of RulOption objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $rulOptions A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Rule The current object (for fluent API support)
     */
    public function setRulOptions(PropelCollection $rulOptions, PropelPDO $con = null)
    {
        $rulOptionsToDelete = $this->getRulOptions(new Criteria(), $con)->diff($rulOptions);

        $this->rulOptionsScheduledForDeletion = unserialize(serialize($rulOptionsToDelete));

        foreach ($rulOptionsToDelete as $rulOptionRemoved) {
            $rulOptionRemoved->setRule(null);
        }

        $this->collRulOptions = null;
        foreach ($rulOptions as $rulOption) {
            $this->addRulOption($rulOption);
        }

        $this->collRulOptions = $rulOptions;
        $this->collRulOptionsPartial = false;

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
    public function countRulOptions(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collRulOptionsPartial && !$this->isNew();
        if (null === $this->collRulOptions || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collRulOptions) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getRulOptions());
            }
            $query = RulOptionQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByRule($this)
                ->count($con);
        }

        return count($this->collRulOptions);
    }

    /**
     * Method called to associate a RulOption object to this object
     * through the RulOption foreign key attribute.
     *
     * @param    RulOption $l RulOption
     * @return Rule The current object (for fluent API support)
     */
    public function addRulOption(RulOption $l)
    {
        if ($this->collRulOptions === null) {
            $this->initRulOptions();
            $this->collRulOptionsPartial = true;
        }
        if (!in_array($l, $this->collRulOptions->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddRulOption($l);
        }

        return $this;
    }

    /**
     * @param	RulOption $rulOption The rulOption object to add.
     */
    protected function doAddRulOption($rulOption)
    {
        $this->collRulOptions[]= $rulOption;
        $rulOption->setRule($this);
    }

    /**
     * @param	RulOption $rulOption The rulOption object to remove.
     * @return Rule The current object (for fluent API support)
     */
    public function removeRulOption($rulOption)
    {
        if ($this->getRulOptions()->contains($rulOption)) {
            $this->collRulOptions->remove($this->collRulOptions->search($rulOption));
            if (null === $this->rulOptionsScheduledForDeletion) {
                $this->rulOptionsScheduledForDeletion = clone $this->collRulOptions;
                $this->rulOptionsScheduledForDeletion->clear();
            }
            $this->rulOptionsScheduledForDeletion[]= $rulOption;
            $rulOption->setRule(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Rule is new, it will return
     * an empty collection; or if this Rule has previously
     * been saved, it will retrieve related RulOptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Rule.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|RulOption[] List of RulOption objects
     */
    public function getRulOptionsJoinUserRelatedByCreatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RulOptionQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCreatedBy', $join_behavior);

        return $this->getRulOptions($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Rule is new, it will return
     * an empty collection; or if this Rule has previously
     * been saved, it will retrieve related RulOptions from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Rule.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|RulOption[] List of RulOption objects
     */
    public function getRulOptionsJoinUserRelatedByUpdatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = RulOptionQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUpdatedBy', $join_behavior);

        return $this->getRulOptions($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->rul_name = null;
        $this->rul_desc = null;
        $this->rul_actif = null;
        $this->tru_id = null;
        $this->created_by = null;
        $this->updated_by = null;
        $this->created_at = null;
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
            if ($this->collBchRuls) {
                foreach ($this->collBchRuls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collLefRuls) {
                foreach ($this->collLefRuls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collRulOptions) {
                foreach ($this->collRulOptions as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->aTypeRule instanceof Persistent) {
              $this->aTypeRule->clearAllReferences($deep);
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
        if ($this->collLefRuls instanceof PropelCollection) {
            $this->collLefRuls->clearIterator();
        }
        $this->collLefRuls = null;
        if ($this->collRulOptions instanceof PropelCollection) {
            $this->collRulOptions->clearIterator();
        }
        $this->collRulOptions = null;
        $this->aTypeRule = null;
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
        return (string) $this->exportTo(RulePeer::DEFAULT_STRING_FORMAT);
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

    // timestampable behavior

    /**
     * Mark the current object so that the update date doesn't get updated during next save
     *
     * @return     Rule The current object (for fluent API support)
     */
    public function keepUpdateDateUnchanged()
    {
        $this->modifiedColumns[] = RulePeer::UPDATED_AT;

        return $this;
    }

}

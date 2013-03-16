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
use Kzf\Model\Leaf;
use Kzf\Model\LeafPeer;
use Kzf\Model\LeafQuery;
use Kzf\Model\LefRul;
use Kzf\Model\LefRulQuery;
use Kzf\Model\NodeTree;
use Kzf\Model\NodeTreeQuery;
use Kzf\Model\User;
use Kzf\Model\UserQuery;

/**
 * Base class that represents a row from the 'leaf' table.
 *
 *
 *
 * @package    propel.generator.model.om
 */
abstract class BaseLeaf extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Kzf\\Model\\LeafPeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        LeafPeer
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
     * The value for the lef_title field.
     * @var        string
     */
    protected $lef_title;

    /**
     * The value for the lef_active field.
     * @var        boolean
     */
    protected $lef_active;

    /**
     * The value for the lef_published_at field.
     * @var        string
     */
    protected $lef_published_at;

    /**
     * The value for the lef_content field.
     * @var        resource
     */
    protected $lef_content;

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
     * @var        PropelObjectCollection|LefRul[] Collection to store aggregation of LefRul objects.
     */
    protected $collLefRuls;
    protected $collLefRulsPartial;

    /**
     * @var        PropelObjectCollection|NodeTree[] Collection to store aggregation of NodeTree objects.
     */
    protected $collNodeTrees;
    protected $collNodeTreesPartial;

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
    protected $lefRulsScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var		PropelObjectCollection
     */
    protected $nodeTreesScheduledForDeletion = null;

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
     * Get the [lef_title] column value.
     *
     * @return string
     */
    public function getLefTitle()
    {
        return $this->lef_title;
    }

    /**
     * Get the [lef_active] column value.
     *
     * @return boolean
     */
    public function getLefActive()
    {
        return $this->lef_active;
    }

    /**
     * Get the [optionally formatted] temporal [lef_published_at] column value.
     *
     *
     * @param string $format The date/time format string (either date()-style or strftime()-style).
     *				 If format is null, then the raw DateTime object will be returned.
     * @return mixed Formatted date/time value as string or DateTime object (if format is null), null if column is null, and 0 if column value is 0000-00-00 00:00:00
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLefPublishedAt($format = 'Y-m-d H:i:s')
    {
        if ($this->lef_published_at === null) {
            return null;
        }

        if ($this->lef_published_at === '0000-00-00 00:00:00') {
            // while technically this is not a default value of null,
            // this seems to be closest in meaning.
            return null;
        }

        try {
            $dt = new DateTime($this->lef_published_at);
        } catch (Exception $x) {
            throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->lef_published_at, true), $x);
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
     * Get the [lef_content] column value.
     *
     * @return resource
     */
    public function getLefContent()
    {
        return $this->lef_content;
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
     * @return Leaf The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = LeafPeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [lef_title] column.
     *
     * @param string $v new value
     * @return Leaf The current object (for fluent API support)
     */
    public function setLefTitle($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->lef_title !== $v) {
            $this->lef_title = $v;
            $this->modifiedColumns[] = LeafPeer::LEF_TITLE;
        }


        return $this;
    } // setLefTitle()

    /**
     * Sets the value of the [lef_active] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return Leaf The current object (for fluent API support)
     */
    public function setLefActive($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->lef_active !== $v) {
            $this->lef_active = $v;
            $this->modifiedColumns[] = LeafPeer::LEF_ACTIVE;
        }


        return $this;
    } // setLefActive()

    /**
     * Sets the value of [lef_published_at] column to a normalized version of the date/time value specified.
     *
     * @param mixed $v string, integer (timestamp), or DateTime value.
     *               Empty strings are treated as null.
     * @return Leaf The current object (for fluent API support)
     */
    public function setLefPublishedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->lef_published_at !== null || $dt !== null) {
            $currentDateAsString = ($this->lef_published_at !== null && $tmpDt = new DateTime($this->lef_published_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->lef_published_at = $newDateAsString;
                $this->modifiedColumns[] = LeafPeer::LEF_PUBLISHED_AT;
            }
        } // if either are not null


        return $this;
    } // setLefPublishedAt()

    /**
     * Set the value of [lef_content] column.
     *
     * @param resource $v new value
     * @return Leaf The current object (for fluent API support)
     */
    public function setLefContent($v)
    {
        // Because BLOB columns are streams in PDO we have to assume that they are
        // always modified when a new value is passed in.  For example, the contents
        // of the stream itself may have changed externally.
        if (!is_resource($v) && $v !== null) {
            $this->lef_content = fopen('php://memory', 'r+');
            fwrite($this->lef_content, $v);
            rewind($this->lef_content);
        } else { // it's already a stream
            $this->lef_content = $v;
        }
        $this->modifiedColumns[] = LeafPeer::LEF_CONTENT;


        return $this;
    } // setLefContent()

    /**
     * Set the value of [created_by] column.
     *
     * @param int $v new value
     * @return Leaf The current object (for fluent API support)
     */
    public function setCreatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->created_by !== $v) {
            $this->created_by = $v;
            $this->modifiedColumns[] = LeafPeer::CREATED_BY;
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
     * @return Leaf The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = LeafPeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Set the value of [updated_by] column.
     *
     * @param int $v new value
     * @return Leaf The current object (for fluent API support)
     */
    public function setUpdatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->updated_by !== $v) {
            $this->updated_by = $v;
            $this->modifiedColumns[] = LeafPeer::UPDATED_BY;
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
     * @return Leaf The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = LeafPeer::UPDATED_AT;
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
            $this->lef_title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
            $this->lef_active = ($row[$startcol + 2] !== null) ? (boolean) $row[$startcol + 2] : null;
            $this->lef_published_at = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
            if ($row[$startcol + 4] !== null) {
                $this->lef_content = fopen('php://memory', 'r+');
                fwrite($this->lef_content, $row[$startcol + 4]);
                rewind($this->lef_content);
            } else {
                $this->lef_content = null;
            }
            $this->created_by = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->created_at = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->updated_by = ($row[$startcol + 7] !== null) ? (int) $row[$startcol + 7] : null;
            $this->updated_at = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 9; // 9 = LeafPeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating Leaf object", $e);
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
            $con = Propel::getConnection(LeafPeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = LeafPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRelatedByCreatedBy = null;
            $this->aUserRelatedByUpdatedBy = null;
            $this->collLefRuls = null;

            $this->collNodeTrees = null;

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
            $con = Propel::getConnection(LeafPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = LeafQuery::create()
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
            $con = Propel::getConnection(LeafPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                LeafPeer::addInstanceToPool($this);
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
                // Rewind the lef_content LOB column, since PDO does not rewind after inserting value.
                if ($this->lef_content !== null && is_resource($this->lef_content)) {
                    rewind($this->lef_content);
                }

                $this->resetModified();
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

            if ($this->nodeTreesScheduledForDeletion !== null) {
                if (!$this->nodeTreesScheduledForDeletion->isEmpty()) {
                    foreach ($this->nodeTreesScheduledForDeletion as $nodeTree) {
                        // need to save related object because we set the relation to null
                        $nodeTree->save($con);
                    }
                    $this->nodeTreesScheduledForDeletion = null;
                }
            }

            if ($this->collNodeTrees !== null) {
                foreach ($this->collNodeTrees as $referrerFK) {
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

        $this->modifiedColumns[] = LeafPeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . LeafPeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(LeafPeer::ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(LeafPeer::LEF_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'lef_title';
        }
        if ($this->isColumnModified(LeafPeer::LEF_ACTIVE)) {
            $modifiedColumns[':p' . $index++]  = 'lef_active';
        }
        if ($this->isColumnModified(LeafPeer::LEF_PUBLISHED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'lef_published_at';
        }
        if ($this->isColumnModified(LeafPeer::LEF_CONTENT)) {
            $modifiedColumns[':p' . $index++]  = 'lef_content';
        }
        if ($this->isColumnModified(LeafPeer::CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'created_by';
        }
        if ($this->isColumnModified(LeafPeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(LeafPeer::UPDATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'updated_by';
        }
        if ($this->isColumnModified(LeafPeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO leaf (%s) VALUES (%s)',
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
                    case 'lef_title':
                        $stmt->bindValue($identifier, $this->lef_title, PDO::PARAM_STR);
                        break;
                    case 'lef_active':
                        $stmt->bindValue($identifier, (int) $this->lef_active, PDO::PARAM_INT);
                        break;
                    case 'lef_published_at':
                        $stmt->bindValue($identifier, $this->lef_published_at, PDO::PARAM_STR);
                        break;
                    case 'lef_content':
                        if (is_resource($this->lef_content)) {
                            rewind($this->lef_content);
                        }
                        $stmt->bindValue($identifier, $this->lef_content, PDO::PARAM_LOB);
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


            if (($retval = LeafPeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
            }


                if ($this->collLefRuls !== null) {
                    foreach ($this->collLefRuls as $referrerFK) {
                        if (!$referrerFK->validate($columns)) {
                            $failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
                        }
                    }
                }

                if ($this->collNodeTrees !== null) {
                    foreach ($this->collNodeTrees as $referrerFK) {
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
        $pos = LeafPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getLefTitle();
                break;
            case 2:
                return $this->getLefActive();
                break;
            case 3:
                return $this->getLefPublishedAt();
                break;
            case 4:
                return $this->getLefContent();
                break;
            case 5:
                return $this->getCreatedBy();
                break;
            case 6:
                return $this->getCreatedAt();
                break;
            case 7:
                return $this->getUpdatedBy();
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
        if (isset($alreadyDumpedObjects['Leaf'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Leaf'][$this->getPrimaryKey()] = true;
        $keys = LeafPeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getLefTitle(),
            $keys[2] => $this->getLefActive(),
            $keys[3] => $this->getLefPublishedAt(),
            $keys[4] => $this->getLefContent(),
            $keys[5] => $this->getCreatedBy(),
            $keys[6] => $this->getCreatedAt(),
            $keys[7] => $this->getUpdatedBy(),
            $keys[8] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aUserRelatedByCreatedBy) {
                $result['UserRelatedByCreatedBy'] = $this->aUserRelatedByCreatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUpdatedBy) {
                $result['UserRelatedByUpdatedBy'] = $this->aUserRelatedByUpdatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collLefRuls) {
                $result['LefRuls'] = $this->collLefRuls->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collNodeTrees) {
                $result['NodeTrees'] = $this->collNodeTrees->toArray(null, true, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
        $pos = LeafPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setLefTitle($value);
                break;
            case 2:
                $this->setLefActive($value);
                break;
            case 3:
                $this->setLefPublishedAt($value);
                break;
            case 4:
                $this->setLefContent($value);
                break;
            case 5:
                $this->setCreatedBy($value);
                break;
            case 6:
                $this->setCreatedAt($value);
                break;
            case 7:
                $this->setUpdatedBy($value);
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
        $keys = LeafPeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setLefTitle($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setLefActive($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setLefPublishedAt($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setLefContent($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setCreatedBy($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setCreatedAt($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setUpdatedBy($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(LeafPeer::DATABASE_NAME);

        if ($this->isColumnModified(LeafPeer::ID)) $criteria->add(LeafPeer::ID, $this->id);
        if ($this->isColumnModified(LeafPeer::LEF_TITLE)) $criteria->add(LeafPeer::LEF_TITLE, $this->lef_title);
        if ($this->isColumnModified(LeafPeer::LEF_ACTIVE)) $criteria->add(LeafPeer::LEF_ACTIVE, $this->lef_active);
        if ($this->isColumnModified(LeafPeer::LEF_PUBLISHED_AT)) $criteria->add(LeafPeer::LEF_PUBLISHED_AT, $this->lef_published_at);
        if ($this->isColumnModified(LeafPeer::LEF_CONTENT)) $criteria->add(LeafPeer::LEF_CONTENT, $this->lef_content);
        if ($this->isColumnModified(LeafPeer::CREATED_BY)) $criteria->add(LeafPeer::CREATED_BY, $this->created_by);
        if ($this->isColumnModified(LeafPeer::CREATED_AT)) $criteria->add(LeafPeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(LeafPeer::UPDATED_BY)) $criteria->add(LeafPeer::UPDATED_BY, $this->updated_by);
        if ($this->isColumnModified(LeafPeer::UPDATED_AT)) $criteria->add(LeafPeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(LeafPeer::DATABASE_NAME);
        $criteria->add(LeafPeer::ID, $this->id);

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
     * @param object $copyObj An object of Leaf (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLefTitle($this->getLefTitle());
        $copyObj->setLefActive($this->getLefActive());
        $copyObj->setLefPublishedAt($this->getLefPublishedAt());
        $copyObj->setLefContent($this->getLefContent());
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

            foreach ($this->getLefRuls() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addLefRul($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getNodeTrees() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addNodeTree($relObj->copy($deepCopy));
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
     * @return Leaf Clone of current object.
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
     * @return LeafPeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new LeafPeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Leaf The current object (for fluent API support)
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
            $v->addLeafRelatedByCreatedBy($this);
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
                $this->aUserRelatedByCreatedBy->addLeafsRelatedByCreatedBy($this);
             */
        }

        return $this->aUserRelatedByCreatedBy;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return Leaf The current object (for fluent API support)
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
            $v->addLeafRelatedByUpdatedBy($this);
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
                $this->aUserRelatedByUpdatedBy->addLeafsRelatedByUpdatedBy($this);
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
        if ('LefRul' == $relationName) {
            $this->initLefRuls();
        }
        if ('NodeTree' == $relationName) {
            $this->initNodeTrees();
        }
    }

    /**
     * Clears out the collLefRuls collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Leaf The current object (for fluent API support)
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
     * If this Leaf is new, it will return
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
                    ->filterByLeaf($this)
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
     * @return Leaf The current object (for fluent API support)
     */
    public function setLefRuls(PropelCollection $lefRuls, PropelPDO $con = null)
    {
        $lefRulsToDelete = $this->getLefRuls(new Criteria(), $con)->diff($lefRuls);

        $this->lefRulsScheduledForDeletion = unserialize(serialize($lefRulsToDelete));

        foreach ($lefRulsToDelete as $lefRulRemoved) {
            $lefRulRemoved->setLeaf(null);
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
                ->filterByLeaf($this)
                ->count($con);
        }

        return count($this->collLefRuls);
    }

    /**
     * Method called to associate a LefRul object to this object
     * through the LefRul foreign key attribute.
     *
     * @param    LefRul $l LefRul
     * @return Leaf The current object (for fluent API support)
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
        $lefRul->setLeaf($this);
    }

    /**
     * @param	LefRul $lefRul The lefRul object to remove.
     * @return Leaf The current object (for fluent API support)
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
            $lefRul->setLeaf(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Leaf is new, it will return
     * an empty collection; or if this Leaf has previously
     * been saved, it will retrieve related LefRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Leaf.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|LefRul[] List of LefRul objects
     */
    public function getLefRulsJoinRule($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = LefRulQuery::create(null, $criteria);
        $query->joinWith('Rule', $join_behavior);

        return $this->getLefRuls($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Leaf is new, it will return
     * an empty collection; or if this Leaf has previously
     * been saved, it will retrieve related LefRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Leaf.
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
     * Otherwise if this Leaf is new, it will return
     * an empty collection; or if this Leaf has previously
     * been saved, it will retrieve related LefRuls from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Leaf.
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
     * Clears out the collNodeTrees collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return Leaf The current object (for fluent API support)
     * @see        addNodeTrees()
     */
    public function clearNodeTrees()
    {
        $this->collNodeTrees = null; // important to set this to null since that means it is uninitialized
        $this->collNodeTreesPartial = null;

        return $this;
    }

    /**
     * reset is the collNodeTrees collection loaded partially
     *
     * @return void
     */
    public function resetPartialNodeTrees($v = true)
    {
        $this->collNodeTreesPartial = $v;
    }

    /**
     * Initializes the collNodeTrees collection.
     *
     * By default this just sets the collNodeTrees collection to an empty array (like clearcollNodeTrees());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initNodeTrees($overrideExisting = true)
    {
        if (null !== $this->collNodeTrees && !$overrideExisting) {
            return;
        }
        $this->collNodeTrees = new PropelObjectCollection();
        $this->collNodeTrees->setModel('NodeTree');
    }

    /**
     * Gets an array of NodeTree objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this Leaf is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     * @throws PropelException
     */
    public function getNodeTrees($criteria = null, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesPartial && !$this->isNew();
        if (null === $this->collNodeTrees || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collNodeTrees) {
                // return empty collection
                $this->initNodeTrees();
            } else {
                $collNodeTrees = NodeTreeQuery::create(null, $criteria)
                    ->filterByLeaf($this)
                    ->find($con);
                if (null !== $criteria) {
                    if (false !== $this->collNodeTreesPartial && count($collNodeTrees)) {
                      $this->initNodeTrees(false);

                      foreach($collNodeTrees as $obj) {
                        if (false == $this->collNodeTrees->contains($obj)) {
                          $this->collNodeTrees->append($obj);
                        }
                      }

                      $this->collNodeTreesPartial = true;
                    }

                    $collNodeTrees->getInternalIterator()->rewind();
                    return $collNodeTrees;
                }

                if($partial && $this->collNodeTrees) {
                    foreach($this->collNodeTrees as $obj) {
                        if($obj->isNew()) {
                            $collNodeTrees[] = $obj;
                        }
                    }
                }

                $this->collNodeTrees = $collNodeTrees;
                $this->collNodeTreesPartial = false;
            }
        }

        return $this->collNodeTrees;
    }

    /**
     * Sets a collection of NodeTree objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param PropelCollection $nodeTrees A Propel collection.
     * @param PropelPDO $con Optional connection object
     * @return Leaf The current object (for fluent API support)
     */
    public function setNodeTrees(PropelCollection $nodeTrees, PropelPDO $con = null)
    {
        $nodeTreesToDelete = $this->getNodeTrees(new Criteria(), $con)->diff($nodeTrees);

        $this->nodeTreesScheduledForDeletion = unserialize(serialize($nodeTreesToDelete));

        foreach ($nodeTreesToDelete as $nodeTreeRemoved) {
            $nodeTreeRemoved->setLeaf(null);
        }

        $this->collNodeTrees = null;
        foreach ($nodeTrees as $nodeTree) {
            $this->addNodeTree($nodeTree);
        }

        $this->collNodeTrees = $nodeTrees;
        $this->collNodeTreesPartial = false;

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
    public function countNodeTrees(Criteria $criteria = null, $distinct = false, PropelPDO $con = null)
    {
        $partial = $this->collNodeTreesPartial && !$this->isNew();
        if (null === $this->collNodeTrees || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collNodeTrees) {
                return 0;
            }

            if($partial && !$criteria) {
                return count($this->getNodeTrees());
            }
            $query = NodeTreeQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByLeaf($this)
                ->count($con);
        }

        return count($this->collNodeTrees);
    }

    /**
     * Method called to associate a NodeTree object to this object
     * through the NodeTree foreign key attribute.
     *
     * @param    NodeTree $l NodeTree
     * @return Leaf The current object (for fluent API support)
     */
    public function addNodeTree(NodeTree $l)
    {
        if ($this->collNodeTrees === null) {
            $this->initNodeTrees();
            $this->collNodeTreesPartial = true;
        }
        if (!in_array($l, $this->collNodeTrees->getArrayCopy(), true)) { // only add it if the **same** object is not already associated
            $this->doAddNodeTree($l);
        }

        return $this;
    }

    /**
     * @param	NodeTree $nodeTree The nodeTree object to add.
     */
    protected function doAddNodeTree($nodeTree)
    {
        $this->collNodeTrees[]= $nodeTree;
        $nodeTree->setLeaf($this);
    }

    /**
     * @param	NodeTree $nodeTree The nodeTree object to remove.
     * @return Leaf The current object (for fluent API support)
     */
    public function removeNodeTree($nodeTree)
    {
        if ($this->getNodeTrees()->contains($nodeTree)) {
            $this->collNodeTrees->remove($this->collNodeTrees->search($nodeTree));
            if (null === $this->nodeTreesScheduledForDeletion) {
                $this->nodeTreesScheduledForDeletion = clone $this->collNodeTrees;
                $this->nodeTreesScheduledForDeletion->clear();
            }
            $this->nodeTreesScheduledForDeletion[]= $nodeTree;
            $nodeTree->setLeaf(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Leaf is new, it will return
     * an empty collection; or if this Leaf has previously
     * been saved, it will retrieve related NodeTrees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Leaf.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesJoinUserRelatedByCreatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByCreatedBy', $join_behavior);

        return $this->getNodeTrees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Leaf is new, it will return
     * an empty collection; or if this Leaf has previously
     * been saved, it will retrieve related NodeTrees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Leaf.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesJoinUserRelatedByUpdatedBy($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('UserRelatedByUpdatedBy', $join_behavior);

        return $this->getNodeTrees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Leaf is new, it will return
     * an empty collection; or if this Leaf has previously
     * been saved, it will retrieve related NodeTrees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Leaf.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesJoinBranchRelatedByBchId($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('BranchRelatedByBchId', $join_behavior);

        return $this->getNodeTrees($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Leaf is new, it will return
     * an empty collection; or if this Leaf has previously
     * been saved, it will retrieve related NodeTrees from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Leaf.
     *
     * @param Criteria $criteria optional Criteria object to narrow the query
     * @param PropelPDO $con optional connection object
     * @param string $join_behavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return PropelObjectCollection|NodeTree[] List of NodeTree objects
     */
    public function getNodeTreesJoinBranchRelatedByBchParent($criteria = null, $con = null, $join_behavior = Criteria::LEFT_JOIN)
    {
        $query = NodeTreeQuery::create(null, $criteria);
        $query->joinWith('BranchRelatedByBchParent', $join_behavior);

        return $this->getNodeTrees($query, $con);
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->lef_title = null;
        $this->lef_active = null;
        $this->lef_published_at = null;
        $this->lef_content = null;
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
            if ($this->collLefRuls) {
                foreach ($this->collLefRuls as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collNodeTrees) {
                foreach ($this->collNodeTrees as $o) {
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

        if ($this->collLefRuls instanceof PropelCollection) {
            $this->collLefRuls->clearIterator();
        }
        $this->collLefRuls = null;
        if ($this->collNodeTrees instanceof PropelCollection) {
            $this->collNodeTrees->clearIterator();
        }
        $this->collNodeTrees = null;
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
        return (string) $this->exportTo(LeafPeer::DEFAULT_STRING_FORMAT);
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

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
use \PropelDateTime;
use \PropelException;
use \PropelPDO;
use Kzf\Model\Branch;
use Kzf\Model\BranchQuery;
use Kzf\Model\Leaf;
use Kzf\Model\LeafQuery;
use Kzf\Model\NodeTree;
use Kzf\Model\NodeTreePeer;
use Kzf\Model\NodeTreeQuery;
use Kzf\Model\User;
use Kzf\Model\UserQuery;

/**
 * Base class that represents a row from the 'node_tree' table.
 *
 *
 *
 * @package    propel.generator.model.om
 */
abstract class BaseNodeTree extends BaseObject implements Persistent
{
    /**
     * Peer class name
     */
    const PEER = 'Kzf\\Model\\NodeTreePeer';

    /**
     * The Peer class.
     * Instance provides a convenient way of calling static methods on a class
     * that calling code may not be able to identify.
     * @var        NodeTreePeer
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
     * The value for the ndt_id field.
     * @var        int
     */
    protected $ndt_id;

    /**
     * The value for the ndt_position field.
     * @var        int
     */
    protected $ndt_position;

    /**
     * The value for the ndt_left field.
     * @var        int
     */
    protected $ndt_left;

    /**
     * The value for the ndt_right field.
     * @var        int
     */
    protected $ndt_right;

    /**
     * The value for the ndt_level field.
     * @var        int
     */
    protected $ndt_level;

    /**
     * The value for the ndt_title field.
     * @var        string
     */
    protected $ndt_title;

    /**
     * The value for the ndt_type field.
     * @var        string
     */
    protected $ndt_type;

    /**
     * The value for the ndt_cloud field.
     * @var        boolean
     */
    protected $ndt_cloud;

    /**
     * The value for the ndt_virtual field.
     * @var        boolean
     */
    protected $ndt_virtual;

    /**
     * The value for the bch_id field.
     * @var        int
     */
    protected $bch_id;

    /**
     * The value for the bch_parent field.
     * @var        int
     */
    protected $bch_parent;

    /**
     * The value for the lef_id field.
     * @var        int
     */
    protected $lef_id;

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
     * @var        Leaf
     */
    protected $aLeaf;

    /**
     * @var        Branch
     */
    protected $aBranchRelatedByBchId;

    /**
     * @var        Branch
     */
    protected $aBranchRelatedByBchParent;

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
     * Get the [id] column value.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [ndt_id] column value.
     *
     * @return int
     */
    public function getNdtId()
    {
        return $this->ndt_id;
    }

    /**
     * Get the [ndt_position] column value.
     *
     * @return int
     */
    public function getNdtPosition()
    {
        return $this->ndt_position;
    }

    /**
     * Get the [ndt_left] column value.
     *
     * @return int
     */
    public function getNdtLeft()
    {
        return $this->ndt_left;
    }

    /**
     * Get the [ndt_right] column value.
     *
     * @return int
     */
    public function getNdtRight()
    {
        return $this->ndt_right;
    }

    /**
     * Get the [ndt_level] column value.
     *
     * @return int
     */
    public function getNdtLevel()
    {
        return $this->ndt_level;
    }

    /**
     * Get the [ndt_title] column value.
     *
     * @return string
     */
    public function getNdtTitle()
    {
        return $this->ndt_title;
    }

    /**
     * Get the [ndt_type] column value.
     *
     * @return string
     */
    public function getNdtType()
    {
        return $this->ndt_type;
    }

    /**
     * Get the [ndt_cloud] column value.
     *
     * @return boolean
     */
    public function getNdtCloud()
    {
        return $this->ndt_cloud;
    }

    /**
     * Get the [ndt_virtual] column value.
     *
     * @return boolean
     */
    public function getNdtVirtual()
    {
        return $this->ndt_virtual;
    }

    /**
     * Get the [bch_id] column value.
     *
     * @return int
     */
    public function getBchId()
    {
        return $this->bch_id;
    }

    /**
     * Get the [bch_parent] column value.
     *
     * @return int
     */
    public function getBchParent()
    {
        return $this->bch_parent;
    }

    /**
     * Get the [lef_id] column value.
     *
     * @return int
     */
    public function getLefId()
    {
        return $this->lef_id;
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
     * @return NodeTree The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[] = NodeTreePeer::ID;
        }


        return $this;
    } // setId()

    /**
     * Set the value of [ndt_id] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->ndt_id !== $v) {
            $this->ndt_id = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_ID;
        }


        return $this;
    } // setNdtId()

    /**
     * Set the value of [ndt_position] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtPosition($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->ndt_position !== $v) {
            $this->ndt_position = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_POSITION;
        }


        return $this;
    } // setNdtPosition()

    /**
     * Set the value of [ndt_left] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtLeft($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->ndt_left !== $v) {
            $this->ndt_left = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_LEFT;
        }


        return $this;
    } // setNdtLeft()

    /**
     * Set the value of [ndt_right] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtRight($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->ndt_right !== $v) {
            $this->ndt_right = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_RIGHT;
        }


        return $this;
    } // setNdtRight()

    /**
     * Set the value of [ndt_level] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtLevel($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->ndt_level !== $v) {
            $this->ndt_level = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_LEVEL;
        }


        return $this;
    } // setNdtLevel()

    /**
     * Set the value of [ndt_title] column.
     *
     * @param string $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtTitle($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ndt_title !== $v) {
            $this->ndt_title = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_TITLE;
        }


        return $this;
    } // setNdtTitle()

    /**
     * Set the value of [ndt_type] column.
     *
     * @param string $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtType($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (string) $v;
        }

        if ($this->ndt_type !== $v) {
            $this->ndt_type = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_TYPE;
        }


        return $this;
    } // setNdtType()

    /**
     * Sets the value of the [ndt_cloud] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtCloud($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->ndt_cloud !== $v) {
            $this->ndt_cloud = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_CLOUD;
        }


        return $this;
    } // setNdtCloud()

    /**
     * Sets the value of the [ndt_virtual] column.
     * Non-boolean arguments are converted using the following rules:
     *   * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *   * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     * Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     *
     * @param boolean|integer|string $v The new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setNdtVirtual($v)
    {
        if ($v !== null) {
            if (is_string($v)) {
                $v = in_array(strtolower($v), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
            } else {
                $v = (boolean) $v;
            }
        }

        if ($this->ndt_virtual !== $v) {
            $this->ndt_virtual = $v;
            $this->modifiedColumns[] = NodeTreePeer::NDT_VIRTUAL;
        }


        return $this;
    } // setNdtVirtual()

    /**
     * Set the value of [bch_id] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setBchId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->bch_id !== $v) {
            $this->bch_id = $v;
            $this->modifiedColumns[] = NodeTreePeer::BCH_ID;
        }

        if ($this->aBranchRelatedByBchId !== null && $this->aBranchRelatedByBchId->getId() !== $v) {
            $this->aBranchRelatedByBchId = null;
        }


        return $this;
    } // setBchId()

    /**
     * Set the value of [bch_parent] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setBchParent($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->bch_parent !== $v) {
            $this->bch_parent = $v;
            $this->modifiedColumns[] = NodeTreePeer::BCH_PARENT;
        }

        if ($this->aBranchRelatedByBchParent !== null && $this->aBranchRelatedByBchParent->getId() !== $v) {
            $this->aBranchRelatedByBchParent = null;
        }


        return $this;
    } // setBchParent()

    /**
     * Set the value of [lef_id] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setLefId($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->lef_id !== $v) {
            $this->lef_id = $v;
            $this->modifiedColumns[] = NodeTreePeer::LEF_ID;
        }

        if ($this->aLeaf !== null && $this->aLeaf->getId() !== $v) {
            $this->aLeaf = null;
        }


        return $this;
    } // setLefId()

    /**
     * Set the value of [created_by] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setCreatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->created_by !== $v) {
            $this->created_by = $v;
            $this->modifiedColumns[] = NodeTreePeer::CREATED_BY;
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
     * @return NodeTree The current object (for fluent API support)
     */
    public function setCreatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->created_at !== null || $dt !== null) {
            $currentDateAsString = ($this->created_at !== null && $tmpDt = new DateTime($this->created_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->created_at = $newDateAsString;
                $this->modifiedColumns[] = NodeTreePeer::CREATED_AT;
            }
        } // if either are not null


        return $this;
    } // setCreatedAt()

    /**
     * Set the value of [updated_by] column.
     *
     * @param int $v new value
     * @return NodeTree The current object (for fluent API support)
     */
    public function setUpdatedBy($v)
    {
        if ($v !== null && is_numeric($v)) {
            $v = (int) $v;
        }

        if ($this->updated_by !== $v) {
            $this->updated_by = $v;
            $this->modifiedColumns[] = NodeTreePeer::UPDATED_BY;
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
     * @return NodeTree The current object (for fluent API support)
     */
    public function setUpdatedAt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->updated_at !== null || $dt !== null) {
            $currentDateAsString = ($this->updated_at !== null && $tmpDt = new DateTime($this->updated_at)) ? $tmpDt->format('Y-m-d H:i:s') : null;
            $newDateAsString = $dt ? $dt->format('Y-m-d H:i:s') : null;
            if ($currentDateAsString !== $newDateAsString) {
                $this->updated_at = $newDateAsString;
                $this->modifiedColumns[] = NodeTreePeer::UPDATED_AT;
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
            $this->ndt_id = ($row[$startcol + 1] !== null) ? (int) $row[$startcol + 1] : null;
            $this->ndt_position = ($row[$startcol + 2] !== null) ? (int) $row[$startcol + 2] : null;
            $this->ndt_left = ($row[$startcol + 3] !== null) ? (int) $row[$startcol + 3] : null;
            $this->ndt_right = ($row[$startcol + 4] !== null) ? (int) $row[$startcol + 4] : null;
            $this->ndt_level = ($row[$startcol + 5] !== null) ? (int) $row[$startcol + 5] : null;
            $this->ndt_title = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
            $this->ndt_type = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
            $this->ndt_cloud = ($row[$startcol + 8] !== null) ? (boolean) $row[$startcol + 8] : null;
            $this->ndt_virtual = ($row[$startcol + 9] !== null) ? (boolean) $row[$startcol + 9] : null;
            $this->bch_id = ($row[$startcol + 10] !== null) ? (int) $row[$startcol + 10] : null;
            $this->bch_parent = ($row[$startcol + 11] !== null) ? (int) $row[$startcol + 11] : null;
            $this->lef_id = ($row[$startcol + 12] !== null) ? (int) $row[$startcol + 12] : null;
            $this->created_by = ($row[$startcol + 13] !== null) ? (int) $row[$startcol + 13] : null;
            $this->created_at = ($row[$startcol + 14] !== null) ? (string) $row[$startcol + 14] : null;
            $this->updated_by = ($row[$startcol + 15] !== null) ? (int) $row[$startcol + 15] : null;
            $this->updated_at = ($row[$startcol + 16] !== null) ? (string) $row[$startcol + 16] : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }
            $this->postHydrate($row, $startcol, $rehydrate);
            return $startcol + 17; // 17 = NodeTreePeer::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException("Error populating NodeTree object", $e);
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

        if ($this->aBranchRelatedByBchId !== null && $this->bch_id !== $this->aBranchRelatedByBchId->getId()) {
            $this->aBranchRelatedByBchId = null;
        }
        if ($this->aBranchRelatedByBchParent !== null && $this->bch_parent !== $this->aBranchRelatedByBchParent->getId()) {
            $this->aBranchRelatedByBchParent = null;
        }
        if ($this->aLeaf !== null && $this->lef_id !== $this->aLeaf->getId()) {
            $this->aLeaf = null;
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
            $con = Propel::getConnection(NodeTreePeer::DATABASE_NAME, Propel::CONNECTION_READ);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $stmt = NodeTreePeer::doSelectStmt($this->buildPkeyCriteria(), $con);
        $row = $stmt->fetch(PDO::FETCH_NUM);
        $stmt->closeCursor();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUserRelatedByCreatedBy = null;
            $this->aUserRelatedByUpdatedBy = null;
            $this->aLeaf = null;
            $this->aBranchRelatedByBchId = null;
            $this->aBranchRelatedByBchParent = null;
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
            $con = Propel::getConnection(NodeTreePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
        }

        $con->beginTransaction();
        try {
            $deleteQuery = NodeTreeQuery::create()
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
            $con = Propel::getConnection(NodeTreePeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
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
                NodeTreePeer::addInstanceToPool($this);
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

            if ($this->aLeaf !== null) {
                if ($this->aLeaf->isModified() || $this->aLeaf->isNew()) {
                    $affectedRows += $this->aLeaf->save($con);
                }
                $this->setLeaf($this->aLeaf);
            }

            if ($this->aBranchRelatedByBchId !== null) {
                if ($this->aBranchRelatedByBchId->isModified() || $this->aBranchRelatedByBchId->isNew()) {
                    $affectedRows += $this->aBranchRelatedByBchId->save($con);
                }
                $this->setBranchRelatedByBchId($this->aBranchRelatedByBchId);
            }

            if ($this->aBranchRelatedByBchParent !== null) {
                if ($this->aBranchRelatedByBchParent->isModified() || $this->aBranchRelatedByBchParent->isNew()) {
                    $affectedRows += $this->aBranchRelatedByBchParent->save($con);
                }
                $this->setBranchRelatedByBchParent($this->aBranchRelatedByBchParent);
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

        $this->modifiedColumns[] = NodeTreePeer::ID;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . NodeTreePeer::ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(NodeTreePeer::ID)) {
            $modifiedColumns[':p' . $index++]  = 'id';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_id';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_POSITION)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_position';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_LEFT)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_left';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_RIGHT)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_right';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_LEVEL)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_level';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_title';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_type';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_CLOUD)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_cloud';
        }
        if ($this->isColumnModified(NodeTreePeer::NDT_VIRTUAL)) {
            $modifiedColumns[':p' . $index++]  = 'ndt_virtual';
        }
        if ($this->isColumnModified(NodeTreePeer::BCH_ID)) {
            $modifiedColumns[':p' . $index++]  = 'bch_id';
        }
        if ($this->isColumnModified(NodeTreePeer::BCH_PARENT)) {
            $modifiedColumns[':p' . $index++]  = 'bch_parent';
        }
        if ($this->isColumnModified(NodeTreePeer::LEF_ID)) {
            $modifiedColumns[':p' . $index++]  = 'lef_id';
        }
        if ($this->isColumnModified(NodeTreePeer::CREATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'created_by';
        }
        if ($this->isColumnModified(NodeTreePeer::CREATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'created_at';
        }
        if ($this->isColumnModified(NodeTreePeer::UPDATED_BY)) {
            $modifiedColumns[':p' . $index++]  = 'updated_by';
        }
        if ($this->isColumnModified(NodeTreePeer::UPDATED_AT)) {
            $modifiedColumns[':p' . $index++]  = 'updated_at';
        }

        $sql = sprintf(
            'INSERT INTO node_tree (%s) VALUES (%s)',
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
                    case 'ndt_id':
                        $stmt->bindValue($identifier, $this->ndt_id, PDO::PARAM_INT);
                        break;
                    case 'ndt_position':
                        $stmt->bindValue($identifier, $this->ndt_position, PDO::PARAM_INT);
                        break;
                    case 'ndt_left':
                        $stmt->bindValue($identifier, $this->ndt_left, PDO::PARAM_INT);
                        break;
                    case 'ndt_right':
                        $stmt->bindValue($identifier, $this->ndt_right, PDO::PARAM_INT);
                        break;
                    case 'ndt_level':
                        $stmt->bindValue($identifier, $this->ndt_level, PDO::PARAM_INT);
                        break;
                    case 'ndt_title':
                        $stmt->bindValue($identifier, $this->ndt_title, PDO::PARAM_STR);
                        break;
                    case 'ndt_type':
                        $stmt->bindValue($identifier, $this->ndt_type, PDO::PARAM_STR);
                        break;
                    case 'ndt_cloud':
                        $stmt->bindValue($identifier, (int) $this->ndt_cloud, PDO::PARAM_INT);
                        break;
                    case 'ndt_virtual':
                        $stmt->bindValue($identifier, (int) $this->ndt_virtual, PDO::PARAM_INT);
                        break;
                    case 'bch_id':
                        $stmt->bindValue($identifier, $this->bch_id, PDO::PARAM_INT);
                        break;
                    case 'bch_parent':
                        $stmt->bindValue($identifier, $this->bch_parent, PDO::PARAM_INT);
                        break;
                    case 'lef_id':
                        $stmt->bindValue($identifier, $this->lef_id, PDO::PARAM_INT);
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

            if ($this->aLeaf !== null) {
                if (!$this->aLeaf->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aLeaf->getValidationFailures());
                }
            }

            if ($this->aBranchRelatedByBchId !== null) {
                if (!$this->aBranchRelatedByBchId->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBranchRelatedByBchId->getValidationFailures());
                }
            }

            if ($this->aBranchRelatedByBchParent !== null) {
                if (!$this->aBranchRelatedByBchParent->validate($columns)) {
                    $failureMap = array_merge($failureMap, $this->aBranchRelatedByBchParent->getValidationFailures());
                }
            }


            if (($retval = NodeTreePeer::doValidate($this, $columns)) !== true) {
                $failureMap = array_merge($failureMap, $retval);
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
        $pos = NodeTreePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
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
                return $this->getNdtId();
                break;
            case 2:
                return $this->getNdtPosition();
                break;
            case 3:
                return $this->getNdtLeft();
                break;
            case 4:
                return $this->getNdtRight();
                break;
            case 5:
                return $this->getNdtLevel();
                break;
            case 6:
                return $this->getNdtTitle();
                break;
            case 7:
                return $this->getNdtType();
                break;
            case 8:
                return $this->getNdtCloud();
                break;
            case 9:
                return $this->getNdtVirtual();
                break;
            case 10:
                return $this->getBchId();
                break;
            case 11:
                return $this->getBchParent();
                break;
            case 12:
                return $this->getLefId();
                break;
            case 13:
                return $this->getCreatedBy();
                break;
            case 14:
                return $this->getCreatedAt();
                break;
            case 15:
                return $this->getUpdatedBy();
                break;
            case 16:
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
        if (isset($alreadyDumpedObjects['NodeTree'][$this->getPrimaryKey()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['NodeTree'][$this->getPrimaryKey()] = true;
        $keys = NodeTreePeer::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getNdtId(),
            $keys[2] => $this->getNdtPosition(),
            $keys[3] => $this->getNdtLeft(),
            $keys[4] => $this->getNdtRight(),
            $keys[5] => $this->getNdtLevel(),
            $keys[6] => $this->getNdtTitle(),
            $keys[7] => $this->getNdtType(),
            $keys[8] => $this->getNdtCloud(),
            $keys[9] => $this->getNdtVirtual(),
            $keys[10] => $this->getBchId(),
            $keys[11] => $this->getBchParent(),
            $keys[12] => $this->getLefId(),
            $keys[13] => $this->getCreatedBy(),
            $keys[14] => $this->getCreatedAt(),
            $keys[15] => $this->getUpdatedBy(),
            $keys[16] => $this->getUpdatedAt(),
        );
        if ($includeForeignObjects) {
            if (null !== $this->aUserRelatedByCreatedBy) {
                $result['UserRelatedByCreatedBy'] = $this->aUserRelatedByCreatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUserRelatedByUpdatedBy) {
                $result['UserRelatedByUpdatedBy'] = $this->aUserRelatedByUpdatedBy->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aLeaf) {
                $result['Leaf'] = $this->aLeaf->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBranchRelatedByBchId) {
                $result['BranchRelatedByBchId'] = $this->aBranchRelatedByBchId->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aBranchRelatedByBchParent) {
                $result['BranchRelatedByBchParent'] = $this->aBranchRelatedByBchParent->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
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
        $pos = NodeTreePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);

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
                $this->setNdtId($value);
                break;
            case 2:
                $this->setNdtPosition($value);
                break;
            case 3:
                $this->setNdtLeft($value);
                break;
            case 4:
                $this->setNdtRight($value);
                break;
            case 5:
                $this->setNdtLevel($value);
                break;
            case 6:
                $this->setNdtTitle($value);
                break;
            case 7:
                $this->setNdtType($value);
                break;
            case 8:
                $this->setNdtCloud($value);
                break;
            case 9:
                $this->setNdtVirtual($value);
                break;
            case 10:
                $this->setBchId($value);
                break;
            case 11:
                $this->setBchParent($value);
                break;
            case 12:
                $this->setLefId($value);
                break;
            case 13:
                $this->setCreatedBy($value);
                break;
            case 14:
                $this->setCreatedAt($value);
                break;
            case 15:
                $this->setUpdatedBy($value);
                break;
            case 16:
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
        $keys = NodeTreePeer::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
        if (array_key_exists($keys[1], $arr)) $this->setNdtId($arr[$keys[1]]);
        if (array_key_exists($keys[2], $arr)) $this->setNdtPosition($arr[$keys[2]]);
        if (array_key_exists($keys[3], $arr)) $this->setNdtLeft($arr[$keys[3]]);
        if (array_key_exists($keys[4], $arr)) $this->setNdtRight($arr[$keys[4]]);
        if (array_key_exists($keys[5], $arr)) $this->setNdtLevel($arr[$keys[5]]);
        if (array_key_exists($keys[6], $arr)) $this->setNdtTitle($arr[$keys[6]]);
        if (array_key_exists($keys[7], $arr)) $this->setNdtType($arr[$keys[7]]);
        if (array_key_exists($keys[8], $arr)) $this->setNdtCloud($arr[$keys[8]]);
        if (array_key_exists($keys[9], $arr)) $this->setNdtVirtual($arr[$keys[9]]);
        if (array_key_exists($keys[10], $arr)) $this->setBchId($arr[$keys[10]]);
        if (array_key_exists($keys[11], $arr)) $this->setBchParent($arr[$keys[11]]);
        if (array_key_exists($keys[12], $arr)) $this->setLefId($arr[$keys[12]]);
        if (array_key_exists($keys[13], $arr)) $this->setCreatedBy($arr[$keys[13]]);
        if (array_key_exists($keys[14], $arr)) $this->setCreatedAt($arr[$keys[14]]);
        if (array_key_exists($keys[15], $arr)) $this->setUpdatedBy($arr[$keys[15]]);
        if (array_key_exists($keys[16], $arr)) $this->setUpdatedAt($arr[$keys[16]]);
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(NodeTreePeer::DATABASE_NAME);

        if ($this->isColumnModified(NodeTreePeer::ID)) $criteria->add(NodeTreePeer::ID, $this->id);
        if ($this->isColumnModified(NodeTreePeer::NDT_ID)) $criteria->add(NodeTreePeer::NDT_ID, $this->ndt_id);
        if ($this->isColumnModified(NodeTreePeer::NDT_POSITION)) $criteria->add(NodeTreePeer::NDT_POSITION, $this->ndt_position);
        if ($this->isColumnModified(NodeTreePeer::NDT_LEFT)) $criteria->add(NodeTreePeer::NDT_LEFT, $this->ndt_left);
        if ($this->isColumnModified(NodeTreePeer::NDT_RIGHT)) $criteria->add(NodeTreePeer::NDT_RIGHT, $this->ndt_right);
        if ($this->isColumnModified(NodeTreePeer::NDT_LEVEL)) $criteria->add(NodeTreePeer::NDT_LEVEL, $this->ndt_level);
        if ($this->isColumnModified(NodeTreePeer::NDT_TITLE)) $criteria->add(NodeTreePeer::NDT_TITLE, $this->ndt_title);
        if ($this->isColumnModified(NodeTreePeer::NDT_TYPE)) $criteria->add(NodeTreePeer::NDT_TYPE, $this->ndt_type);
        if ($this->isColumnModified(NodeTreePeer::NDT_CLOUD)) $criteria->add(NodeTreePeer::NDT_CLOUD, $this->ndt_cloud);
        if ($this->isColumnModified(NodeTreePeer::NDT_VIRTUAL)) $criteria->add(NodeTreePeer::NDT_VIRTUAL, $this->ndt_virtual);
        if ($this->isColumnModified(NodeTreePeer::BCH_ID)) $criteria->add(NodeTreePeer::BCH_ID, $this->bch_id);
        if ($this->isColumnModified(NodeTreePeer::BCH_PARENT)) $criteria->add(NodeTreePeer::BCH_PARENT, $this->bch_parent);
        if ($this->isColumnModified(NodeTreePeer::LEF_ID)) $criteria->add(NodeTreePeer::LEF_ID, $this->lef_id);
        if ($this->isColumnModified(NodeTreePeer::CREATED_BY)) $criteria->add(NodeTreePeer::CREATED_BY, $this->created_by);
        if ($this->isColumnModified(NodeTreePeer::CREATED_AT)) $criteria->add(NodeTreePeer::CREATED_AT, $this->created_at);
        if ($this->isColumnModified(NodeTreePeer::UPDATED_BY)) $criteria->add(NodeTreePeer::UPDATED_BY, $this->updated_by);
        if ($this->isColumnModified(NodeTreePeer::UPDATED_AT)) $criteria->add(NodeTreePeer::UPDATED_AT, $this->updated_at);

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
        $criteria = new Criteria(NodeTreePeer::DATABASE_NAME);
        $criteria->add(NodeTreePeer::ID, $this->id);

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
     * @param object $copyObj An object of NodeTree (or compatible) type.
     * @param boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setNdtId($this->getNdtId());
        $copyObj->setNdtPosition($this->getNdtPosition());
        $copyObj->setNdtLeft($this->getNdtLeft());
        $copyObj->setNdtRight($this->getNdtRight());
        $copyObj->setNdtLevel($this->getNdtLevel());
        $copyObj->setNdtTitle($this->getNdtTitle());
        $copyObj->setNdtType($this->getNdtType());
        $copyObj->setNdtCloud($this->getNdtCloud());
        $copyObj->setNdtVirtual($this->getNdtVirtual());
        $copyObj->setBchId($this->getBchId());
        $copyObj->setBchParent($this->getBchParent());
        $copyObj->setLefId($this->getLefId());
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
     * @return NodeTree Clone of current object.
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
     * @return NodeTreePeer
     */
    public function getPeer()
    {
        if (self::$peer === null) {
            self::$peer = new NodeTreePeer();
        }

        return self::$peer;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return NodeTree The current object (for fluent API support)
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
            $v->addNodeTreeRelatedByCreatedBy($this);
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
                $this->aUserRelatedByCreatedBy->addNodeTreesRelatedByCreatedBy($this);
             */
        }

        return $this->aUserRelatedByCreatedBy;
    }

    /**
     * Declares an association between this object and a User object.
     *
     * @param             User $v
     * @return NodeTree The current object (for fluent API support)
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
            $v->addNodeTreeRelatedByUpdatedBy($this);
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
                $this->aUserRelatedByUpdatedBy->addNodeTreesRelatedByUpdatedBy($this);
             */
        }

        return $this->aUserRelatedByUpdatedBy;
    }

    /**
     * Declares an association between this object and a Leaf object.
     *
     * @param             Leaf $v
     * @return NodeTree The current object (for fluent API support)
     * @throws PropelException
     */
    public function setLeaf(Leaf $v = null)
    {
        if ($v === null) {
            $this->setLefId(NULL);
        } else {
            $this->setLefId($v->getId());
        }

        $this->aLeaf = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Leaf object, it will not be re-added.
        if ($v !== null) {
            $v->addNodeTree($this);
        }


        return $this;
    }


    /**
     * Get the associated Leaf object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Leaf The associated Leaf object.
     * @throws PropelException
     */
    public function getLeaf(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aLeaf === null && ($this->lef_id !== null) && $doQuery) {
            $this->aLeaf = LeafQuery::create()->findPk($this->lef_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aLeaf->addNodeTrees($this);
             */
        }

        return $this->aLeaf;
    }

    /**
     * Declares an association between this object and a Branch object.
     *
     * @param             Branch $v
     * @return NodeTree The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBranchRelatedByBchId(Branch $v = null)
    {
        if ($v === null) {
            $this->setBchId(NULL);
        } else {
            $this->setBchId($v->getId());
        }

        $this->aBranchRelatedByBchId = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Branch object, it will not be re-added.
        if ($v !== null) {
            $v->addNodeTreeRelatedByBchId($this);
        }


        return $this;
    }


    /**
     * Get the associated Branch object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Branch The associated Branch object.
     * @throws PropelException
     */
    public function getBranchRelatedByBchId(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBranchRelatedByBchId === null && ($this->bch_id !== null) && $doQuery) {
            $this->aBranchRelatedByBchId = BranchQuery::create()->findPk($this->bch_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBranchRelatedByBchId->addNodeTreesRelatedByBchId($this);
             */
        }

        return $this->aBranchRelatedByBchId;
    }

    /**
     * Declares an association between this object and a Branch object.
     *
     * @param             Branch $v
     * @return NodeTree The current object (for fluent API support)
     * @throws PropelException
     */
    public function setBranchRelatedByBchParent(Branch $v = null)
    {
        if ($v === null) {
            $this->setBchParent(NULL);
        } else {
            $this->setBchParent($v->getId());
        }

        $this->aBranchRelatedByBchParent = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the Branch object, it will not be re-added.
        if ($v !== null) {
            $v->addNodeTreeRelatedByBchParent($this);
        }


        return $this;
    }


    /**
     * Get the associated Branch object
     *
     * @param PropelPDO $con Optional Connection object.
     * @param $doQuery Executes a query to get the object if required
     * @return Branch The associated Branch object.
     * @throws PropelException
     */
    public function getBranchRelatedByBchParent(PropelPDO $con = null, $doQuery = true)
    {
        if ($this->aBranchRelatedByBchParent === null && ($this->bch_parent !== null) && $doQuery) {
            $this->aBranchRelatedByBchParent = BranchQuery::create()->findPk($this->bch_parent, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aBranchRelatedByBchParent->addNodeTreesRelatedByBchParent($this);
             */
        }

        return $this->aBranchRelatedByBchParent;
    }

    /**
     * Clears the current object and sets all attributes to their default values
     */
    public function clear()
    {
        $this->id = null;
        $this->ndt_id = null;
        $this->ndt_position = null;
        $this->ndt_left = null;
        $this->ndt_right = null;
        $this->ndt_level = null;
        $this->ndt_title = null;
        $this->ndt_type = null;
        $this->ndt_cloud = null;
        $this->ndt_virtual = null;
        $this->bch_id = null;
        $this->bch_parent = null;
        $this->lef_id = null;
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
            if ($this->aUserRelatedByCreatedBy instanceof Persistent) {
              $this->aUserRelatedByCreatedBy->clearAllReferences($deep);
            }
            if ($this->aUserRelatedByUpdatedBy instanceof Persistent) {
              $this->aUserRelatedByUpdatedBy->clearAllReferences($deep);
            }
            if ($this->aLeaf instanceof Persistent) {
              $this->aLeaf->clearAllReferences($deep);
            }
            if ($this->aBranchRelatedByBchId instanceof Persistent) {
              $this->aBranchRelatedByBchId->clearAllReferences($deep);
            }
            if ($this->aBranchRelatedByBchParent instanceof Persistent) {
              $this->aBranchRelatedByBchParent->clearAllReferences($deep);
            }

            $this->alreadyInClearAllReferencesDeep = false;
        } // if ($deep)

        $this->aUserRelatedByCreatedBy = null;
        $this->aUserRelatedByUpdatedBy = null;
        $this->aLeaf = null;
        $this->aBranchRelatedByBchId = null;
        $this->aBranchRelatedByBchParent = null;
    }

    /**
     * return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(NodeTreePeer::DEFAULT_STRING_FORMAT);
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

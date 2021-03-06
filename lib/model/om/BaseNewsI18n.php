<?php

/**
 * Base class that represents a row from the 'news_i18n' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2
 *
 *
 * @package    lib.model.om
 */
abstract class BaseNewsI18n extends BaseObject  implements Persistent {


	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        NewsI18nPeer
	 */
	protected static $peer;

	/**
	 * The value for the updated_at_extra field.
	 * @var        string
	 */
	protected $updated_at_extra;

	/**
	 * The value for the title field.
	 * @var        string
	 */
	protected $title;

	/**
	 * The value for the shortbody field.
	 * @var        string
	 */
	protected $shortbody;

	/**
	 * The value for the body field.
	 * @var        string
	 */
	protected $body;

	/**
	 * The value for the author field.
	 * @var        string
	 */
	protected $author;

	/**
	 * The value for the translated_by field.
	 * @var        string
	 */
	protected $translated_by;

	/**
	 * The value for the link field.
	 * @var        string
	 */
	protected $link;

	/**
	 * The value for the extradate field.
	 * @var        string
	 */
	protected $extradate;

	/**
	 * The value for the doc field.
	 * @var        string
	 */
	protected $doc;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the culture field.
	 * @var        string
	 */
	protected $culture;

	/**
	 * @var        News
	 */
	protected $aNews;

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

	// symfony behavior
	
	const PEER = 'NewsI18nPeer';

	/**
	 * Get the [optionally formatted] temporal [updated_at_extra] column value.
	 * 
	 *
	 * @param      string $format The date/time format string (either date()-style or strftime()-style).
	 *							If format is NULL, then the raw DateTime object will be returned.
	 * @return     mixed Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
	 * @throws     PropelException - if unable to parse/validate the date/time value.
	 */
	public function getUpdatedAtExtra($format = 'Y-m-d H:i:s')
	{
		if ($this->updated_at_extra === null) {
			return null;
		}


		if ($this->updated_at_extra === '0000-00-00 00:00:00') {
			// while technically this is not a default value of NULL,
			// this seems to be closest in meaning.
			return null;
		} else {
			try {
				$dt = new DateTime($this->updated_at_extra);
			} catch (Exception $x) {
				throw new PropelException("Internally stored date/time/timestamp value could not be converted to DateTime: " . var_export($this->updated_at_extra, true), $x);
			}
		}

		if ($format === null) {
			// Because propel.useDateTimeClass is TRUE, we return a DateTime object.
			return $dt;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $dt->format('U'));
		} else {
			return $dt->format($format);
		}
	}

	/**
	 * Get the [title] column value.
	 * 
	 * @return     string
	 */
	public function getTitle()
	{
		return $this->title;
	}

	/**
	 * Get the [shortbody] column value.
	 * 
	 * @return     string
	 */
	public function getShortbody()
	{
		return $this->shortbody;
	}

	/**
	 * Get the [body] column value.
	 * 
	 * @return     string
	 */
	public function getBody()
	{
		return $this->body;
	}

	/**
	 * Get the [author] column value.
	 * 
	 * @return     string
	 */
	public function getAuthor()
	{
		return $this->author;
	}

	/**
	 * Get the [translated_by] column value.
	 * 
	 * @return     string
	 */
	public function getTranslatedBy()
	{
		return $this->translated_by;
	}

	/**
	 * Get the [link] column value.
	 * 
	 * @return     string
	 */
	public function getLink()
	{
		return $this->link;
	}

	/**
	 * Get the [extradate] column value.
	 * 
	 * @return     string
	 */
	public function getExtradate()
	{
		return $this->extradate;
	}

	/**
	 * Get the [doc] column value.
	 * 
	 * @return     string
	 */
	public function getDoc()
	{
		return $this->doc;
	}

	/**
	 * Get the [id] column value.
	 * 
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [culture] column value.
	 * 
	 * @return     string
	 */
	public function getCulture()
	{
		return $this->culture;
	}

	/**
	 * Sets the value of [updated_at_extra] column to a normalized version of the date/time value specified.
	 * 
	 * @param      mixed $v string, integer (timestamp), or DateTime value.  Empty string will
	 *						be treated as NULL for temporal objects.
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setUpdatedAtExtra($v)
	{
		// we treat '' as NULL for temporal objects because DateTime('') == DateTime('now')
		// -- which is unexpected, to say the least.
		if ($v === null || $v === '') {
			$dt = null;
		} elseif ($v instanceof DateTime) {
			$dt = $v;
		} else {
			// some string/numeric value passed; we normalize that so that we can
			// validate it.
			try {
				if (is_numeric($v)) { // if it's a unix timestamp
					$dt = new DateTime('@'.$v, new DateTimeZone('UTC'));
					// We have to explicitly specify and then change the time zone because of a
					// DateTime bug: http://bugs.php.net/bug.php?id=43003
					$dt->setTimeZone(new DateTimeZone(date_default_timezone_get()));
				} else {
					$dt = new DateTime($v);
				}
			} catch (Exception $x) {
				throw new PropelException('Error parsing date/time value: ' . var_export($v, true), $x);
			}
		}

		if ( $this->updated_at_extra !== null || $dt !== null ) {
			// (nested ifs are a little easier to read in this case)

			$currNorm = ($this->updated_at_extra !== null && $tmpDt = new DateTime($this->updated_at_extra)) ? $tmpDt->format('Y-m-d H:i:s') : null;
			$newNorm = ($dt !== null) ? $dt->format('Y-m-d H:i:s') : null;

			if ( ($currNorm !== $newNorm) // normalized values don't match 
					)
			{
				$this->updated_at_extra = ($dt ? $dt->format('Y-m-d H:i:s') : null);
				$this->modifiedColumns[] = NewsI18nPeer::UPDATED_AT_EXTRA;
			}
		} // if either are not null

		return $this;
	} // setUpdatedAtExtra()

	/**
	 * Set the value of [title] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setTitle($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->title !== $v) {
			if ($this->title === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::TITLE;
			}
			$this->title = $v;
		}

		return $this;
	} // setTitle()

	/**
	 * Set the value of [shortbody] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setShortbody($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->shortbody !== $v) {
			if ($this->shortbody === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::SHORTBODY;
			}
			$this->shortbody = $v;
		}

		return $this;
	} // setShortbody()

	/**
	 * Set the value of [body] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setBody($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->body !== $v) {
			if ($this->body === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::BODY;
			}
			$this->body = $v;
		}

		return $this;
	} // setBody()

	/**
	 * Set the value of [author] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setAuthor($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->author !== $v) {
			if ($this->author === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::AUTHOR;
			}
			$this->author = $v;
		}

		return $this;
	} // setAuthor()

	/**
	 * Set the value of [translated_by] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setTranslatedBy($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->translated_by !== $v) {
			if ($this->translated_by === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::TRANSLATED_BY;
			}
			$this->translated_by = $v;
		}

		return $this;
	} // setTranslatedBy()

	/**
	 * Set the value of [link] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setLink($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->link !== $v) {
			if ($this->link === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::LINK;
			}
			$this->link = $v;
		}

		return $this;
	} // setLink()

	/**
	 * Set the value of [extradate] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setExtradate($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->extradate !== $v) {
			if ($this->extradate === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::EXTRADATE;
			}
			$this->extradate = $v;
		}

		return $this;
	} // setExtradate()

	/**
	 * Set the value of [doc] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setDoc($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->doc !== $v) {
			if ($this->doc === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::DOC;
			}
			$this->doc = $v;
		}

		return $this;
	} // setDoc()

	/**
	 * Set the value of [id] column.
	 * 
	 * @param      int $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			if ($this->id === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::ID;
			}
			$this->id = $v;
		}

		if ($this->aNews !== null && $this->aNews->getId() !== $v) {
			$this->aNews = null;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [culture] column.
	 * 
	 * @param      string $v new value
	 * @return     NewsI18n The current object (for fluent API support)
	 */
	public function setCulture($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->culture !== $v) {
			if ($this->culture === null && $v === '') {
			} else {
			  $this->modifiedColumns[] = NewsI18nPeer::CULTURE;
			}
			$this->culture = $v;
		}

		return $this;
	} // setCulture()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
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
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->updated_at_extra = ($row[$startcol + 0] !== null) ? (string) $row[$startcol + 0] : null;
			$this->title = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->shortbody = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->body = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->author = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->translated_by = ($row[$startcol + 5] !== null) ? (string) $row[$startcol + 5] : null;
			$this->link = ($row[$startcol + 6] !== null) ? (string) $row[$startcol + 6] : null;
			$this->extradate = ($row[$startcol + 7] !== null) ? (string) $row[$startcol + 7] : null;
			$this->doc = ($row[$startcol + 8] !== null) ? (string) $row[$startcol + 8] : null;
			$this->id = ($row[$startcol + 9] !== null) ? (int) $row[$startcol + 9] : null;
			$this->culture = ($row[$startcol + 10] !== null) ? (string) $row[$startcol + 10] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			// FIXME - using NUM_COLUMNS may be clearer.
			return $startcol + 11; // 11 = NewsI18nPeer::NUM_COLUMNS - NewsI18nPeer::NUM_LAZY_LOAD_COLUMNS).

		} catch (Exception $e) {
			throw new PropelException("Error populating NewsI18n object", $e);
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
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

		if ($this->aNews !== null && $this->id !== $this->aNews->getId()) {
			$this->aNews = null;
		}
	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
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
			$con = Propel::getConnection(NewsI18nPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = NewsI18nPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {  // also de-associate any related objects?

			$this->aNews = null;
		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NewsI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		try {
			$ret = $this->preDelete($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseNewsI18n:delete:pre') as $callable)
			{
			  if (call_user_func($callable, $this, $con))
			  {
			    $con->commit();
			
			    return;
			  }
			}

			if ($ret) {
				NewsI18nPeer::doDelete($this, $con);
				$this->postDelete($con);
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseNewsI18n:delete:post') as $callable)
				{
				  call_user_func($callable, $this, $con);
				}

				$this->setDeleted(true);
				$con->commit();
			} else {
				$con->commit();
			}
		} catch (PropelException $e) {
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
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NewsI18nPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}
		
		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			// symfony_behaviors behavior
			foreach (sfMixer::getCallables('BaseNewsI18n:save:pre') as $callable)
			{
			  if (is_integer($affectedRows = call_user_func($callable, $this, $con)))
			  {
			    $con->commit();
			
			    return $affectedRows;
			  }
			}

			// symfony_timestampable behavior
			if ($this->isModified() && !$this->isColumnModified(NewsI18nPeer::UPDATED_AT_EXTRA) && $this->getChangeUpdatedAt())
			{
			  $this->setUpdatedAtExtra(time());
			}
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
				// symfony_timestampable behavior
				
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
				// symfony_behaviors behavior
				foreach (sfMixer::getCallables('BaseNewsI18n:save:post') as $callable)
				{
				  call_user_func($callable, $this, $con, $affectedRows);
				}

				NewsI18nPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
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
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
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

			if ($this->aNews !== null) {
				if ($this->aNews->isModified() || ($this->aNews->getCulture() && $this->aNews->getCurrentNewsI18n()->isModified()) || $this->aNews->isNew()) {
					$affectedRows += $this->aNews->save($con);
				}
				$this->setNews($this->aNews);
			}


			// If this object has been modified, then save it to the database.
			if ($this->isModified()) {
				if ($this->isNew()) {
					// if i18n object is new and all fields are empty we do not save it into DB
					$has_non_empty_fields = false;
					$only_service_fields_modified = true;
					$is_i18n = false;
					foreach ($this->getModifiedColumns() as $modified_column) {
						// news_i18n.UPDATED_AT_EXTRA -> UpdatedAtExtra
						if (strstr($modified_column, 'i18n')) {
							$is_i18n = true;
						}
						$modified_column_name = preg_replace("/^[^\.]+\./", '', $modified_column);
						// we do not take into account changing of some of the fields
						if (in_array($modified_column_name, array('ID', 'CULTURE', 'UPDATED_AT', 'UPDATED_AT_EXTRA'))) {
							continue;
						}
						$only_service_fields_modified = false;
						// news_i18n.UPDATED_AT_EXTRA -> news_i18n.UpdatedAtExtra							
						$modified_column_name_parts = explode('_', $modified_column_name);
						$modified_column_name = '';
						foreach ($modified_column_name_parts as $part) {
							$modified_column_name .= ucfirst(strtolower($part));
						}

						$value = $this->getByName($modified_column_name);						

						if ($value) {
							$has_non_empty_fields = true;
							break;
						}
					}
					if ($has_non_empty_fields || ($only_service_fields_modified && !$is_i18n)) {
						$pk = NewsI18nPeer::doInsert($this, $con);
						$affectedRows += 1; // we are assuming that there is only 1 row per doInsert() which
										 // should always be true here (even though technically
										 // BasePeer::doInsert() can insert multiple rows).

						$this->setNew(false);
					}
				} else {
					$affectedRows += NewsI18nPeer::doUpdate($this, $con);
				}

				$this->resetModified(); // [HL] After being saved an object is no longer 'modified'
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
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
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
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

			if ($this->aNews !== null) {
				if (!$this->aNews->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aNews->getValidationFailures());
				}
			}


			if (($retval = NewsI18nPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NewsI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUpdatedAtExtra();
				break;
			case 1:
				return $this->getTitle();
				break;
			case 2:
				return $this->getShortbody();
				break;
			case 3:
				return $this->getBody();
				break;
			case 4:
				return $this->getAuthor();
				break;
			case 5:
				return $this->getTranslatedBy();
				break;
			case 6:
				return $this->getLink();
				break;
			case 7:
				return $this->getExtradate();
				break;
			case 8:
				return $this->getDoc();
				break;
			case 9:
				return $this->getId();
				break;
			case 10:
				return $this->getCulture();
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
	 * @param      string $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                        BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM. Defaults to BasePeer::TYPE_PHPNAME.
	 * @param      boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns.  Defaults to TRUE.
	 * @return     an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true)
	{
		$keys = NewsI18nPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUpdatedAtExtra(),
			$keys[1] => $this->getTitle(),
			$keys[2] => $this->getShortbody(),
			$keys[3] => $this->getBody(),
			$keys[4] => $this->getAuthor(),
			$keys[5] => $this->getTranslatedBy(),
			$keys[6] => $this->getLink(),
			$keys[7] => $this->getExtradate(),
			$keys[8] => $this->getDoc(),
			$keys[9] => $this->getId(),
			$keys[10] => $this->getCulture(),
		);
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NewsI18nPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUpdatedAtExtra($value);
				break;
			case 1:
				$this->setTitle($value);
				break;
			case 2:
				$this->setShortbody($value);
				break;
			case 3:
				$this->setBody($value);
				break;
			case 4:
				$this->setAuthor($value);
				break;
			case 5:
				$this->setTranslatedBy($value);
				break;
			case 6:
				$this->setLink($value);
				break;
			case 7:
				$this->setExtradate($value);
				break;
			case 8:
				$this->setDoc($value);
				break;
			case 9:
				$this->setId($value);
				break;
			case 10:
				$this->setCulture($value);
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
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NewsI18nPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUpdatedAtExtra($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setTitle($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setShortbody($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setBody($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setAuthor($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setTranslatedBy($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setLink($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setExtradate($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setDoc($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setId($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setCulture($arr[$keys[10]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(NewsI18nPeer::DATABASE_NAME);

		if ($this->isColumnModified(NewsI18nPeer::UPDATED_AT_EXTRA)) $criteria->add(NewsI18nPeer::UPDATED_AT_EXTRA, $this->updated_at_extra);
		if ($this->isColumnModified(NewsI18nPeer::TITLE)) $criteria->add(NewsI18nPeer::TITLE, $this->title);
		if ($this->isColumnModified(NewsI18nPeer::SHORTBODY)) $criteria->add(NewsI18nPeer::SHORTBODY, $this->shortbody);
		if ($this->isColumnModified(NewsI18nPeer::BODY)) $criteria->add(NewsI18nPeer::BODY, $this->body);
		if ($this->isColumnModified(NewsI18nPeer::AUTHOR)) $criteria->add(NewsI18nPeer::AUTHOR, $this->author);
		if ($this->isColumnModified(NewsI18nPeer::TRANSLATED_BY)) $criteria->add(NewsI18nPeer::TRANSLATED_BY, $this->translated_by);
		if ($this->isColumnModified(NewsI18nPeer::LINK)) $criteria->add(NewsI18nPeer::LINK, $this->link);
		if ($this->isColumnModified(NewsI18nPeer::EXTRADATE)) $criteria->add(NewsI18nPeer::EXTRADATE, $this->extradate);
		if ($this->isColumnModified(NewsI18nPeer::DOC)) $criteria->add(NewsI18nPeer::DOC, $this->doc);
		if ($this->isColumnModified(NewsI18nPeer::ID)) $criteria->add(NewsI18nPeer::ID, $this->id);
		if ($this->isColumnModified(NewsI18nPeer::CULTURE)) $criteria->add(NewsI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NewsI18nPeer::DATABASE_NAME);

		$criteria->add(NewsI18nPeer::ID, $this->id);
		$criteria->add(NewsI18nPeer::CULTURE, $this->culture);

		return $criteria;
	}

	/**
	 * Returns the composite primary key for this object.
	 * The array elements will be in same order as specified in XML.
	 * @return     array
	 */
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getId();

		$pks[1] = $this->getCulture();

		return $pks;
	}

	/**
	 * Set the [composite] primary key.
	 *
	 * @param      array $keys The elements of the composite key (order must match the order in XML file).
	 * @return     void
	 */
	public function setPrimaryKey($keys)
	{

		$this->setId($keys[0]);

		$this->setCulture($keys[1]);

	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of NewsI18n (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUpdatedAtExtra($this->updated_at_extra);

		$copyObj->setTitle($this->title);

		$copyObj->setShortbody($this->shortbody);

		$copyObj->setBody($this->body);

		$copyObj->setAuthor($this->author);

		$copyObj->setTranslatedBy($this->translated_by);

		$copyObj->setLink($this->link);

		$copyObj->setExtradate($this->extradate);

		$copyObj->setDoc($this->doc);

		$copyObj->setId($this->id);

		$copyObj->setCulture($this->culture);


		$copyObj->setNew(true);

	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     NewsI18n Clone of current object.
	 * @throws     PropelException
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
	 * @return     NewsI18nPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new NewsI18nPeer();
		}
		return self::$peer;
	}

	/**
	 * Declares an association between this object and a News object.
	 *
	 * @param      News $v
	 * @return     NewsI18n The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNews(News $v = null)
	{
		if ($v === null) {
			$this->setId(NULL);
		} else {
			$this->setId($v->getId());
		}

		$this->aNews = $v;

		// Add binding for other direction of this n:n relationship.
		// If this object has already been added to the News object, it will not be re-added.
		if ($v !== null) {
			$v->addNewsI18n($this);
		}

		return $this;
	}


	/**
	 * Get the associated News object
	 *
	 * @param      PropelPDO Optional Connection object.
	 * @return     News The associated News object.
	 * @throws     PropelException
	 */
	public function getNews(PropelPDO $con = null)
	{
		if ($this->aNews === null && ($this->id !== null)) {
			$this->aNews = NewsPeer::retrieveByPk($this->id);
			/* The following can be used additionally to
			   guarantee the related object contains a reference
			   to this object.  This level of coupling may, however, be
			   undesirable since it could result in an only partially populated collection
			   in the referenced object.
			   $this->aNews->addNewsI18ns($this);
			 */
		}
		return $this->aNews;
	}

	/**
	 * Resets all collections of referencing foreign keys.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect objects
	 * with circular references.  This is currently necessary when using Propel in certain
	 * daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all associated objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
		} // if ($deep)

			$this->aNews = null;
	}

	// symfony_behaviors behavior
	
	/**
	 * Calls methods defined via {@link sfMixer}.
	 */
	public function __call($method, $arguments)
	{
	  if (!$callable = sfMixer::getCallable('BaseNewsI18n:'.$method))
	  {
	    throw new sfException(sprintf('Call to undefined method BaseNewsI18n::%s', $method));
	  }
	
	  array_unshift($arguments, $this);
	
	  return call_user_func_array($callable, $arguments);
	}

} // BaseNewsI18n

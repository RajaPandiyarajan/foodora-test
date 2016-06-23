<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 22/06/2016
 * Revision: 1
 */

namespace application\foodora\Models\Helpers;

/**
 * Class MainModel is the parent class for all extending models and handles common behavior
 * @package application\foodora\Models\Helpers
 */
class MainModel {

	protected $db;
	private $tableName;

	public function __construct($tableName = null) {
		$this->tableName = $tableName;
	}

	/**
	 * Finds all the records of a given table
	 * @return mixed
	 * @throws InvalidTableName
	 */
	public function findAll() {
		if (!$this->tableName)
			throw new Exception("Table name has not been specified or is invalid");

		$sth = $this->db->prepare("SELECT * FROM " . $this->tableName);
		$sth->execute();

		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}

	/**
	 * Finds a record from ID
	 * @param $id
	 * @return bool
	 */
	public function findById($id) {
		if (!$this->tableName)
			throw new Exception("Table name has not been specified or is invalid");

		$sth = $this->db->prepare("SELECT * FROM " . $this->tableName . " WHERE id = :id");
		$sth->bindParam(':id', $id);
		$sth->execute();

		$rows = $sth->fetchAll(\PDO::FETCH_ASSOC);

		return isset($rows[0]) ? $rows[0] : false;
	}

	/**
	 * Sets the database and returns the instance
	 * @param $db
	 * @return $this
	 */
	public function instance($db) {
		$this->db = $db;

		return $this;
	}

	/**
	 * Returns the connection
	 * @return mixed
	 */
	public function getConnection() {
		return $this->db;
	}
}
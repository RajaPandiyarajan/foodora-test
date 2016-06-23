<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 22/06/2016
 * Revision: 1
 * Purpose of file: Factory class creates dynamically a given Class returning its instance 
 *                  using create method with DB connection available in allfiles
 * @return class object
 */

namespace application\foodora\Factory;

class Factory {

	public $dbConnect = null;
	public $connection = null;

	public function __construct($dbConnect) {
		$this->dbConnect = $dbConnect;
	}

	public function create($className) {
		if ($this->connection === null) {
			$this->connection = $this->dbConnect;
		}
		return new $className($this);
	}
}
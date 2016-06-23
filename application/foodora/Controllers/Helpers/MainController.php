<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 22/06/2016
 * Revision: 1
 */

namespace application\foodora\Controllers\Helpers;

use application\foodora\Utility\Utility;

/**
 * Class Main Controller is the parent class for all controllers
 * @package application\foodora\Controllers\Helpers
 */
class MainController {

    protected $factory;
    protected $repository;

    use Utility;

    public function __construct(\application\foodora\Factory\Factory $factory) {
        $this->factory    = $factory;
    }

    /**
     * Gets all the records for a specific table
     * @return mixed
     */
    public function getAll() {
        return $this->repository->findAll();
    }

    /**
     * Gets a specific record by id
     * @param $object
     * @param $id
     * @return bool|object
     */
    public function getById($object, $id) {
        $objectResult = $this->repository->findById($id);
        return $objectResult ? $this->createObject($object, $objectResult) : false;
    }
} 
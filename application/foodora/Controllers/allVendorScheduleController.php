<?php
/**
* Developer: Raja Pandiyarajan
* Date: 22/06/2016
* Revision: 1
*/

namespace application\foodora\Controllers;
use application\foodora\Controllers\Helpers\MainController;

class allVendorScheduleController extends MainController {

    public function __construct(\application\foodora\Factory\Factory $factory) {
        parent::__construct($factory);
        $this->repository = $this->factory->create('application\foodora\Models\VendorScheduleModel')->instance($this->factory->connection);
    }

    /**
     * Creates a VendorSchedule object from given data
     * @param $vendorId
     * @param $specialDay
     * @param $weekday
     * @return mixed
     */
    public function createSchedule($vendorId, $specialDay, $weekday) {
        $vendorSchedule = $this->factory->create('application\foodora\Registry\VendorSchedule');

        $vendorSchedule->setVendorId($vendorId);
        $vendorSchedule->setWeekday($weekday);
        $vendorSchedule->setAllday($specialDay->getAllday());
        $vendorSchedule->setStartHour($specialDay->getStartHour());
        $vendorSchedule->setStopHour($specialDay->getStopHour());

        return $vendorSchedule;
    }

    /**
     * Updates the VendorSchedule calling the repository to save into DB
     * @param $newVendorSchedule
     * @param $removed
     */
    public function updateVendorSchedule($newVendorSchedule, $removed) {
	    try {
		    $this->repository->getConnection()->beginTransaction();

		    foreach($newVendorSchedule as $newScheduleEntry) {
			    // if entry exists in vendor_schedule proceed with update otherwise insert
			    $this->vendorScheduleEntryExists($newScheduleEntry) ? $this->updateVendorScheduleEntry($newScheduleEntry) : $this->insertVendorScheduleEntry($newScheduleEntry);
		    }

		    // delete remove vendor schedule entries
		    $this->deleteVendorScheduleEntry($removed);

		    $this->repository->getConnection()->commit();
	    } catch(PDOException $e) {
		    $this->repository->getConnection()->rollback();
		    throw new \Exception('failure during schedule update: no changes made');
	    }
    }

    /**
     * Searches removed entries from the new VendorSchedule referring to the original VendorSchedule
     * @param $vendorSchedule
     * @param $newSchedule
     * @return array
     */
    public function removedEntries($vendorSchedule, $newSchedule){
        $deletedEntries = array();
        foreach($vendorSchedule as $vendorScheduleEntry){
            if(!in_array($vendorScheduleEntry, $newSchedule))
                $deletedEntries[] = $vendorScheduleEntry;
        }

        return $deletedEntries;
    }

    /**
     * Checks whether a given VendorSchedule exists in the DB
     * @param $newScheduleEntry
     * @return mixed
     */
    public function vendorScheduleEntryExists($newScheduleEntry) {
        return $this->repository->checkEntryExists($newScheduleEntry);
    }

    /**
     * Updates a given VendorSchedule
     * @param $vendorScheduleEntry
     * @return mixed
     */
    public function updateVendorScheduleEntry($vendorScheduleEntry) {
        return $this->repository->updateScheduleEntry($vendorScheduleEntry);
    }

    /**
     * Inserts a given VendorSchedule
     * @param $vendorScheduleEntry
     * @return mixed
     */
    public function insertVendorScheduleEntry($vendorScheduleEntry) {
        return $this->repository->insertScheduleEntry($vendorScheduleEntry);
    }

    /**
     * Deletes a given VendorSchedule
     * @param $removed
     * @return mixed
     */
    private function deleteVendorScheduleEntry($removed) {
        foreach($removed as $entryToRemove) {
            $this->repository->deleteScheduleEntry($entryToRemove);
        }
    }

    /**
     * Deletes a VendorSchedule from the weekday
     * @param $weekday
     * @return mixed
     */
    public function deleteVendorScheduleEntryFromWeekday($weekday) {
        return $this->repository->deleteScheduleEntryFromWeekday($weekday);
    }
}
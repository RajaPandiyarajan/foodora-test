<?php
/**
* Developer: Raja Pandiyarajan
* Date: 22/06/2016
* Revision: 1
*/

namespace application\foodora\Controllers;

use application\foodora\Utility\Utility;

use application\foodora\Controllers\Helpers\MainController;

class allVendorScheduleBackupController extends MainController {

    use Utility;

    public function __construct(\application\foodora\Factory\Factory $factory) {
        parent::__construct($factory);
        $this->repository = $this->factory->create('application\foodora\Models\VendorScheduleBackupModel')->instance($this->factory->connection);
    }

    /**
     * Gets all the VendorFixScheduleBackupEntries
     * @return array
     */
    public function getAll() {
        $vendorFixScheduleBackupEntryEntries = array();
        foreach($this->repository->findAll() as $vendorFixScheduleBackupEntry) {
            $vendorFixScheduleBackupEntryEntries[] = $this->createObject($this->factory->create('application\foodora\Registry\VendorScheduleBackup'), $vendorFixScheduleBackupEntry);
        }

        return $vendorFixScheduleBackupEntryEntries;
    }

    /**
     * Creates a VendorFixScheduleBackup object
     * @param $vendorId
     * @param $scheduleEntry
     * @param $specialDay
     * @param $new
     * @return mixed
     */
    public function createFixScheduledBackup($vendorId, $scheduleEntry, $specialDay, $weekday, $new) {
        $vendorFixScheduleBackup = $this->factory->create('application\foodora\Registry\VendorScheduleBackup');
        $vendorFixScheduleBackup->setVendorId($vendorId);
        $vendorFixScheduleBackup->setScheduleId($scheduleEntry ? $scheduleEntry->getId() : null);
        $vendorFixScheduleBackup->setAlldayOld($scheduleEntry ? $scheduleEntry->getAllday() : null);
        $vendorFixScheduleBackup->setStartHourOld($scheduleEntry ? $scheduleEntry->getStartHour() : null);
        $vendorFixScheduleBackup->setStopHourOld($scheduleEntry ? $scheduleEntry->getStopHour() : null);
        $vendorFixScheduleBackup->setAllDayNew($specialDay->getAllday());
        $vendorFixScheduleBackup->setStartHourNew($specialDay->getStartHour());
        $vendorFixScheduleBackup->setStopHourNew($specialDay->getStopHour());
        $vendorFixScheduleBackup->setNew($new ? 1 : 0);
        $vendorFixScheduleBackup->setWeekday($weekday);
        return $vendorFixScheduleBackup;
    }

    public function createDbTable() {
        if(!$this->repository->createDbTable())
            throw new Exception('Unable to create vendor_schedule_backup table');

        return true;
    }

    /**
     * Saves all the entries into the DB
     * @param $vendorFixSchedulesBackup
     */
    public function save($vendorFixSchedulesBackup){
        $this->createDbTable();

        foreach($vendorFixSchedulesBackup as $vendorFixSchedulesBackupEntry)
            $this->repository->save($vendorFixSchedulesBackupEntry);
    }

    /**
     * Rollback all the temporary changes to vendor_schedule table
     * In case there's an error on a record it rollbacks everything
     * @param $vendorFixScheduleBackupEntries
     */
    public function rollbackSchedule($vendorFixScheduleBackupEntries) {
        $vendorScheduleService = $this->factory->create('application\foodora\Controllers\allVendorScheduleController');

	    try {
		    $this->repository->getConnection()->beginTransaction();

		    foreach($vendorFixScheduleBackupEntries as $vendorFixScheduleBackupEntry) {
				$this->rollbackVendorScheduleEntry($vendorScheduleService, $vendorFixScheduleBackupEntry);
		    }

		    $this->repository->getConnection()->commit();
	    } catch(PDOException $e) {
		    $this->repository->getConnection()->rollback();
		    throw new \Exception('failure during rollback schedule: no changes made');
	    }

        return true;
    }

	/**
	 * Rollsback a single entry
	 * @param $vendorScheduleService
	 * @param $vendorFixScheduleBackupEntry
	 */
	public function rollbackVendorScheduleEntry ($vendorScheduleService, $vendorFixScheduleBackupEntry) {
		if($vendorFixScheduleBackupEntry->getScheduleId()) {

			// check if exists schedule and proceed with either update or insert
			if($scheduleToUpdate = $vendorScheduleService->getById($this->factory->create('application\foodora\Registry\VendorSchedule'), $vendorFixScheduleBackupEntry->getScheduleId())) {

				$scheduleToUpdate->setAllday($vendorFixScheduleBackupEntry->getAllDayOld());
				$scheduleToUpdate->setStartHour($vendorFixScheduleBackupEntry->getStartHourOld());
				$scheduleToUpdate->setStopHour($vendorFixScheduleBackupEntry->getStopHourOld());

				$vendorScheduleService->updateVendorScheduleEntry($scheduleToUpdate);
			}else {
				$scheduleToInsert = $this->factory->create('application\foodora\Registry\VendorSchedule');

				$scheduleToInsert->setId($vendorFixScheduleBackupEntry->getScheduleId());
				$scheduleToInsert->setVendorId($vendorFixScheduleBackupEntry->getVendorId());
				$scheduleToInsert->setWeekday($vendorFixScheduleBackupEntry->getWeekday());
				$scheduleToInsert->setAllday($vendorFixScheduleBackupEntry->getAllDayOld());
				$scheduleToInsert->setStartHour($vendorFixScheduleBackupEntry->getStartHourOld());
				$scheduleToInsert->setStopHour($vendorFixScheduleBackupEntry->getStopHourOld());

				$vendorScheduleService->insertVendorScheduleEntry($scheduleToInsert);
			}
		} else {
			// remove schedule by weekday
			$vendorScheduleService->deleteVendorScheduleEntryFromWeekday($vendorFixScheduleBackupEntry->getWeekday());
		}
	}
} 
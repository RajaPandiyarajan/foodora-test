<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 22/06/2016
 * Revision: 1
 */

namespace application\foodora\Models;
use application\foodora\Models\Helpers\MainModel;

class VendorScheduleBackupModel extends MainModel {

    protected $tableName = 'vendor_schedule_backup';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    /**
     * Inserts a VendorFixScheduleBackup
     *
     * @param $vendorSchedulesBackupEntry
     * @return bool
     */
    public function save($vendorSchedulesBackupEntry) {
        $stmt = $this->db->prepare("INSERT INTO vendor_schedule_backup (vendor_id, schedule_id, all_day_old, start_hour_old, stop_hour_old, all_day_new, start_hour_new, stop_hour_new, new, weekday) VALUES (:vendor_id, :schedule_id, :all_day_old, :start_hour_old, :stop_hour_old, :all_day_new, :start_hour_new, :stop_hour_new, :new, :weekday)");
		$getVendorId = $vendorSchedulesBackupEntry->getVendorId();
		$getScheduleId = $vendorSchedulesBackupEntry->getScheduleId();
		$getAlldayOld = $vendorSchedulesBackupEntry->getAlldayOld();
		$getStartHourOld = $vendorSchedulesBackupEntry->getStartHourOld();
		$getStopHourOld = $vendorSchedulesBackupEntry->getStopHourOld();
		$getAlldayNew = $vendorSchedulesBackupEntry->getAlldayNew();
		$getStartHourNew = $vendorSchedulesBackupEntry->getStartHourNew();
		$getStopHourNew = $vendorSchedulesBackupEntry->getStopHourNew();
		$getNew = $vendorSchedulesBackupEntry->getNew();
		$getWeekday = $vendorSchedulesBackupEntry->getWeekday();

        $stmt->bindParam(':vendor_id', $getVendorId);
        $stmt->bindParam(':schedule_id', $getScheduleId);
        $stmt->bindParam(':all_day_old', $getAlldayOld);
        $stmt->bindParam(':start_hour_old', $getStartHourOld);
        $stmt->bindParam(':stop_hour_old', $getStopHourOld);
        $stmt->bindParam(':all_day_new', $getAlldayNew);
        $stmt->bindParam(':start_hour_new', $getStartHourNew);
        $stmt->bindParam(':stop_hour_new', $getStopHourNew);
        $stmt->bindParam(':new', $getNew);
        $stmt->bindParam(':weekday', $getWeekday);
        return $stmt->execute();
    }

	/**
	 * Creation of table vendor_schedule_backup
	 * @return mixed
	 */
    public function createDbTable() {
        $stmt = $this->db->prepare("CREATE TABLE `vendor_schedule_backup` (
	                                  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	                                  `vendor_id` bigint(1) unsigned NOT NULL,
	                                  `schedule_id` int(10) unsigned DEFAULT NULL,
	                                  `all_day_old` tinyint(1) unsigned DEFAULT NULL,
	                                  `start_hour_old` time DEFAULT NULL,
	                                  `stop_hour_old` time DEFAULT NULL,
	                                  `all_day_new` tinyint(1) unsigned NOT NULL,
	                                  `start_hour_new` time DEFAULT NULL,
	                                  `stop_hour_new` time DEFAULT NULL,
	                                  `new` tinyint(1) unsigned NOT NULL,
	                                  `weekday` bigint(1) unsigned NOT NULL,
	                                  PRIMARY KEY (`id`)
	                                ) ENGINE=InnoDB AUTO_INCREMENT=1000 DEFAULT CHARSET=latin1;");

        return $stmt->execute();
    }
} 
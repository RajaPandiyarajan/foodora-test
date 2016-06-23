<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 22/06/2016
 * Revision: 1
 */

namespace application\foodora\Models;
use application\foodora\Models\Helpers\MainModel;

class VendorScheduleModel extends MainModel {

    protected $tableName = 'vendor_schedule';

    public function __construct() {
        parent::__construct($this->tableName);
    }

    /**
     * Checks if a VendorSchedule exists
     * @param $scheduleEntry
     * @return mixed
     */
    public function checkEntryExists($scheduleEntry) {
        $sth = $this->db->prepare("SELECT id FROM " . $this->tableName . " where id = :id_schedule");
		$vendorScheduleId = $scheduleEntry->getId();
        $sth->bindParam(':id_schedule', $vendorScheduleId);
        $sth->execute();

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Updates a VendorSchedule
     * @param $scheduleEntry
     * @return mixed
     */
    public function updateScheduleEntry($scheduleEntry) {
        $sth = $this->db->prepare("update " . $this->tableName . " set all_day = :all_day, start_hour = :start_hour, stop_hour = :stop_hour where id = :id_schedule");
		$getAllDay = $scheduleEntry->getAllday();
		$getStartHour = $scheduleEntry->getStartHour();
		$getStopHour = $scheduleEntry->getStopHour();
		$getId = $scheduleEntry->getId();
        $sth->bindParam(':all_day', $getAllDay);
        $sth->bindParam(':start_hour', $getStartHour);
        $sth->bindParam(':stop_hour', $getStopHour);
        $sth->bindParam(':id_schedule', $getId);
        $sth->execute();

        return $sth->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Inserts a VendorSchedule
     * @param $scheduleEntry
     * @return bool
     */
    public function insertScheduleEntry($scheduleEntry) {
        $stmt = $this->db->prepare("INSERT INTO " . $this->tableName . " (id, vendor_id, weekday, all_day, start_hour, stop_hour) VALUES (:id, :vendor_id, :weekday, :all_day, :start_hour, :stop_hour)");

		$getAllDay = $scheduleEntry->getAllday();
		$getStartHour = $scheduleEntry->getStartHour();
		$getStopHour = $scheduleEntry->getStopHour();
		$getId = $scheduleEntry->getId() ? $scheduleEntry->getId() : null;
		$getVendorId = $scheduleEntry->getVendorId();
		$getWeekday = $scheduleEntry->getWeekday();

        $stmt->bindParam(':id', $getId);
        $stmt->bindParam(':vendor_id', $getVendorId);
        $stmt->bindParam(':weekday', $getWeekday);
        $stmt->bindParam(':all_day', $getAllDay);
        $stmt->bindParam(':start_hour', $getStartHour);
        $stmt->bindParam(':stop_hour', $getStopHour);

    }

    /**
     * Deletes a VendorSchedule
     * @param $scheduleEntry
     */
    public function deleteScheduleEntry($scheduleEntry) {
        $sth = $this->db->prepare("delete from " . $this->tableName . " where id = :id_schedule");
		$getId = $scheduleEntry->getId();
        $sth->bindParam(':id_schedule', $getId);

        return $sth->execute();
    }

    /**
     * Deletes a VendorSchedule from weekday
     * @param $scheduleEntry
     */
    public function deleteScheduleEntryFromWeekday($weekday) {
        $sth = $this->db->prepare("delete from " . $this->tableName . " where weekday = :weekday");
        $sth->bindParam(':weekday', $weekday);
        return $sth->execute();
    }
} 
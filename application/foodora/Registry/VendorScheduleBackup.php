<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 22/06/2016
 * Revision: 1
 */
namespace application\foodora\Registry;

/**
 * Class VendorScheduleBackup
 * @package application\foodora\Registry
 */
class VendorScheduleBackup {

	private $id;
	private $vendorId;
	private $scheduleId;
	private $allDayOld;
	private $startHourOld;
	private $stopHourOld;
	private $allDayNew;
	private $startHourNew;
	private $stopHourNew;
	private $new;
	private $weekday;

	/**
	 * @param mixed $allDayNew
	 */
	public function setAllDayNew($allDayNew) {
		$this->allDayNew = $allDayNew;
	}

	/**
	 * @return mixed
	 */
	public function getAllDayNew() {
		return $this->allDayNew;
	}

	/**
	 * @param mixed $allDayOld
	 */
	public function setAllDayOld($allDayOld) {
		$this->allDayOld = $allDayOld;
	}

	/**
	 * @return mixed
	 */
	public function getAllDayOld() {
		return $this->allDayOld;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $scheduleId
	 */
	public function setScheduleId($scheduleId) {
		$this->scheduleId = $scheduleId;
	}

	/**
	 * @return mixed
	 */
	public function getScheduleId() {
		return $this->scheduleId;
	}

	/**
	 * @param mixed $startHourNew
	 */
	public function setStartHourNew($startHourNew) {
		$this->startHourNew = $startHourNew;
	}

	/**
	 * @return mixed
	 */
	public function getStartHourNew() {
		return $this->startHourNew;
	}

	/**
	 * @param mixed $startHourOld
	 */
	public function setStartHourOld($startHourOld) {
		$this->startHourOld = $startHourOld;
	}

	/**
	 * @return mixed
	 */
	public function getStartHourOld() {
		return $this->startHourOld;
	}

	/**
	 * @param mixed $stopHourNew
	 */
	public function setStopHourNew($stopHourNew) {
		$this->stopHourNew = $stopHourNew;
	}

	/**
	 * @return mixed
	 */
	public function getStopHourNew() {
		return $this->stopHourNew;
	}

	/**
	 * @param mixed $stopHourOld
	 */
	public function setStopHourOld($stopHourOld) {
		$this->stopHourOld = $stopHourOld;
	}

	/**
	 * @return mixed
	 */
	public function getStopHourOld() {
		return $this->stopHourOld;
	}

	/**
	 * @param mixed $vendorId
	 */
	public function setVendorId($vendorId) {
		$this->vendorId = $vendorId;
	}

	/**
	 * @return mixed
	 */
	public function getVendorId() {
		return $this->vendorId;
	}

	/**
	 * @param mixed $new
	 */
	public function setNew($new) {
		$this->new = $new;
	}

	/**
	 * @return mixed
	 */
	public function getNew() {
		return $this->new;
	}

	/**
	 * @param mixed $weekday
	 */
	public function setWeekday($weekday) {
		$this->weekday = $weekday;
	}

	/**
	 * @return mixed
	 */
	public function getWeekday() {
		return $this->weekday;
	}
}
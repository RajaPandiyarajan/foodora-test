<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 22/06/2016
 * Revision: 1
 */
namespace application\foodora\Registry;

/**
 * Class VendorSchedule
 * @package application\foodora\Registry
 */
class VendorSchedule {

	private $id;
	private $vendorId;
	private $weekday;
	private $allDay;
	private $startHour;
	private $stopHour;

	/**
	 * @param mixed $allDay
	 */
	public function setAllDay($allDay) {
		$this->allDay = $allDay;
	}

	/**
	 * @return mixed
	 */
	public function getAllDay() {
		return $this->allDay;
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
	 * @param mixed $startHour
	 */
	public function setStartHour($startHour) {
		$this->startHour = $startHour;
	}

	/**
	 * @return mixed
	 */
	public function getStartHour() {
		return $this->startHour;
	}

	/**
	 * @param mixed $stopHour
	 */
	public function setStopHour($stopHour) {
		$this->stopHour = $stopHour;
	}

	/**
	 * @return mixed
	 */
	public function getStopHour() {
		return $this->stopHour;
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
<?php
/**
 * Developer: Raja Pandiyarajan
 * Date: 22/06/2016
 * Revision: 1
 */

namespace application\foodora\Utility;

/**
 * Trait used for some common function I may need to call from different resources
 * Class Utility
 * @package application\foodora\Utility
 */
trait Utility {

	/**
	 * Dynamically returns an object with properties set from DB column names
	 * @param object
	 * @param $objectElement array element
	 * @return object
	 */
	function createObject($object, $objectElement) {
		foreach ($objectElement as $key => $value) {
			$setter = 'set' . $this->camelCaseConvertion($key);
			$object->$setter($value);
		}

		return $object;
	}

	/**
	 * Converts foo_bar into fooBar
	 * @param $key
	 * @param bool $capitalize
	 * @return string
	 */
	function camelCaseConvertion($key, $capitalize = true) {
		$camelized = str_replace(' ', '', ucwords(str_replace('_', ' ', $key)));

		if (!$capitalize) {
			$camelized[0] = strtolower($camelized[0]);
		}

		return $camelized;
	}

	/**
	 * Returns the weekday from a given date
	 * @param $date
	 * @return bool|string
	 */
	function getWeekdayFromDate($date) {
		return date("w", strtotime($date));
	}
}
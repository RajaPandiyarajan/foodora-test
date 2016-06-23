<?php
require_once('defaults/common.php');
use application\foodora\Factory\Factory;

try {
	$factory = new Factory(dbConnect()); 
	$allVendorScheduleBackupController = $factory->create('application\foodora\Controllers\allVendorScheduleBackupController');
	$vendorScheduleBackupEntries = $allVendorScheduleBackupController->getAll();
	$isDone = $allVendorScheduleBackupController->rollbackSchedule($vendorScheduleBackupEntries);
	echo 'Rollback done to default';
} catch (Exception $e) {
	echo 'Problem occurred ' . $e->getMessage();
}
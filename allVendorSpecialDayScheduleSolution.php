<?php
require_once('defaults/common.php');
use application\foodora\Factory\Factory;
try {
	$factory = new Factory(dbConnect()); 
	$allVendorController = $factory->create('application\foodora\Controllers\allVendorController');
	$vendors = $allVendorController->getAll();
	$allVendorScheduleBackupController = $factory->create('application\foodora\Controllers\allVendorScheduleBackupController');
	$allVendorScheduleController = $factory->create('application\foodora\Controllers\allVendorScheduleController');
	foreach($vendors as $vendor){
		list($vendorScheduleModified, $vendorSchedulesBackup) = $allVendorController->fixSchedule($vendor);
		$removed = $allVendorScheduleController->removedEntries($vendor->getSchedules(), $vendorScheduleModified);
		$allVendorScheduleController->updateVendorSchedule($vendorScheduleModified, $removed);
		$allVendorScheduleBackupController->save($vendorSchedulesBackup);
	}
	echo 'Vendor Special day Schedule has been done.';
} catch (Exception $e) {
	echo 'Problem occurred ' . $e->getMessage();
}

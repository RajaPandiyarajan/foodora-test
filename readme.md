# foodora test bug description
Foodora task for Vendor Special days activities

---------Bug short description--------------

php scripts have been created to create special week for all vendor schedule between 21st DEC to 27th DEC run on dec 20th and the rollback script for revert back the changes on dec 28th.

-----------Steps to run---------------------

1. Checkout the repository
2. Create a foodora-test database and import your DUMP.
3. if any modicfication in the database information please change that here defaults/defaults.php
2. Run the scripts

-----------Execution of script---------------

Execute this php script on December 20th at 23:00: allVendorSpecialDayScheduleSolution.php

Execute this php script on December 28th at 01:00: php allVendorSpecialDayScheduleRollback.php


-----------Considerations--------------------

PHP script "allVendorSpecialDayScheduleSolution.php" will create a "vendor_schedule_backup" table to temporarily save the changes affected to the vendor_schedule table.

PHP script "allVendorSpecialDayScheduleRollback.php" will read from the "vendor_schedule_backup" table and rollback everything modifying only the records that have been affected.


Thanks


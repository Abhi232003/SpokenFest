<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-10-18 13:18:12 --> 404 Page Not Found: Assets/images
ERROR - 2023-10-18 19:22:59 --> Query error: Table 'websitedemo_magnitude_lp.fx_register' doesn't exist - Invalid query: SHOW COLUMNS FROM `fx_register`
ERROR - 2023-10-18 21:45:34 --> Severity: Warning --> require(C:\wamp64\www\durgafund-dev\application\third_party/spreadsheet-reader-master/php-excel-reader/excel_reader2.php): Failed to open stream: No such file or directory C:\wamp64\www\durgafund-dev\application\controllers\admin\Register.php 15
ERROR - 2023-10-18 21:45:34 --> Severity: error --> Exception: Failed opening required 'C:\wamp64\www\durgafund-dev\application\third_party/spreadsheet-reader-master/php-excel-reader/excel_reader2.php' (include_path='.;C:\php\pear') C:\wamp64\www\durgafund-dev\application\controllers\admin\Register.php 15
ERROR - 2023-10-18 21:50:52 --> Query error: Unknown column 'contactId' in 'field list' - Invalid query: SELECT `contactId`, `regName`, `regEmail`, `regMobile`, `regArea`, `regCity`, `regPincode`, `dateAdded`
FROM `fx_register`
WHERE DATE(dateAdded) >= '1969-12-31'
AND DATE(dateAdded) <= '1969-12-31'
ERROR - 2023-10-18 21:51:18 --> Query error: Table 'durga_landing.fx_contact' doesn't exist - Invalid query: SELECT *
FROM `fx_contact`
WHERE `status` = 1

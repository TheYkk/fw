<?php
/*************************************************
 * TheYkk's fw
 * System Starter
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/

// Constants
require_once 'Constants.php';

// Helpers
require_once 'Helpers.php';

// Error Reporting
if (ENV == 'production') {
    error_reporting(0);
    ini_set('display_errors', 0);
} else {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}

// Set default timezone
date_default_timezone_set(TIMEZONE);

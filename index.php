<?php
/*************************************************
 * TheYkk's fw
 * Simple and Modern Web Application Framework
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Version 	: 2.2.0
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/

// Require Composer Autoload
require_once __DIR__ . '/vendor/autoload.php';

// Require Starter
require_once __DIR__ . '/System/Kernel/Starter.php';

// Run Kernel
new System\Kernel\Kernel();

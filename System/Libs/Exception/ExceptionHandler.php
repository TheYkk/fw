<?php
/*************************************************
 * TheYkk's fw
 * Exception Handler Library
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
namespace System\Libs\Exception;

use Exception;

class ExceptionHandler
{
	public function __construct($title, $body)
	{
		throw new Exception(strip_tags($title . ': ' . $body), 1);
	}
}

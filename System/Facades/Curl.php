<?php
/*************************************************
 * TheYkk's fw
 * Facade of Curl Library
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
namespace System\Facades;

use System\Facades\Facade;

class Curl extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @param string
	 */
	protected static function getFacadeAccessor()
	{
		return 'Curl';
	}

}

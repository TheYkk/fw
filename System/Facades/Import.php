<?php
/*************************************************
 * TheYkk's fw
 * Facade of Import Library
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

class Import extends Facade
{

	/**
	 * Get the registered name of the component.
	 *
	 * @param string
	 */
	protected static function getFacadeAccessor()
	{
		return 'Import';
	}

}

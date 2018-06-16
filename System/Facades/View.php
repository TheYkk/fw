<?php
/*************************************************
 * TheYkk's fw
 * Facade of View Library
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

class View extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @param string
     * @return string
     * @throws \Exception
     */
	protected static function getFacadeAccessor()
	{
		return 'View';
	}

}

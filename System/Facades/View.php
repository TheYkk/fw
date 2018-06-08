<?php
/*************************************************
 * Titan-2 Mini Framework
 * Facade of View Library
 *
 * Author 	: Turan Karatuğ
 * Web 		: http://www.titanphp.com
 * Docs 	: http://kilavuz.titanphp.com
 * Github	: http://github.com/tkaratug/titan2
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

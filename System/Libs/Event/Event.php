<?php
/*************************************************
 * TheYkk's fw
 * Event Library
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
namespace System\Libs\Event;

use System\Libs\Exception\ExceptionHandler;

class Event
{

	/**
	 * Trigger an event
	 *
	 * @param string $event
	 * @param string $method
	 * @param array $params
	 * @return void
	 */
	public function trigger($event, $method = 'handle', $params = [])
	{
		$listeners 	= config('services.listeners');

		foreach ($listeners[$event] as $listener) {

			if (!class_exists($listener))
				throw new ExceptionHandler('Listener sınıfı bulunamadı.', $listener);

			if (!method_exists($listener, $method))
				throw new ExceptionHandler('Listener sınıfına ait method bulunamadı.', $listener . '::' . $method . '()');

			call_user_func_array(array(new $listener, $method), $params);

		}
	}

}

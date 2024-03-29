<?php
/*************************************************
 * TheYkk's fw
 * Controller
 *
 * Author   : Yusuf Kaan Karakaya
 * Web      : http://theykk.net
 *
 * Github   : http://github.com/theykk/fw
 * License  : MIT
 *
 *************************************************/
namespace System\Kernel;

class Controller
{
    public function __construct()
    {
        // Run default middlewares
		$this->middleware(config('services.middlewares.default'), true);
    }

    /**
	 * Run middlewares at first
	 *
	 * @param array $middleware
	 * @param bool $default
	 * @return void
	 */
	protected function middleware(array $middlewares, bool $default = false)
	{
		if ($default === false) {
			$list = config('services.middlewares.manual');

			foreach ($middlewares as $middleware) {
				$middleware = ucfirst($middleware);
				if (array_key_exists($middleware, $list)) {
					if (class_exists($list[$middleware])) {
						call_user_func_array([new $list[$middleware], 'handle'], []);
					}
				}
			}
		} else {
			foreach ($middlewares as $key => $val) {
				if (class_exists($val)) {
					call_user_func_array([new $val, 'handle'], []);
				}
			}
		}
	}
}

<?php
/*************************************************
 * TheYkk's fw
 * CDN Library
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
 *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
namespace System\Libs\CDN;

use System\Libs\Exception\ExceptionHandler;

class CDN
{

    /**
     * Auto cdn type detect
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        return config('cdn.'.$name)[$arguments[0]];
    }

}

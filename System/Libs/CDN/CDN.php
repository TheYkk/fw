<?php
namespace System\Libs\CDN;

use System\Libs\Exception\ExceptionHandler;

class CDN
{

    /**
     * @param $name
     * @return mixed
     */
    public function script($name)
    {
        return config('cdn.scripts')[$name];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function style($name)
    {
        return config('cdn.styles')[$name];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function file($name)
    {
        return config('cdn.files')[$name];
    }

    /**
     * @param $name
     * @return mixed
     */
    public function font($name)
    {
        return config('cdn.fonts')[$name];
    }


}

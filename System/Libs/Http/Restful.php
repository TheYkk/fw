<?php
/*************************************************
 * TheYkk's fw
 * Restful Client Library
 *
 * Author   : Yusuf Kaan Karakaya
 * Web      : http://theykk.net
 *
 * Github   : http://github.com/theykk/fw
 * License  : MIT
 *
 *************************************************/
namespace System\Libs\Http;

use Curl;
use System\Libs\Exception\ExceptionHandler;

class Restful
{

    /**
     * Makes get request
     *
     * @param string $url
     * @param array $data
     * @return void
     */
    public function get($url, $data = [])
    {
        if (!is_null($url))
            Curl::get($url, $data);
        else
            throw new ExceptionHandler("Parametre hatası", "URL bilgisi gerekli.");
    }

    /**
     * Makes post request
     *
     * @param string $url
     * @param array $data
     * @return void
     */
    public function post($url, $data = [])
    {
        if (!is_null($url))
            Curl::post($url, $data);
        else
            throw new ExceptionHandler("Parametre hatası", "URL bilgisi gerekli.");
    }

    /**
     * Makes put request
     *
     * @param string $url
     * @param array $data
     * @return void
     */
    public function put($url, $data = [])
    {
        if (!is_null($url))
            Curl::put($url, $data);
        else
            throw new ExceptionHandler("Parametre hatası", "URL bilgisi gerekli.");
    }

    /**
     * Makes delete request
     *
     * @param string $url
     * @param array $data
     * @return void
     */
    public function delete($url, $data = [])
    {
        if (!is_null($url))
            Curl::delete($url, $data);
        else
            throw new ExceptionHandler("Parametre hatası", "URL bilgisi gerekli.");
    }

    /**
     * Define Request Header
     *
     * @param array|string $header
     * @return array|string
     */
    public function setHeader($header, $value = null)
    {
        if (!is_null($header))
            Curl::setHeader($header, $value);
        else
            throw new ExceptionHandler("Parametre hatası", "Header bilgisi gerekli.");

        return $this;
    }

    /**
     * Returns response
     *
     * @return string
     */
    public function response()
    {
        return Curl::responseBody();
    }

    /**
     * Returns status code
     *
     * @return integer
     */
    public function statusCode()
    {
        return Curl::responseHeader('Status-Code');
    }

}

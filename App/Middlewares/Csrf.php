<?php
namespace App\Middlewares;

use Session;
use System\Libs\Exception\ExceptionHandler;

class Csrf
{
    public function handle()
    {
        if (Session::has('ykk_token')) {
            if (request('csrf_token') == Session::get('ykk_token')) {
                Session::delete('ykk_token');
                return true;
            } else {
                throw new ExceptionHandler("Hata", "CSRF Token does not match");
            }
        } else {
            return true;
        }
    }
}

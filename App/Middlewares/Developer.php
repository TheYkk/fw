<?php
/**
 * Created by PhpStorm.
 * User: TheYkk
 * Date: 24.08.2018
 * Time: 02:05
 */

namespace App\Middlewares;

use Request;

class Developer
{

    public static function handle()
    {
        if(Request::headers('devop')==config('app.general.devoloper_key')){

        }else{
            die('Izin yok');
        }
    }

}

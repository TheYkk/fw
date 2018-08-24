<?php
namespace App\Controllers\Frontend;

use System\Kernel\Controller;
use Log;


class Home extends Controller
{

	public function index()
	{
        /*Log::debug('sa');
        Log::alert('sistem patladi');
        $var = array(
            'a simple string' => "in an array of 5 elements",
            'a float' => 1.0,
            'an integer' => 1,
            'a boolean' => true,
            'an empty array' => array(true,'sa'=>2),
        );
        debug($var);*/
        Log::show();

    }

}

<?php
namespace App\Controllers\Frontend;

use System\Kernel\Controller;



class Home extends Controller
{

	public function index()
	{
        $var = array(
            'a simple string' => "in an array of 5 elements",
            'a float' => 1.0,
            'an integer' => 1,
            'a boolean' => true,
            'an empty array' => array(true,'sa'=>2),
        );
        debug($var);
    }

}

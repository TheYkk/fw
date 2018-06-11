<?php
namespace App\Controllers\Frontend;

use System\Kernel\Controller;

use CDN;
class Home extends Controller
{

	public function index()
	{
       echo CDN::script('vue');

    }

}

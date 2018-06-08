<?php
namespace App\Controllers\Frontend;

use System\Kernel\Controller;

use CDN;
use Html;
class Home extends Controller
{

	public function index()
	{
        echo Html::style( CDN::style('awesome'));

    }

}

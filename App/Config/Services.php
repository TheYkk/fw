<?php
/*************************************************
 * TheYkk's fw
 * Providers, facades, middlewares and listeners
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
return [

	/**
	 * Service Providers
	 */
	'providers'		=> [
		'Import'			=> System\Kernel\Import::class,
		'Config'			=> System\Kernel\Config::class,
		'Request'			=> System\Libs\Http\Request::class,
		'Response'			=> System\Libs\Http\Response::class,
		'View'				=> System\Libs\View\View::class,
		'Session'			=> System\Libs\Session\Session::class,
		'Cookie'			=> System\Libs\Cookie\Cookie::class,
		'DB'				=> System\Libs\Database\DB::class,
		'Model'				=> System\Libs\Database\Model::class,
        'Log'				    => System\Libs\Log\Log::class,

        //not used too much
        //        'Pagination'		    => System\Libs\Pagination\Pagination::class,
        //        'Event'				=> System\Libs\Event\Event::class,
        //        'Upload'			    => System\Libs\Upload\Upload::class,
        //        'Benchmark'			=> System\Libs\Benchmark\Benchmark::class,
        //        'Image'				=> System\Libs\Image\Image::class,
        //        'Hash'				=> System\Libs\Hashing\Hash::class,
        //        'Jwt'				    => System\Libs\Http\Jwt::class,
        //        'Curl'				=> System\Libs\Http\Curl::class,
        //        'Restful'			    => System\Libs\Http\Restful::class,
        //        'Validation'		    => System\Libs\Validation\Validation::class,
        //        'Mail'				=> System\Libs\Mail\Mail::class,
        //        'Html'				=> System\Libs\Html\Html::class,
        //        'Form'				=> System\Libs\Html\Form::class,
        //        'Date'				=> System\Libs\Date\Date::class,
        //        'CDN'				    => System\Libs\CDN\CDN::class,
        //        'Cache'				=> System\Libs\Cache\Cache::class,
        //        'Log'				    => System\Libs\Log\Log::class,
	],

	/**
	 * Facades
	 */
	'facades'		=> [
		'Import'			=> System\Facades\Import::class,
		'Config'			=> System\Facades\Config::class,
		'Request'			=> System\Facades\Request::class,
		'Response'			=> System\Facades\Response::class,
		'View'				=> System\Facades\View::class,
		'Session'			=> System\Facades\Session::class,
		'Cookie'			=> System\Facades\Cookie::class,
		'DB'				=> System\Facades\DB::class,
		'Model'				=> System\Facades\Model::class,
        'Log'				=> System\Facades\Log::class,
        //not used too much
        //        'Event'				=> System\Facades\Event::class,
        //        'Pagination'		    => System\Facades\Pagination::class,
        //        'Upload'			    => System\Facades\Upload::class,
        //        'Image'				=> System\Facades\Image::class,
        //        'Hash'				=> System\Facades\Hash::class,
        //        'Benchmark'			=> System\Facades\Benchmark::class,
        //        'Jwt'				    => System\Facades\Jwt::class,
        //        'Cache'				=> System\Facades\Cache::class,
        //        'Log'				    => System\Facades\Log::class,
        //        'Validation'		    => System\Facades\Validation::class,
        //        'Curl'				=> System\Facades\Curl::class,
        //        'Restful'			    => System\Facades\Restful::class,
        //        'Date'				=> System\Facades\Date::class,
        //        'CDN'				    => System\Facades\CDN::class,
        //        'Mail'				=> System\Facades\Mail::class,
        //        'Html'				=> System\Facades\Html::class,
        //        'Form'				=> System\Facades\Form::class,
	],

	/**
	 * Middlewares
	 */
	'middlewares'	=> [
		'default'	=> [],
		'manual'	=> []
	],

	/**
	 * Listeners
	 */
	'listeners'		=> []

];

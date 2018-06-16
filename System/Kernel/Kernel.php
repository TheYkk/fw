<?php
/*************************************************
 * TheYkk's fw
 * System Core
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
namespace System\Kernel;

use System\Libs\Router\Router;
use System\Facades\Facade;
use Whoops\Run as WhoopsRun;
use Whoops\Handler\PrettyPageHandler as WhoopsPrettyPageHandler;

class Kernel
{

	public function __construct()
	{
		// Initialize Whoops Error Handler
		$this->initWhoops();

		// Initialize Config
		$this->initApplications();

		// Getting Routes
		Import::config('routes');

		// Starting Router
		Router::run();
	}

	/**
	 * Whoops Initializer
	 *
	 * @return object
	 */
	private function initWhoops()
	{
		$whoops = new WhoopsRun;
		$whoops->pushHandler(new WhoopsPrettyPageHandler);
		$whoops->register();

		return $this;
	}

    /**
     * Application Initializer
     *
     * @return void
     * @throws \Exception
     */
    private function initApplications()
	{
		$app = Import::config('services');

		// Prepare Facades
		Facade::clearResolvedInstances();
		Facade::setFacadeApplication($app);

		// Create Aliases
		foreach ($app['facades'] as $key => $value) {
			if (!class_exists($key))
				class_alias($value, $key);
		}
	}

}

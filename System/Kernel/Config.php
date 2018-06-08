<?php
/*************************************************
 * TheYkk's fw
 * Config Library
 *
 * Author 	: Yusuf Kaan Karakaya
 * Web 		: http://theykk.net
  *
 * Github	: http://github.com/theykk/fw
 * License	: MIT
 *
 *************************************************/
namespace System\Kernel;

class Config
{

	/**
	 * Get config item
	 *
	 * @param string $params
	 * @return mixed
	 */
	public function get($params)
	{
		// Explode items
		$keys 	= explode('.', $params);

		// Set config file
		$file 	= $keys[0];

		// Get config file
		$config = Import::config($file);

		// Remove file item from array
		array_shift($keys);

		// Find the item that requested
		foreach($keys as $key) {
			$config = $config[$key];
		}

		// return the item
		return $config;
	}

}

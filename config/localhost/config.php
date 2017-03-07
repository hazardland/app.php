<?php

	use \Core\Cache;

	if (function_exists('apcu_store'))
	{
		Cache::init(new \Core\Cache\Driver\APCu());
	}
	else if (function_exists('apc_store'))
	{
		Cache::init(new \Core\Cache\Driver\APC());
	}


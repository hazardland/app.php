<?php

	error_reporting(E_ALL);

	/*
		used constants:
		SERVER - env name
		CONFIG,LIB,APP - paths

		CHOOSE APP ENV
	*/

	//on what environment we are
	//might be defined from outside
	if (file_exists(__DIR__.'/server.php'))
	{
		include __DIR__.'/server.php';
	}
	//define define environment name (not hostname!)
	if (!defined('SERVER'))
	{
		define('SERVER','localhost');
	}

	/*
		DEFINE PATH
		(dirname(__DIR__) returns one level up folder)
	*/
	//Define common config folder
	if (!defined('CONFIG'))
	{
		define ('CONFIG',dirname(__DIR__).'/config');
	}
	//Define common lib folder
	if (!defined('LIB'))
	{
		define ('LIB',dirname(__DIR__).'/lib');
	}
	//Define app base folder
	if (!defined('APP'))
	{
		define ('APP',__DIR__);
	}

	/*
		PREPARE ENV
	*/

	//if you prefer composer include /vendor/autoload.php
	//commenting composer autoloader include will not break things
	if (file_exists(dirname(__dir__).'/vendor/autoload.php'))
	{
    	require dirname(__dir__).'/vendor/autoload.php';
	}

	/*
		PSR-4 autoloader from APP and LIB folders:

		\App\Namespace2\Class1 => APP.src\Namespace2\Class1.php
		\OtherNamespace1\Namespace2\Class1 => LIB.othernamespace1\src\Namespace2\Class1.php

		This autoloader works independetly from composer autoloader
	*/
	spl_autoload_register(function ($class)
	{
	    $file = str_replace ('\\', '/', ltrim ($class, '\\')).'.php';
	    if (strpos($file,'/'))
	    {
	    	$module = strtolower(substr($file,0,strpos($file,'/')));
	    	$path = substr($file,strpos($file,'/')+1);
	    }
	    if (isset($module) && $module==='app' && defined('APP') && file_exists(APP.'/src/'.$path))
	    {
			require APP.'/src/'.$path;
	    }
	    else if (defined('LIB') && isset($module) && file_exists(LIB.'/'.$module.'/src/'.$path))
	    {
			require LIB.'/'.$module.'/src/'.$path;
	    }
	});

	class_alias('\Core\App', 'App');
	class_alias('\Core\Database', 'Database');
	class_alias('\Core\Session', 'Session');
	class_alias('\Core\Cookie', 'Cookie');
	class_alias('\Core\Cache', 'Cache');
	class_alias('\Core\View', 'View');
	class_alias('\Core\Input', 'Input');
	class_alias('\Core\Method', 'Method');
	class_alias('\Core\Route', 'Route');
	class_alias('\Core\Action', 'Action');
	class_alias('\Core\Request', 'Request');
	class_alias('\Core\Auth', 'Auth');

	//this is very cool variable visaulizer module
	if (file_exists(LIB.'/debug/debug.php'))
	{
		include LIB.'/debug/debug.php';
	}

	// Load common config if it exists
	if (file_exists(CONFIG.'/'.SERVER.'/config.php'))
	{
		include CONFIG.'/'.SERVER.'/config.php';
	}

	// Load app config if it exists
	if (file_exists(APP.'/config/'.SERVER.'/config.php'))
	{
		include APP.'/config/'.SERVER.'/config.php';
	}

	//Set locale
	//App::setLocale('en');

	//Open session here if you are not sure
	//That you can hold your echoes before headers

	if (file_exists(APP.'/before.php'))
	{
		include APP.'/before.php';
	}

	if (file_exists(APP.'/filters.php'))
	{
		include APP.'/filters.php';
	}

	if (file_exists(APP.'/routes.php'))
	{
		include APP.'/routes.php';
	}

	ob_start ();

	App::run (new Request(isset($_REQUEST['query'])?$_REQUEST['query']:null, $_SERVER['REQUEST_METHOD']));

	if (file_exists(APP.'/after.php'))
	{
		include APP.'/after.php';
	}

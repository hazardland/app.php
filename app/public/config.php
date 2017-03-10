<?php

	/*
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
	*/
	//define config folder
	define ('CONFIG',dirname(dirname(__DIR__)).'/config');
	//define common lib folder
	define ('LIB',dirname(dirname(__DIR__)).'/lib');
	//define app non common lib folder
	define ('APP',dirname(dirname(__DIR__)).'/app');


	/*
		PREPARE ENV
	*/

	//if you prefer composer include /vendor/autoload.php
	//commenting composer autoloader include will not break things
	if (file_exists(dirname(dirname(__DIR__)).'/vendor/autoload.php'))
	{
    	require dirname(dirname(__DIR__)).'/vendor/autoload.php';
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

	//this is very cool variable visaulizer module
	if (file_exists(LIB.'/debug/debug.php'))
	{
		include LIB.'/debug/debug.php';
	}

	if (file_exists(CONFIG.'/'.SERVER.'/config.php'))
	{
		include CONFIG.'/'.SERVER.'/config.php';
	}

	\Core\Database::setPath(CONFIG.'/'.SERVER.'/database');
	\Core\View::setPath(APP.'/view');

	//Open session here if you are not sure
	//That you can hold your echoes before headers

	\Core\Session::open ();
	ob_start ();

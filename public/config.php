<?php

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

	//define config folder
	define ('CONFIG',dirname(__DIR__).'/config');
	//define common lib folder
	define ('LIB',dirname(__DIR__).'/lib');
	//define app non common lib folder
	define ('APP',dirname(__DIR__).'/app');

	//if you prefer composer
	if (file_exists(dirname(__DIR__).'/vendor/autoload.php'))
	{
    	require dirname(__DIR__).'/vendor/autoload.php';
	}

	//psr-4 autoloader from common and project folder
	//if you just want to do without composer in veteran mode
	//project folder has priority while searching class file
	spl_autoload_register(function ($class)
	{
	    $file = str_replace ('\\', '/', ltrim ($class, '\\')).'.php';
	    if (strpos($file,'/'))
	    {
	    	$module = strtolower(substr($file,0,strpos($file,'/')));
	    	$path = substr($file,strpos($file,'/')+1);
	    }
	    //debug (APP.'src/'.$path,'module '.($module==='app' && defined('APP') && file_exists(APP.'src/'.$path)));
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

	if (file_exists(CONFIG.SERVER.'/config.php'))
	{
		include CONFIG.SERVER.'/config.php';
	}

	\Core\Database::setPath(CONFIG.'/database/');
	\Core\View::setPath(APP.'/view');

	//Open session here if you are not sure
	//That you can hold your echoes before headers
	//\Core\Session::open ();

	ob_start ();

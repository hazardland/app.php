<?php

    include dirname(__DIR__).'/config.php';

    use \Core;

    error_reporting(E_ALL);

    //debug ($_REQUEST, '$_REQUEST');
    //debug ($_SERVER, '$_SERVER');

    //use \App\Route;
    //Route::add ('blog/{id}-[*]');

    /*
    use \App\App;
    App::addLocale ('en');
    App::addLocale ('ge');
    if (!isset($_SESSION['locale']))
    {
        App::setLocale('ge');
    }
    debug (App::getLocale());

    use \App\Cache;
    if (!Cache::exists("key1"))
    {
        Cache::set ("key1","value");
        debug ("setting key1 to cache");
    }
    else
    {
        debug ("value key1 exists in cache");
    }
    debug(Cache::get("key1"));

    use \App\Database;
    $result = Database::get()->query("SELECT 1");
   use \App\Session;
   $array[1]='it works';
   Session::set("array",$array);
   debug(Session::get("array")[1]);
   debug(Session::get("arrayx")[5]);
    */

   App::addLocale('en');

   $home = new \App\Controller\Home ();
   $home->index('brother');


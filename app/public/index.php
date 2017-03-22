    <?php

    //const APP = '/var/www/site.com';
    //const LIB = '/var/www/lib';

    include dirname(__DIR__).'/app.php';
    //debug (Route::$actions);
    //debug ($_REQUEST['query']);

    //debug (Route::match('home/1/00.001/hazardland@gmail.com'),'RESULT');
    //debug (Route::match('home/1/00.001/hazardland@gmail.com'),'RESULT');
    //debug(Route::match('games/casino-2'));

    //debug ($_REQUEST, '$_REQUEST');
    //debug ($_SERVER, '$_SERVER');

    //Route::add ('blog/{id}-[*]');

    /*
    App::addLocale ('en');
    App::addLocale ('ge');
    if (!isset($_SESSION['locale']))
    {
        App::setLocale('ge');
    }
    debug (App::getLocale());

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

    $array[1]='it works';
    Session::set("array",$array);
    debug(Session::get("array")[1]);
    debug(Session::get("arrayx")[5]);
    */

    $result = Database::get()->query("SELECT 1");
    App::addLocale('en');

    /*
    $home = new \App\Controller\Home ();
    $home->index('brother');
    */


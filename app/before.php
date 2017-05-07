<?php

    //This file is included before App::run()

    App::addLocale('en', true);
    App::addLocale('fr');
    App::addLocale('ge');

    Session::open ();

    Auth::addDriver (new \Core\Auth\Driver\Basic());
    Auth::setModel (new \Core\Auth\Model\Table());

    //Session::setPrefix('myApp');
    //Cache::setPrefix('myApp');

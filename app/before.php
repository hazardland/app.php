<?php

    //This file is included before App::run()

    App::addLocale('en', true);
    App::addLocale('fr');
    App::addLocale('ge');

    Session::open ();

    //Auth::addDriver (new \User\Auth\Table());
    //Auth::setModel (new \User\Auth\Table());

    //Session::setPrefix('myApp');
    //Cache::setPrefix('myApp');

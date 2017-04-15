<?php

    //This file is included before App::run()

    App::addLocale('en', true);
    App::addLocale('fr');
    App::addLocale('ge');

    Session::open ();

    //Session::setPrefix('myApp');
    //Cache::setPrefix('myApp');

<?php

    if (function_exists('apcu_store'))
    {
        Cache::init(new \Core\Cache\Driver\APCu());
    }
    else if (function_exists('apc_store'))
    {
        Cache::init(new \Core\Cache\Driver\APC());
    }

    Database::add (
        'mysql:host=127.0.0.1;dbname=test;charset=utf8', //dsn
        'root', //user
        '', //password
        [\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES=>false], //options
        'default' //name
    );

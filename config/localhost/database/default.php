<?php

	use \Core\Database;

    Database::add(new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8','root',''), 'default');
    Database::get('default')->setAttribute (\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    Database::get('default')->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

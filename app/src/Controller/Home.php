<?php

    namespace App\Controller;

    use \Core\View;

    class Home
    {
        public function __construct()
        {
            View::render('test');
        }
    }

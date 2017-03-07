<?php

    namespace App\Controller;

    use \Core\View;

    class Home
    {
        public function index()
        {
            View::render('home');
        }
    }

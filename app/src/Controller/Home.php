<?php

    namespace App\Controller;

    class Home
    {
        public function index ()
        {
            \View::render('home');
        }
    }

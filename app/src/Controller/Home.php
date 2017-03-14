<?php

    namespace App\Controller;

    use \Core\View;

    class Home
    {
        public function index ($message)
        {
            View::render('home',['message'=>$message]);
        }
    }

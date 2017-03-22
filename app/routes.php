<?php

    Route::add ('casino-{id}', function($number){});
    Route::add ('home/{number1}/{number2}/{email}', 'Home@index')->where('number1',Input::INT)->where('number2',Input::FLOAT)->where('email',Input::EMAIL);
    Route::add ('home/post-{number}', 'Console.Home@index');
    Route::add ('casino', '');
    Route::add ('/', '');

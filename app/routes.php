<?php

    Route::add ('home/{number}', function($number){});
    Route::add ('home/{number}', 'Home@index');
    Route::add ('home/{number}', 'Console.Home@index');
    Route::group (['prefix'=>'home'], function(){
        Route::add('number', function(){});
    });

    debug (Route::match('home'));

<?php

    Route::get ('casino-{id}', function($number){
        echo 'casino '.$number;
    })
    ->where('id',Input::INT);

    Route::get ('home/{number1}/{number2}/{email}', 'Home@index')
    ->where('number1',Input::INT)
    ->where('number2',Input::FLOAT)
    ->where('email',Input::EMAIL);

    Route::get ('blog/article/{id}-{title}', function($id){
        if (App::getLocale()=='ge')
        {
            echo "პოსტი არის ".$id;
        }
        else
        {
            echo "post id ".$id;
        }
        echo "<br>";
        $url = Route::url('blog.article',['id'=>$id+1,'title'=>'titlexxx']);
        echo "<a href='".$url."'>".$url."</a>";
    })
    ->where('id',Input::INT)
    ->name('blog.article');

    Route::get ('casino', function(){
        echo "just casino";
    });

    Route::get ('/', function(){
        echo "home";
    });

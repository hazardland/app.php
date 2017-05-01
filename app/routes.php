<?php

    Route::add ('profile',function(){
        echo "Profile";
    })
    ->filter('user',['redirect'=>'login']);

    Route::add ('login',function(){
        echo "Please login";
    })
    ->filter('guest');

    Route::add ('home', 'Home@index');

    Route::add ('/', 'Home@index');

    Route::group(['filter'=>['csrf'=>[Method::POST],'user'=>true]],function(){

    });

    Route::get ('casino-{id}', function($number){
        echo 'casino '.$number;
    })
    ->input('id',Input::INT)
    ->filter('user')
    ->filter('guest')
    ->filter('csrf');

    Route::get ('home/{number1}/{number2}/{email}', 'Home@index')
    ->input('number1',Input::INT)
    ->input('number2',Input::FLOAT)
    ->input('email',Input::EMAIL);

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
    ->input('id',Input::INT)
    ->name('blog.article');

    Route::get ('casino', function(){
        echo "just casino";
    });

    Route::get ('/', function(){
        echo "home";
        echo "<a href='".Route::url('blog/article/1-xxx')."'>Article 1</a>";
    });


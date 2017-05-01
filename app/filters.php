<?php

    Route::filter ('csrf',function($action, $request, $options){
        if (in_array($request->getMethod(),$options))
        {

        }
        return false;
    });

    Route::filter ('user',function($action, $request, $options){
        if (App::isUser())
        {
            return true;
        }
        if (is_array($options) && isset($options['redirect']))
        {
    		App::redirect($options['redirect']);
        }
        return false;
    });

    Route::filter ('guest',function(){
        if (!App::isUser())
        {
            return true;
        }
        if (is_array($options) && isset($options['redirect']))
        {
    		App::redirect($options['redirect']);
        }
        return false;
    });

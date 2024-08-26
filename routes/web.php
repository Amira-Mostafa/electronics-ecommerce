<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
});

//we are gonna link the two application with this view 
//if there's any uri fire app view and app view will manage this uri 
//app will manage it 
//it's like i'm saying to laravel don't handel routes i'm gonna let
//vue js handel routes 

Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');

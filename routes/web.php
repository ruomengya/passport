<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::any('/login','User\IndexController@login');

Route::post('/phon/login','User\IndexController@phonLogin');

Route::get('/home','User\IndexController@home');

Route::get('/quit','User\IndexController@quit');
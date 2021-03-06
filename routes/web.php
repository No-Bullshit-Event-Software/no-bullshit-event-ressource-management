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

Route::get('/home', function () {
    return view('HOME');
});

Route::get('foo', function () {
    return 'Hello World';
});

Route::get('/user', 'UserController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('login/google', 'Auth\SocialController@redirectToProvider');
Route::get('login/google/callback', 'Auth\SocialController@handleProviderCallback');
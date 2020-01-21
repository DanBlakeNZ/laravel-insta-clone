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

Auth::routes();

Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');
// Calling the index method inside ProfilesController.php
// Giving the route a name of profile.show
// For details on RESTful Resource Controller conventions and naming see here:
// https://laravel.com/docs/5.1/controllers#restful-resource-controllers

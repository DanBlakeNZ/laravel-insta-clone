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

// For details on RESTful Resource Controller conventions and route naming see here:
// https://laravel.com/docs/5.1/controllers#restful-resource-controllers
// Following the rules outlined here will mean your applications will follow a pattern and will be very clean & easy to maintain/upgrade.

Route::post('follow/{user}','FollowsController@store');

Route::post('/p', 'PostsController@store');
Route::get('/p/create', 'PostsController@create'); //This route needs to be
Route::get('/p/{post}', 'PostsController@show'); // before this route. Because it has a variable it will alway evaluate first.

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');
Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show');// Calling the index method inside ProfilesController.php Giving the route a name of profile.show
Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');

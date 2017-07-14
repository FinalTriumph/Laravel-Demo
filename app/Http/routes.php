<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

Route::resource('posts', 'PostsController');

/*
Route::get('/users/{id}/{name}', function($id, $name) {
    return 'This is user '.$name.' with an id of '.$id;
});
*/
Route::auth();

Route::get('/home', 'HomeController@index');

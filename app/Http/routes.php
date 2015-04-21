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

Route::get('/', 'WelcomeController@index');
Route::get('contact','ContactController@getName');

Route::get('home', 'HomeController@index');

Route::resource('user', 'UserController');
//Route::get('user', 'UserController@index');
//Route::get('user/create', 'UserController@create');
//Route::get('user/{id}', 'UserController@show');
//Route::post('user', 'UserController@store');

Route::resource('articles', 'ArticlesController');
//Route::get('articles', 'ArticlesController@index');
//Route::get('articles/create', 'ArticlesController@create');
//Route::get('articles/{id}', 'ArticlesController@show');
//Route::post('articles', 'ArticlesController@store');

Route::get('authorize', 'Authorise\AuthoriseController@authorize');
Route::controllers([
    'authorize' => 'Authorise\AuthoriseController',
]);
//Route::get('authorize', 'Authorise\AuthoriseController@authorize');
//Route::get('authorize/login', 'Authorise\AuthoriseController@login');
//Route::get('authorize/register', 'Authorise\AuthoriseController@register');
//Route::post('authorize', 'Authorise\AuthoriseController@tryLogin');
//Route::post('authorize/register', 'Authorise\AuthoriseController@tryRegister');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

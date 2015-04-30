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

Route::get('home', 'HomeController@index');

Route::resource('user', 'UserController');

Route::resource('articles', 'ArticlesController');
Route::get('tags/{tags}', 'TagsController@show');
//Route::get('articles', 'ArticlesController@index');
//Route::get('articles/create', 'ArticlesController@create');
//Route::get('articles/{id}', 'ArticlesController@show');
//Route::post('articles', 'ArticlesController@store');

Route::get('authorize', 'Authorise\AuthoriseController@authorize');
Route::controllers([
    'authorize' => 'Authorise\AuthoriseController',
]);
Route::controllers([
    'admin/categories' => 'Admin\CategoryController',
    'admin/products' => 'Admin\ProductController'
]);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

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

// define auth routes
Auth::routes(['verify' => true]);

// basic information routes
Route::get('/',        'PageController@index');
Route::get('/about',   'PageController@about');
Route::get('/whoops',  'PageController@whoops');

// dashboard
Route::get('/home', 'HomeController@index')->name('home');

// changePassword
Route::get('/changepassword', 'Auth\ResetPasswordController@changeResetForm')
  ->middleware('auth')
  ->name('password.changeit');


// Users
Route::resource('user',  'UserController')->middleware('auth');


// Articles  (create has to be defined first!)
Route::get('article/create'       , 'ArticleController@create')->middleware('auth');
Route::delete('article/{article}' , 'ArticleController@destroy')->middleware('auth');
Route::get('article/{article}'    , 'ArticleController@show');
Route::post('article'             , 'ArticleController@store')->middleware('auth');
Route::get('article'              , 'ArticleController@index');
//
Route::match(['put','patch'], 'article/{article}', 'ArticleController@update')->middleware('auth');


// Contacts  (create has to be defined first!)
Route::get('contact/create'       , 'ContactController@create');
Route::delete('contact/{contact}' , 'ContactController@destroy')->middleware('auth');
Route::get('contact/{contact}'    , 'ContactController@show')->middleware('auth');
Route::post('contact'             , 'ContactController@store');
Route::get('contact'              , 'ContactController@index')->middleware('auth');
//
Route::match(['put','patch'], 'contact/{contact}', 'ContactController@update')->middleware('auth');

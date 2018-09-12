<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|  remember: everything here has "api/" prefix
*/

// Users
Route::apiresource('user'   , 'UserController')->middleware('auth:api');


// Articles
Route::delete('article/{article}' , 'ArticleController@destroy')->middleware('auth:api');
Route::get('article/{article}'    , 'ArticleController@show');
Route::get('article'              , 'ArticleController@index');
Route::post('article'             , 'ArticleController@store')->middleware('auth:api');
//
Route::match(['put','patch'], 'article/{article}', 'ArticleController@update')->middleware('auth:api');


// Contacts
Route::delete('contact/{contact}' , 'ContactController@destroy')->middleware('auth:api');
Route::get('contact/{contact}'    , 'ContactController@show')->middleware('auth:api');
Route::get('contact'              , 'ContactController@index')->middleware('auth:api');
Route::post('contact'             , 'ContactController@store');
//
Route::match(['put','patch'], 'contact/{contact}', 'ContactController@update')->middleware('auth:api');

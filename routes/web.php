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
Route::get('/', 'HomeController@index')->middleware('auth');

Auth::routes();

Route::post('/messages','MessageController@create')->middleware('auth');
Route::put('/messages/{message_id}','MessageController@update' )->middleware('auth');
Route::delete('/messages/{message_id}','MessageController@delete' )->middleware('auth');


Route::post('/user/{user_id}', 'UserController@get');
Route::get('/user/{user_id}', 'UserController@get');

Route::get('/user/{user_id}/friends','UserController@friends' );
Route::post('/user/{user_id}/friends','UserController@addFriend' );
Route::delete('/user/{user_id}/friends','UserController@deleteFriend' );

Route::get('/user/{user_id}/update','UserController@updateUser' )->middleware('auth');

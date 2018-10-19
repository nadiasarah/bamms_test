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

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/home', 'HomeController@index');

Route::get('/new-account', 'Controller@getNewAccount');

Route::post('/new-account', 'Controller@postNewAccount');

Route::get('/deposit', 'Controller@getDeposit');

Route::post('/deposit', 'Controller@postDeposit');

Route::get('/withdraw', 'Controller@getWithdraw');

Route::post('/withdraw', 'Controller@postWithdraw');

Route::get('/transfer', 'Controller@getTransfer');

Route::post('/transfer', 'Controller@postTransfer');

Route::get('/mutation', 'Controller@getMutation');

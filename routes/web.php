<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ContentController@getHome')->name('home');

Route::get('timeline-show', 'Admin\TimelineController@getHomeWeb')->name('timeline-show');

// Rutas de Autenticacion
Route::get('/login', 'ConnectController@getLogin')->name('login');
Route::post('/login', 'ConnectController@postLogin')->name('post-login');
Route::get('/recover', 'ConnectController@getRecover')->name('recover');
Route::post('/recover', 'ConnectController@postRecover')->name('post-recover');
Route::get('/reset','ConnectController@getReset')->name('reset');
Route::post('/reset','ConnectController@postReset')->name('post-reset');
Route::get('/register','ConnectController@getRegister')->name('register');
Route::post('/register', 'ConnectController@postRegister')->name('post-register');
Route::get('/logout', 'ConnectController@getLogout')->name('logout');
// Route::get('/timeline-show', 'Admin\TimelineController@getHomeWeb')->name('timeline-show');

Route::get('/account/edit', 'UserController@getAccountEdit')->name('account_edit');
Route::post('/account/edit/avatar', 'UserController@postAccountAvatar')->name('account_edit_post');
Route::post('/account/edit/password', 'UserController@postAccountPassword')->name('account_password_edit');
Route::post('/account/edit/info', 'UserController@postAccountInfo')->name('account_info_edit');

// Ajax Api Routers
Route::get('/api/load/products/{section}', 'ApiJsController@getProductsSection');
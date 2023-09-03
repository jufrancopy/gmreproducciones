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
Route::get('/phpinfo', function () {
    return phpinfo();
});

// Module Cart
Route::get('/cart', 'Frontend\CartController@getCart')->name('cart');
Route::post('/cart', 'Frontend\CartController@postCart')->name('cart');
Route::post('/cart/product/{id}/add', 'Frontend\CartController@postCartAdd')->name('cart_add');
Route::post('/cart/item/{id}/update', 'Frontend\CartController@postCartItemQuantityUpdate')->name('cart_item_update');
Route::get('/cart/item/{id}/delete', 'Frontend\CartController@getCartItemDelete')->name('cart_item_delete');
Route::get('/cart/{order}/type/{type}', 'Frontend\CartController@getOrderChangeType')->name('cart_item_delete');

// Module Store
Route::get('/store', 'Frontend\StoreController@getStore')->name('store');
Route::get('/store/category/{id}/{slug}', 'Frontend\StoreController@getCategory')->name('store_category');
Route::post('/search', 'Frontend\StoreController@postSearch')->name('search');

Route::get('timeline-show', 'Admin\TimelineController@getHomeWeb')->name('timeline-show');

// Rutas de Autenticacion
Route::get('/login', 'ConnectController@getLogin')->name('login');
Route::post('/login', 'ConnectController@postLogin')->name('post-login');
Route::get('/recover', 'ConnectController@getRecover')->name('recover');
Route::post('/recover', 'ConnectController@postRecover')->name('post-recover');
Route::get('/reset', 'ConnectController@getReset')->name('reset');
Route::post('/reset', 'ConnectController@postReset')->name('post-reset');
Route::get('/register', 'ConnectController@getRegister')->name('register');
Route::post('/register', 'ConnectController@postRegister')->name('post-register');
Route::get('/logout', 'ConnectController@getLogout')->name('logout');
// Route::get('/timeline-show', 'Admin\TimelineController@getHomeWeb')->name('timeline-show');

// Module Products
Route::get('/product/{id}/{slug}', 'Frontend\ProductController@getProduct')->name('product_single');

// Module User Actions
Route::get('/account/edit', 'UserController@getAccountEdit')->name('account_edit');
Route::post('/account/edit/avatar', 'UserController@postAccountAvatar')->name('account_edit_post');
Route::post('/account/edit/password', 'UserController@postAccountPassword')->name('account_password_edit');
Route::post('/account/edit/info', 'UserController@postAccountInfo')->name('account_info_edit');
Route::get('/account/address', 'UserController@getAccountAddress')->name('account_address');
Route::post('/account/address/add', 'UserController@postAccountAddress')->name('account_address');
Route::get('/account/address/{address}/setdefault', 'UserController@getAccountAddressSetDefault')->name('account_address');
Route::get('/account/address/{address}/delete', 'UserController@getAccountAddressDelete')->name('account_delete');
Route::get('/account/history/orders', 'Frontend\UserOrderController@getHistory')->name('account_user_order_history');
Route::get('/account/history/order/{order}', 'Frontend\UserOrderController@getOrder')->name('account_user_order_detail');

// Ajax Api Routers
Route::get('/api/load/products/{section}', 'ApiJsController@getProductsSection');
Route::post('/api/load/user/favorites', 'ApiJsController@postUserFavorites');
Route::post('/api/favorites/add/{object}/{module}', 'ApiJsController@postFavoriteAdd');
Route::post('/api/load/product/inventory/{inv}/variants', 'ApiJsController@postProductInventoryVariants');
Route::post('/api/load/cities/{state}', 'ApiJsController@postCoverageCitiesFromState');


//Infonet Controller Routes
Route::get('/infonet/invoices/{tid}/{prd_id}/{sub_id}/{addl}', 'InfonetController@invoices')->name('infonet_invoices');
Route::post('/infonet/payment', [App\Http\Controllers\InfonetController::class, 'payment'])->name('payment');
Route::post('/infonet/reverse', [App\Http\Controllers\InfonetController::class, 'reverse'])->name('reverse');

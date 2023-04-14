<?php

use Illuminate\Support\Facades\Route;


Route::prefix('/admin')->group(function(){
    Route::get('/', 'Admin\DashboardController@getDashboard')->name('dashboard');

    // Settings
    Route::get('/settings','Admin\SettingController@getHome')->name('settings');
    Route::post('/settings','Admin\SettingController@postHome')->name('settings');
    // Users
    Route::get('/users/{status}', 'Admin\UserController@getUsers')->name('user_list');
    Route::get('/user/{id}/edit', 'Admin\UserController@getUserEdit')->name('user_edit');
    Route::post('/user/{id}/post', 'Admin\UserController@postUserEdit')->name('user_edit');
    Route::get('/user/{id}/banned', 'Admin\UserController@getUserBanned')->name('user_banned');
    Route::get('/user/{id}/permissions', 'Admin\UserController@getUserPermissions')->name('user_permissions');
    Route::post('/user/{id}/permissions', 'Admin\UserController@postUserPermissions')->name('user_permissions');

    // Products
    Route::get('/products/{status}', 'Admin\ProductController@getHome')->name('products');
    Route::get('/product/add', 'Admin\ProductController@getProductAdd')->name('product_add');
    Route::get('/product/{id}/edit', 'Admin\ProductController@getProductEdit')->name('product_edit');
    Route::post('/product/add', 'Admin\ProductController@postProductAdd')->name('product_add');
    Route::post('/product/search', 'Admin\ProductController@postProductSearch')->name('product_search');
    Route::post('/product/{id}/edit', 'Admin\ProductController@postProductEdit')->name('product_edit');
    Route::get('/product/{id}/delete', 'Admin\ProductController@postProductDelete')->name('product_delete');
    Route::get('/product/{id}/restore', 'Admin\ProductController@getProductRestore')->name('product_delete');
    Route::post('/product/{id}/gallery/add', 'Admin\ProductController@postProductGallery')->name('product_gallery_add');
    Route::get('/product/{id}/gallery/{gid}/delete', 'Admin\ProductController@getProductGalleryDelete')->name('product_gallery_delete');

    // Inventory
    Route::get('/product/{id}/inventory', 'Admin\ProductController@getProductInventory')->name('product_inventory');
    Route::post('/product/{id}/inventory', 'Admin\ProductController@postProductInventory')->name('product_inventory');
    Route::get('/product/inventory/{id}/edit', 'Admin\ProductController@getProductInventoryEdit')->name('product_inventory');
    Route::post('/product/inventory/{id}/edit', 'Admin\ProductController@postProductInventoryEdit')->name('product_inventory');
    Route::post('/product/inventory/{id}/variant', 'Admin\ProductController@postProductInventoryVariantAdd')->name('product_inventory');
    Route::get('/product/variant/{id}/delete', 'Admin\ProductController@getProductVariantDelete')->name('product_inventory');
    Route::get('/product/inventory/{id}/delete', 'Admin\ProductController@getProductInventoryDeleted')->name('product_inventory');

    // Categories
    Route::get('/categories/{module}', 'Admin\CategoryController@getHome')->name('categories');
    Route::post('/category/add/{module}', 'Admin\CategoryController@postCategoryAdd')->name('category_add');
    Route::get('/category/{id}/edit', 'Admin\CategoryController@getCategoryEdit')->name('category_edit');
    Route::post('/category/{id}/edit', 'Admin\CategoryController@postCategoryEdit')->name('category_edit');
    Route::get('/category/{id}/subs', 'Admin\CategoryController@postSubCategoriesEdit')->name('category_edit');
    Route::get('/category/{id}/delete', 'Admin\CategoryController@getCategoryDelete')->name('category_delete');

    // Sliders
    Route::get('/sliders', 'Admin\SliderController@getHome')->name('sliders_list');
    Route::post('/slider/add', 'Admin\SliderController@postSliderAdd')->name('slider_add');
    Route::get('/slider/{id}/edit', 'Admin\SliderController@getSliderEdit')->name('slider_edit');
    Route::post('/slider/{id}/edit', 'Admin\SliderController@postSliderEdit')->name('slider_edit');
    Route::get('/slider/{id}/delete', 'Admin\SliderController@getSliderDelete')->name('slider_delete');

    // Coverage
    Route::get('/coverage', 'Admin\CoverageController@getList')->name('coverage_list');
    Route::post('/coverage/state/add', 'Admin\CoverageController@postCoverageStateAdd')->name('coverage_add');
    Route::post('/coverage/city/add', 'Admin\CoverageController@postCoverageCityAdd')->name('coverage_add');
    Route::get('/coverage/{id}/edit', 'Admin\CoverageController@getCoverageEdit')->name('coverage_edit');
    Route::post('/coverage/state/{id}/edit', 'Admin\CoverageController@postCoverageStateEdit')->name('coverage_edit');
    Route::get('/coverage/city/{id}/edit', 'Admin\CoverageController@getCoverageCityEdit')->name('coverage_edit');
    Route::post('/coverage/city/{id}/edit', 'Admin\CoverageController@postCoverageCityEdit')->name('coverage_edit');
    Route::get('/coverage/{id}/cities', 'Admin\CoverageController@getCoverageCities')->name('coverage_list');
    Route::get('/coverage/{id}/delete', 'Admin\CoverageController@postCoverageDelete')->name('coverage_delete');

    // Javascritp Request
    Route::get('/api/load/subCategories/{parent}', 'Admin\ApiController@getSubCategories');

    // Timelines
    Route::resource('timeline-profiles', 'Admin\TimelineProfileController');
    // Route::get('timeline-profiles/{category_id}/add_slice', 'Admin\TimelineProfileController@addTimelineProfile')->name('timeline-profiles-add');

    Route::get('/timelines-list/{profile_id}', 'Admin\TimelineController@getList')->name('timelines.list');
    Route::get('/timeline/{profile_id}/add', 'Admin\TimelineController@getTimelineAdd')->name('timeline_add');
    Route::get('/timeline/{id}/edit', 'Admin\TimelineController@getTimelineEdit')->name('timeline_edit');
    Route::post('/timeline/add', 'Admin\TimelineController@postTimelineAdd')->name('timeline_add_store');
    Route::post('/timeline/{id}/edit', 'Admin\TimelineController@postTimelineEdit')->name('timeline_edit_store');
    Route::post('/timeline/{id}/delete', 'Admin\TimelineController@getTimelineDelete')->name('timeline_delete');
    Route::post('/timeline/{id}/gallery/add', 'Admin\TimelineController@postTimelineGallery')->name('timeline_gallery_add');
    Route::get('/timeline/{id}/gallery/{gid}/delete', 'Admin\TimelineController@getTimelineGalleryDelete')->name('timeline_gallery_delete');
});

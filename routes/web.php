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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');

Route::get('site/profile/profile', [App\Http\Controllers\Site\UserController::class, 'profile'])->name('profile')-> middleware('auth');
Route::post('site/profile/profile', [App\Http\Controllers\Site\UserController::class, 'profileUpdate'])->name('profile.update')-> middleware('auth');
Route::get('/site/galeria/galeria', [App\Http\Controllers\HomeController::class, 'galeria'])->name('galeria');

Route::namespace('Activity')->group(function () {
    Route::get('activity/create', 'ActivityController@create')->name('activity.create');
    Route::post('activity/store', 'ActivityController@store')->name('activity.store');
    Route::get('activity', 'ActivityController@index')->name('activity.index')-> middleware('auth');
    Route::post('activity/{activity}', 'ActivityController@show')->name('activity.show');
    Route::get('activity/{activity}/edit', 'ActivityController@edit')->name('activity.edit');
    Route::patch('activity/{activity}/{account}', 'ActivityController@update')->name('activity.update');
    Route::delete('activity/{activity}/{account}', 'ActivityController@destroy')->name('activity.destroy');


    Route::get('type_activity/create', 'Type_activityController@create')->name('type_activity.create');
    Route::post('type_activity/store', 'Type_activityController@store')->name('type_activity.store');
    Route::get('type_activity', 'Type_activityController@index')->name('type_activity.index')-> middleware('auth');
    Route::post('type_activity/{type_activity}', 'Type_activityController@show')->name('type_activity.show');
    Route::get('type_activity/{type_activity}/edit', 'Type_activityController@edit')->name('type_activity.edit');
    Route::patch('type_activity/{type_activity}', 'Type_activityController@update')->name('type_activity.update');
    Route::delete('type_activity/{type_activity}', 'Type_activityController@destroy')->name('type_activity.destroy');

    Route::get('worker/create', 'WorkerController@create')->name('worker.create');
    Route::post('worker/store', 'WorkerController@store')->name('worker.store');
    Route::get('worker', 'WorkerController@index')->name('worker.index')-> middleware('auth');
    Route::post('worker/{worker}', 'WorkerController@show')->name('worker.show');
    Route::get('worker/{worker}/edit', 'WorkerController@edit')->name('worker.edit');
    Route::patch('worker/{worker}', 'WorkerController@update')->name('worker.update');
    Route::delete('worker/{worker}', 'WorkerController@destroy')->name('worker.destroy');

    Route::post('activity_research/research', 'ActivityResearchController@research')->name('activity_research.research');
    Route::get('activity_research', 'ActivityResearchController@consult')->name('activity_research.consult');
    Route::get('activity_research/index', 'ActivityResearchController@index')->name('activity_research.index');
});

Route::namespace('Finance')->group(function () {
    Route::get('account/create', 'AccountController@create')->name('account.create');
    Route::post('account/store', 'AccountController@store')->name('account.store');
    Route::get('account', 'AccountController@index')->name('account.index')-> middleware('auth');
    Route::get('account/{account}', 'AccountController@show')->name('account.show');
    Route::get('account/{account}/edit', 'AccountController@edit')->name('account.edit');
    Route::patch('account/{account}', 'AccountController@update')->name('account.update');
    Route::delete('account/{account}', 'AccountController@destroy')->name('account.destroy');

    Route::get('sale/create', 'SaleController@create')->name('sale.create');
    Route::post('sale/store', 'SaleController@store')->name('sale.store');
    Route::get('sale',         'SaleController@index')->name('sale.index')-> middleware('auth');
    Route::post('sale/{sale}', 'SaleController@show')->name('sale.show');
    Route::get('sale/{sale}/edit', 'SaleController@edit')->name('sale.edit');
    Route::patch('sale/{sale}/{account}', 'SaleController@update')->name('sale.update');
    Route::delete('sale/{sale}/{account}', 'SaleController@destroy')->name('sale.destroy');

    Route::get('accounting/create', 'AccountingController@create')->name('accounting.create');
    Route::post('accounting/store', 'AccountingController@store')->name('accounting.store');
    Route::get('accounting', 'AccountingController@index')->name('accounting.index')-> middleware('auth');
    Route::post('accounting/{accounting}', 'AccountingController@show')->name('accounting.show');
    Route::get('accounting/{accounting}/edit', 'AccountingController@edit')->name('accounting.edit');
    Route::patch('accounting/{accounting}', 'AccountingController@update')->name('accounting.update');
    Route::delete('accounting/{accounting}', 'AccountingController@destroy')->name('accounting.destroy');


    Route::get('bayer/create', 'AccountingController@create')->name('bayer.create');
    Route::post('bayer/store', 'AccountingController@store')->name('bayer.store');
    Route::get('bayer', 'AccountingController@index')->name('bayer.index')-> middleware('auth');
    Route::post('bayer/{bayer}', 'AccountingController@show')->name('bayer.show');
    Route::get('bayer/{bayer}/edit', 'AccountingController@edit')->name('bayer.edit'); 
    Route::patch('bayer/{bayer}', 'AccountingController@update')->name('bayer.update');
    Route::delete('bayer/{bayer}', 'AccountingController@destroy')->name('bayer.destroy');

    Route::post('account_research/research', 'AccountResearchController@research')->name('account_research.research');
    Route::get('account_research', 'AccountResearchController@consult')->name('account_research.consult');
    Route::get('account_research/index', 'AccountResearchController@index')->name('account_research.index');

    Route::post('sale_research/research', 'SaleResearchController@research')->name('sale_research.research');
    Route::get('sale_research', 'SaleResearchController@consult')->name('sale_research.consult');
    Route::get('sale_research/index', 'SaleResearchController@index')->name('sale_research.index');

    Route::post('cash_flow/research', 'Cash_flowController@research')->name('cash_flow.research');
    Route::get('cash_flow', 'Cash_flowController@consult')->name('cash_flow.consult');
    Route::get('cash_flow/index', 'Cash_flowController@index')->name('cash_flow.index');

});

Route::namespace('Ground')->group(function () {
    Route::get('ground/create', 'GroundController@create')->name('ground.create');
    Route::post('ground/store', 'GroundController@store')->name('ground.store');
    Route::get('ground', 'GroundController@index')->name('ground.index')-> middleware('auth');
    Route::post('ground/{ground}', 'GroundController@show')->name('ground.show');
    Route::get('ground/{ground}/edit', 'GroundController@edit')->name('ground.edit');
    Route::patch('ground/{ground}', 'GroundController@update')->name('ground.update');
    Route::delete('ground/{ground}', 'GroundController@destroy')->name('ground.destroy');

    Route::get('crop/create', 'CropController@create')->name('crop.create');
    Route::post('crop/store', 'CropController@store')->name('crop.store');
    Route::get('crop', 'CropController@index')->name('crop.index')-> middleware('auth');
    Route::post('crop/{crop}', 'CropController@show')->name('crop.show');
    Route::get('crop/{crop}/edit', 'CropController@edit')->name('crop.edit');
    Route::patch('crop/{crop}', 'CropController@update')->name('crop.update');
    Route::delete('crop/{crop}', 'CropController@destroy')->name('crop.destroy');
});

Route::namespace('Product')->group(function () {
    Route::get('product/create', 'ProductController@create')->name('product.create');
    Route::post('product/store', 'ProductController@store')->name('product.store');
    Route::get('product', 'ProductController@index')->name('product.index')-> middleware('auth');
    Route::post('product/{product}', 'ProductController@show')->name('product.show');
    Route::get('product/{product}/edit', 'ProductController@edit')->name('product.edit');
    Route::patch('product/{product}', 'ProductController@update')->name('product.update');
    Route::delete('product/{product}', 'ProductController@destroy')->name('product.destroy');

    Route::get('product_apply/create', 'Product_applyController@create')->name('product_apply.create');
    Route::post('product_apply/store', 'Product_applyController@store')->name('product_apply.store');
    Route::get('product_apply',         'Product_applyController@index')->name('product_apply.index')-> middleware('auth');
    Route::post('product_apply/{product_apply}', 'Product_applyController@show')->name('product_apply.show');
    Route::get('product_apply/{product_apply}/edit', 'Product_applyController@edit')->name('product_apply.edit');
    Route::patch('product_apply/{product_apply}/{account}', 'Product_applyController@update')->name('product_apply.update'); 
    Route::delete('product_apply/{product_apply}/{account}', 'Product_applyController@destroy')->name('product_apply.destroy');

    Route::post('product_apply/product_apply_research/research', 'Product_applyResearchController@research')->name('product.product_apply_research.research');
    Route::get('product_apply/product_apply_research', 'Product_applyResearchController@consult')->name('product.product_apply_research.consult');
    Route::get('product_apply/product_apply_research/index', 'Product_applyResearchController@index')->name('product.product_apply_research.index');

    
});

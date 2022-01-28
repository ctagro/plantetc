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

Route::get('/', function() {
    return view('site.home.index');
});

Route::get('admin/home/index', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.home.index')-> middleware('auth');

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
    Route::get('sale','SaleController@index')->name('sale.index')-> middleware('auth');
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

    Route::get('cashFlow', 'CashFlowController@index')->name('cashFlow.index')-> middleware('auth');
    Route::get('cashFlow/create', 'CashFlowController@create')->name('cashFlow.create');
    Route::post('cashFlow/store', 'CashFlowController@store')->name('cashFlow.store');
    Route::get('cashFlow/{cashFlow}', 'CashFlowController@show')->name('cashFlow.show');
    Route::get('cashFlow/{cashFlow}/edit', 'CashFlowController@edit')->name('cashFlow.edit');
    Route::patch('cashFlow/{cashFlow}', 'CashFlowController@update')->name('cashFlow.update');
    Route::delete('cashFlow/{cashFlow}', 'CashFlowController@destroy')->name('cashFlow.destroy');

    Route::get('bayer/create', 'BayerController@create')->name('bayer.create');
    Route::post('bayer/store', 'BayerController@store')->name('bayer.store');
    Route::get('bayer', 'BayerController@index')->name('bayer.index')-> middleware('auth');
    Route::post('bayer/{bayer}', 'BayerController@show')->name('bayer.show');
    Route::get('bayer/{bayer}/edit', 'BayerController@edit')->name('bayer.edit'); 
    Route::patch('bayer/{bayer}', 'BayerController@update')->name('bayer.update');
    Route::delete('bayer/{bayer}', 'BayerController@destroy')->name('bayer.destroy');

    Route::post('account_research/research', 'AccountResearchController@research')->name('account_research.research');
    Route::get('account_research', 'AccountResearchController@consult')->name('account_research.consult');
    Route::get('account_research/index', 'AccountResearchController@index')->name('account_research.index');

    Route::post('sale_research/research', 'SaleResearchController@research')->name('sale_research.research');
    Route::get('sale_research', 'SaleResearchController@consult')->name('sale_research.consult');
    Route::get('sale_research/index', 'SaleResearchController@index')->name('sale_research.index');

   

    Route::get('bank/create', 'BankController@create')->name('bank.create');
    Route::post('bank/store', 'BankController@store')->name('bank.store');
    Route::get('bank', 'BankController@index')->name('bank.index')-> middleware('auth');
    Route::post('bank/{bank}', 'BankController@show')->name('bank.show');
    Route::get('bank/{bank}/edit', 'BankController@edit')->name('bank.edit'); 
    Route::patch('bank/{bank}', 'BankController@update')->name('bank.update');
    Route::delete('bank/{bank}', 'BankController@destroy')->name('bank.destroy');


 
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

    Route::get('product_apply/update_price', 'Product_applyController@update_price')->name('product_apply.update_price');

    

    Route::post('product_apply/product_apply_research/research', 'Product_applyResearchController@research')->name('product.product_apply_research.research');
    Route::get('product_apply/product_apply_research', 'Product_applyResearchController@consult')->name('product.product_apply_research.consult');
    Route::get('product_apply/product_apply_research/index', 'Product_applyResearchController@index')->name('product.product_apply_research.index');
    

    
});

Route::namespace('Pesticide')->group(function () {

    Route::get('pesticide/create', 'PesticideController@create')->name('pesticide.create');
    Route::post('pesticide/store', 'PesticideController@store')->name('pesticide.store');
    Route::get('pesticide', 'PesticideController@index')->name('pesticide.index')-> middleware('auth');
    Route::post('pesticide/{pesticide}', 'PesticideController@show')->name('pesticide.show');
    Route::get('pesticide/{pesticide}/edit', 'PesticideController@edit')->name('pesticide.edit');
    Route::patch('pesticide/{pesticide}', 'PesticideController@update')->name('pesticide.update');
    Route::delete('pesticide/{pesticide}', 'PesticideController@destroy')->name('pesticide.destroy');

    Route::get('pesticide_apply/create', 'Pesticide_applyController@create')->name('pesticide_apply.create');
    Route::post('pesticide_apply/store', 'Pesticide_applyController@store')->name('pesticide_apply.store');
    Route::get('pesticide_apply',         'Pesticide_applyController@index')->name('pesticide_apply.index')-> middleware('auth');
    Route::post('pesticide_apply/{pesticide_apply}', 'Pesticide_applyController@show')->name('pesticide_apply.show');
    Route::get('pesticide_apply/{pesticide_apply}/edit', 'Pesticide_applyController@edit')->name('pesticide_apply.edit');
    Route::patch('pesticide_apply/{pesticide_apply}/{account}', 'Pesticide_applyController@update')->name('pesticide_apply.update'); 
    Route::delete('pesticide_apply/{pesticide_apply}/{account}', 'Pesticide_applyController@destroy')->name('pesticide_apply.destroy');

    Route::get('pesticide_apply/update_price', 'Pesticide_applyController@update_price')->name('pesticide_apply.update_price');

    Route::post('pesticide_apply/pesticide_apply_research/research', 'Pesticide_applyResearchController@research')->name('pesticide.pesticide_apply_research.research');
    Route::get('pesticide_apply/pesticide_apply_research', 'Pesticide_applyResearchController@consult')->name('pesticide.pesticide_apply_research.consult');
    Route::get('pesticide_apply/pesticide_apply_research/index', 'Pesticide_applyResearchController@index')->name('pesticide.pesticide_apply_research.index');

    Route::get('category_pesticide/create', 'Category_pesticideController@create')->name('category_pesticide.create');
    Route::post('category_pesticide/store', 'Category_pesticideController@store')->name('category_pesticide.store');
    Route::get('category_pesticide', 'Category_pesticideController@index')->name('category_pesticide.index')-> middleware('auth');
    Route::post('category_pesticide/{category_pesticide}', 'Category_pesticideController@show')->name('category_pesticide.show');
    Route::get('category_pesticide/{category_pesticide}/edit', 'Category_pesticideController@edit')->name('category_pesticide.edit');
    Route::patch('category_pesticide/{category_pesticide}', 'Category_pesticideController@update')->name('category_pesticide.update');
    Route::delete('category_pesticide/{category_pesticide}', 'Category_pesticideController@destroy')->name('category_pesticide.destroy');

    Route::get('disease/create', 'DiseaseController@create')->name('disease.create');
    Route::post('disease/store', 'DiseaseController@store')->name('disease.store');
    Route::get('disease', 'DiseaseController@index')->name('disease.index')-> middleware('auth');
    Route::post('disease/{disease}', 'DiseaseController@show')->name('disease.show');
    Route::get('disease/{disease}/edit', 'DiseaseController@edit')->name('disease.edit');
    Route::patch('disease/{disease}', 'DiseaseController@update')->name('disease.update');
    Route::delete('disease/{disease}', 'DiseaseController@destroy')->name('disease.destroy');

    Route::get('active_principle/create', 'Active_principleController@create')->name('active_principle.create');
    Route::post('active_principle/store', 'Active_principleController@store')->name('active_principle.store');
    Route::get('active_principle', 'Active_principleController@index')->name('active_principle.index')-> middleware('auth');
    Route::post('active_principle/{active_principle}', 'Active_principleController@show')->name('active_principle.show');
    Route::get('active_principle/{active_principle}/edit', 'Active_principleController@edit')->name('active_principle.edit');
    Route::patch('active_principle/{active_principle}', 'Active_principleController@update')->name('active_principle.update');
    Route::delete('active_principle/{active_principle}', 'Active_principleController@destroy')->name('active_principle.destroy');
   
});

Route::namespace('Report')->group(function () {

    Route::post('result_area/research', 'Result_areaController@research')->name('result_area.research');
    Route::get('result_area', 'Result_areaController@consult')->name('result_area.consult');
    Route::get('result_area/index', 'Result_areaController@index')->name('result_area.index');

    Route::post('cash_flow/research', 'Cash_flowController@research')->name('cash_flow.research');
    Route::get('cash_flow', 'Cash_flowController@consult')->name('cash_flow.consult');
    Route::get('cash_flow/index', 'Cash_flowController@index')->name('cash_flow.index');

    Route::post('cashflow/research', 'Cashflow_ReportController@research')->name('cashflow.research');
    Route::get('cashflow', 'Cashflow_ReportController@consult')->name('cashflow.consult');
    Route::get('cashflow/index', 'Cashflow_ReportController@index')->name('cashflow.index');



});

Route::namespace('Site')->group(function () {
    Route::get('/', 'HomeController')->name('site.home.index');
    Route::get('site/about/index', [App\Http\Controllers\Site\AboutController::class,'index'])->name('site.about');
    Route::get('site/category/index', [App\Http\Controllers\Site\CategoryController::class, 'index'])->name('category.index');

});

Route::namespace('Inventory')->group(function () {
    Route::get('type_product/create', 'Type_productController@create')->name('type_product.create');
    Route::post('type_product/store', 'Type_productController@store')->name('type_product.store');
    Route::get('type_product', 'Type_productController@index')->name('type_product.index')-> middleware('auth');
    Route::post('type_product/{type_product}', 'Type_productController@show')->name('type_product.show');
    Route::get('type_product/{type_product}/edit', 'Type_productController@edit')->name('type_product.edit'); 
    Route::patch('type_product/{type_product}', 'Type_productController@update')->name('type_product.update');
    Route::delete('type_product/{type_product}', 'Type_productController@destroy')->name('type_product.destroy');

    Route::get('provide/create', 'ProviderController@create')->name('provide.create');
    Route::post('provide/store', 'ProviderController@store')->name('provide.store');
    Route::get('provide', 'ProviderController@index')->name('provide.index')-> middleware('auth');
    Route::post('provide/{provide}', 'ProviderController@show')->name('provide.show');
    Route::get('provide/{provide}/edit', 'ProviderController@edit')->name('provide.edit'); 
    Route::patch('provide/{provide}', 'ProviderController@update')->name('provide.update');
    Route::delete('provide/{provide}', 'ProviderController@destroy')->name('provide.destroy');

    Route::get('fertilizer_inventory/create', 'Fertilizer_inventoryController@create')->name('fertilizer_inventory.create');
    Route::post('fertilizer_inventory/store', 'Fertilizer_inventoryController@store')->name('fertilizer_inventory.store');
    Route::get('fertilizer_inventory', 'Fertilizer_inventoryController@index')->name('fertilizer_inventory.index')-> middleware('auth');
    Route::post('fertilizer_inventory/{fertilizer_inventory}', 'Fertilizer_inventoryController@show')->name('fertilizer_inventory.show');
    Route::get('fertilizer_inventory/{fertilizer_inventory}/edit', 'Fertilizer_inventoryController@edit')->name('fertilizer_inventory.edit'); 
    Route::patch('fertilizer_inventory/{fertilizer_inventory}', 'Fertilizer_inventoryController@update')->name('fertilizer_inventory.update');
    Route::delete('fertilizer_inventory/{fertilizer_inventory}', 'Fertilizer_inventoryController@destroy')->name('fertilizer_inventory.destroy');

    Route::get('fertilizer_entry/create', 'Fertilizer_entryController@create')->name('fertilizer_entry.create');
    Route::post('fertilizer_entry/store', 'Fertilizer_entryController@store')->name('fertilizer_entry.store');
    Route::get('fertilizer_entry', 'Fertilizer_entryController@index')->name('fertilizer_entry.index')-> middleware('auth');
    Route::get('fertilizer_entry/{fertilizer_entry}', 'Fertilizer_entryController@show')->name('fertilizer_entry.show');
    Route::get('fertilizer_entry/{fertilizer_entry}/edit', 'Fertilizer_entryController@edit')->name('fertilizer_entry.edit');
    Route::patch('fertilizer_entry/{fertilizer_entry}', 'Fertilizer_entryController@update')->name('fertilizer_entry.update');
    Route::delete('fertilizer_entry/{fertilizer_entry}', 'Fertilizer_entryController@destroy')->name('fertilizer_entry.destroy');

    Route::get('pesticide_inventory/create', 'Pesticide_inventoryController@create')->name('pesticide_inventory.create');
    Route::post('pesticide_inventory/store', 'Pesticide_inventoryController@store')->name('pesticide_inventory.store');
    Route::get('pesticide_inventory', 'Pesticide_inventoryController@index')->name('pesticide_inventory.index')-> middleware('auth');
    Route::post('pesticide_inventory/{pesticide_inventory}', 'Pesticide_inventoryController@show')->name('pesticide_inventory.show');
    Route::get('pesticide_inventory/{pesticide_inventory}/edit', 'Pesticide_inventoryController@edit')->name('pesticide_inventory.edit'); 
    Route::patch('pesticide_inventory/{pesticide_inventory}', 'Pesticide_inventoryController@update')->name('pesticide_inventory.update');
    Route::delete('pesticide_inventory/{pesticide_inventory}', 'Pesticide_inventoryController@destroy')->name('pesticide_inventory.destroy');

    Route::get('pesticide_entry/create', 'Pesticide_entryController@create')->name('pesticide_entry.create');
    Route::post('pesticide_entry/store', 'Pesticide_entryController@store')->name('pesticide_entry.store');
    Route::get('pesticide_entry', 'Pesticide_entryController@index')->name('pesticide_entry.index')-> middleware('auth');
    Route::get('pesticide_entry/{pesticide_entry}', 'Pesticide_entryController@show')->name('pesticide_entry.show');
    Route::get('pesticide_entry/{pesticide_entry}/edit', 'Pesticide_entryController@edit')->name('pesticide_entry.edit');
    Route::patch('pesticide_entry/{pesticide_entry}', 'Pesticide_entryController@update')->name('pesticide_entry.update');
    Route::delete('pesticide_entry/{pesticide_entry}', 'Pesticide_entryController@destroy')->name('pesticide_entry.destroy');

    Route::post('fertilizer_inventory_research/research', 'Fertilizer_inventoryResearchController@research')->name('fertilizer_inventory_research.research');
    Route::get('fertilizer_inventory_research', 'Fertilizer_inventoryResearchController@consult')->name('fertilizer_inventory_research.consult');
    Route::get('fertilizer_inventory_research/index', 'Fertilizer_inventoryResearchController@index')->name('fertilizer_inventory_research.index');
    
    Route::post('pesticide_inventory_research/research', 'Pesticide_inventoryResearchController@research')->name('pesticide_inventory_research.research');
    Route::get('pesticide_inventory_research', 'Pesticide_inventoryResearchController@consult')->name('pesticide_inventory_research.consult');
    Route::get('pesticide_inventory_research/index', 'Pesticide_inventoryResearchController@index')->name('pesticide_inventory_research.index');

});

Route::namespace('Import')->group(function () {

    Route::get('import','Price_ceasaController@import')->name('ceasa.import');
    Route::post('store-import','Price_ceasaController@storeImport')->name('ceasa.storeImport');
    Route::post('index','Price_ceasaController@index')->name('ceasa.index');
    Route::get('import/{import}/edit', 'Price_ceasaController@edit')->name('ceasa.edit');

    Route::post('ceasa_research/research', 'CeasaResearchController@research')->name('ceasa_research.research');
    Route::get('ceasa_research', 'CeasaResearchController@consult')->name('ceasa_research.consult');
    Route::get('ceasa_research/index', 'CeasaResearchController@index')->name('ceasa_research.index');
    Route::post('ceasa_research/file', 'CeasaResearchController@file')->name('ceasa_research.file');

});

Route::namespace('Greenhouse')->group(function () {
    Route::get('greenhouse_report/create', 'GreenhouseReportController@create')->name('greenhouse_report.create');
    Route::post('greenhouse_report/store', 'GreenhouseReportController@store')->name('greenhouse_report.store');
    Route::get('greenhouse_report', 'GreenhouseReportController@index')->name('greenhouse_report.index')-> middleware('auth');
    Route::post('greenhouse_report/{greenhouse_report}', 'GreenhouseReportController@show')->name('greenhouse_report.show');
    Route::get('greenhouse_report/{greenhouse_report}/edit', 'GreenhouseReportController@edit')->name('greenhouse_report.edit');
    Route::patch('greenhouse_report/{greenhouse_report}', 'GreenhouseReportController@update')->name('greenhouse_report.update');
    Route::delete('greenhouse_report/{greenhouse_report}', 'GreenhouseReportController@destroy')->name('greenhouse_report.destroy');

});
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

Route::namespace('Activity')->group(function () {
    Route::get('activity/create', 'ActivityController@create')->name('activity.create');
    Route::post('activity/store', 'ActivityController@store')->name('activity.store');
    Route::get('activity', 'ActivityController@index')->name('activity.index')-> middleware('auth');
    Route::post('activity/{activity}', 'ActivityController@show')->name('activity.show');
    Route::get('activity/{activity}/edit', 'ActivityController@edit')->name('activity.edit');
    Route::patch('activity/{activity}', 'ActivityController@update')->name('activity.update');
    Route::delete('activity/{activity}', 'ActivityController@destroy')->name('activity.destroy');


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
});
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
    Route::get('type_activity/create', 'Type_activityController@create')->name('type_activity.create');
    Route::post('type_activity/store', 'Type_activityController@store')->name('type_activity.store');
    Route::get('type_activity', 'Type_activityController@index')->name('type_activity.index')-> middleware('auth');
    Route::post('type_activity/{type_activity}', 'Type_activityController@show')->name('type_activity.show');
    Route::get('type_activity/{type_activity}/edit', 'Type_activityController@edit')->name('type_activity.edit');
    Route::patch('type_activity/{type_activity}', 'Type_activityController@update')->name('type_activity.update');
    Route::delete('type_activity/{type_activity}', 'Type_activityController@destroy')->name('type_activity.destroy');
});
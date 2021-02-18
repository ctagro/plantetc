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


Route::get('/type_activity/create', [App\Http\Controllers\Activity\Type_activityController::class,'create'])->name('type_activity.create');
Route::post('/type_activity/store', [App\Http\Controllers\Activity\Type_activityController::class,'storetype_activity'])->name('type_activity.store');
Route::get('/type_activity', [App\Http\Controllers\Activity\Type_activityController::class,'index'])->name('type_activity.index')-> middleware('auth');
Route::get('type_activity/{type_activity}', [App\Http\Controllers\Activity\Type_activityController::class,'show'])->name('type_activity.show');
Route::get('type_activity/{type_activity}/edit', [App\Http\Controllers\Activity\Type_activityController::class,'edit'])->name('type_activity.edit');
Route::patch('type_activity/{type_activity}', [App\Http\Controllers\Activity\Type_activityController::class,'update'])->name('type_activity.update');
Route::delete('/type_activity/{type_activity}', [App\Http\Controllers\Activity\Type_activityController::class,'destroy'])->name('type_activity.destroy');
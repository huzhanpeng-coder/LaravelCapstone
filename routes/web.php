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
Route::group(['middleware' => 'auth'], function () {
Route::resource('items', '\App\Http\Controllers\ItemController');
Route::resource('categories', '\App\Http\Controllers\CategoryController');
});

Route::get('/public/{id}/single', 'App\Http\Controllers\PublicController@single')->name('public.single');
Route::get('/public/{id}/shopping_store', 'App\Http\Controllers\PublicController@shopping_store')->name('public.shopping_store');
Route::resource('public', '\App\Http\Controllers\PublicController');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



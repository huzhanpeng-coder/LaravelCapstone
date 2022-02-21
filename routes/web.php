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
    Route::get('/public/view_orders', 'App\Http\Controllers\PublicController@view_orders')->name('public.view_orders');
    Route::get('/public/{id}/check_receipt', 'App\Http\Controllers\PublicController@check_receipt')->name('public.check_receipt');
    
    Route::resource('items', '\App\Http\Controllers\ItemController');
    Route::resource('categories', '\App\Http\Controllers\CategoryController');
});

Route::get('/public/{id}/single', 'App\Http\Controllers\PublicController@single')->name('public.single');

Route::get('/public/{id}/update_cart', 'App\Http\Controllers\PublicController@update_cart')->name('public.update_cart');
Route::put('/public/{id}/update_cart', 'App\Http\Controllers\PublicController@update_cart')->name('public.update_cart');
Route::delete('/public/{id}/update_cart', 'App\Http\Controllers\PublicController@update_cart')->name('public.update_cart');
Route::patch('/public/{id}/update_cart', 'App\Http\Controllers\PublicController@update_cart')->name('public.update_cart');

Route::get('/public/{id}/remove_item', 'App\Http\Controllers\PublicController@remove_item')->name('public.remove_item');
Route::delete('/public/{id}/remove_item', 'App\Http\Controllers\PublicController@remove_item')->name('public.remove_item');
Route::get('/public/{id}/shopping_store', 'App\Http\Controllers\PublicController@shopping_store')->name('public.shopping_store');

Route::post('/public/check_order', 'App\Http\Controllers\PublicController@check_order')->name('public.check_order');



Route::resource('public', '\App\Http\Controllers\PublicController');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



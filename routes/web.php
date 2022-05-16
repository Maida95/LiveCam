<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\FormsController;

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

Route::get('/', 'App\Http\Controllers\PagesController@index');
Route::get('/webshop', 'App\Http\Controllers\PagesController@webshop')->middleware('can:webshop-users');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/livecam/unos', [App\Http\Controllers\PagesController::class, 'unos'])->middleware('can:livecam-users');

Route::resource('forms', App\Http\Controllers\FormsController::class)->middleware('can:livecam-users');
Route::get('/livecam/prikaz', [App\Http\Controllers\FormsController::class, 'index'])->middleware('can:livecam-users');

Route::namespace('App\Http\Controllers\Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', UsersController::class);
});

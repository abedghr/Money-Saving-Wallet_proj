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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/storeCategory','CategoryController@store')->name('category.store');
Route::post('/storeTransaction','TransactionController@store')->name('trans.store');
Route::get('/summary','TransactionController@show')->name('trans.show');

Route::get('/admin/home','AdminController@index')->name('admin.home');
Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login.show');
Route::post('/admin/loginProcess','Auth\AdminLoginController@login')->name('admin.login');
Route::post('/admin/logout','Auth\AdminLoginController@logout')->name('admin.logout');
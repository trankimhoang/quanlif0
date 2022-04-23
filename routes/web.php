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

Route::prefix('/admin')->name('admin.')->middleware('auth:admin')->group(function () {
    Route::get('/tong-quan', 'Admin\IndexController@index')->name('index'); // admin.index

    Route::get('/gv', 'Admin\GVController@index')->name('gv'); // admin.index

    Route::get('/sv', 'Admin\SVController@index')->name('sv'); // admin.index
});


Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('login_admin');
Route::post('admin/login', 'Auth\LoginController@login')->name('login_admin');
Route::get('admin/logout', 'Auth\LoginController@logout')->name('logout_admin_get');

Route::get('user/login', 'Web\Auth\LoginController@showLoginForm')->name('login_user');
Route::post('user/login', 'Web\Auth\LoginController@login')->name('login_user');
Route::get('user/logout', 'Web\Auth\LoginController@logout')->name('logout_user_get');


Route::prefix('sv')->name('sv.')->middleware('auth:sv')->group(function () {
    Route::get('/index', 'Web\SVController@index')->name('index');
    Route::post('/index', 'Web\SVController@sendData')->name('send_data');
});

Route::prefix('gv')->name('gv.')->middleware('auth:gv')->group(function () {
    Route::get('/index', 'Web\GVController@index')->name('index');
});

Route::get('/', function () {
    return redirect()->route('login_user');
});

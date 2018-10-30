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

Route::get('welcome', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('crm.login');
});

Route::post('LoginDo','LoginController@login_do');
Route::any('Home','HomeController@home');
#回收站
Route::any('Recycle','RecycleController@recycle');
#通讯录
Route::any('Communicate','CommunicateController@communicate');
Route::any('Page','CommunicateController@page');
Route::any('Sear','CommunicateController@sear');


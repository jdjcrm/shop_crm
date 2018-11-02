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
Route::any('RecycleDo','RecycleController@recycle_do');
#修改
Route::any('RecycleU','RecycleController@recycle_update');
#删除
Route::any('RecycleD','RecycleController@recycle_del');

#分页
Route::any('RecycleP','RecycleController@recycle_page');

#搜索
Route::any('RecycleS','RecycleController@recycle_show');


#通讯录
Route::any('Communicate','CommunicateController@communicate');
Route::any('Page','CommunicateController@page');
Route::any('Sear','CommunicateController@sear');

//用户添加  useradd
Route::any('user_add','UserController@user_add');

//用户执行添加 user_add_do
Route::any('user_add_do','UserController@user_add_do');

//用户展示  userShow
Route::any('userShow','UserController@userShow');

//用户展示分页  user_show_page
Route::any('user_show_page','UserController@user_show_page');

//用户删除  user_dele
Route::any('user_dele','UserController@userDelete');

//用户修改  user_update
Route::any('user_update','UserController@userUpdate');

//执行修改 user_update_do
Route::any('user_update_do','UserController@user_update_do');

//客户管理
Route::any('client_show','ClientController@client_show');

//客户添加 client_add
Route::any('client_add','ClientController@client_add');

//客户执行添加  client_add_do
Route::any('client_add_do','ClientController@client_add_do');

//客户分页 clientList
Route::any('clientList','ClientController@clientList');

//客户删除  client_dele
Route::any('client_dele','ClientController@client_dele');

//客户修改  client_update
Route::any('client_update','ClientController@client_update');


//订单展示
Route::any('orderShow','OrderController@orderShow');
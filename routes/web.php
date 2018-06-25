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
    return redirect('posts/{post}');
//    return view('welcome');
});

Route::group(['prefix'=>'posts'],function (){
    //文章详情页
    Route::get('{post}','PostController@show');
//编辑文章
    Route::get('{post}/edit','PostController@edit');
//    赞
    Route::get('{post}/zan','PostController@zan');
//    取消赞
    Route::get('{post}/unzan','PostController@unzan');

// 更新
    Route::put('{post}','PostController@update');
//删除文章
    Route::get('{post}/delete','PostController@delete');
    //提交评论
    Route::post('{post}/comment','PostController@comment');
});
//搜索路由
Route::get('search','PostController@search');
//文章列表页
Route::get('posts','PostController@index');

//创建文章逻辑
Route::get('create','PostController@create');
//创建文章提交的逻辑
Route::post('posts','PostController@store');
//图片上传
Route::post('posts1/image/upload','PostController@imageUpload');

//用户模块========
//注册页面
Route::get('register','RegisterController@index');
//注册逻辑
Route::post('register','RegisterController@register');
//登录页面
Route::get('login','LoginController@index');
//登录逻辑
Route::post('login','LoginController@login');
//登出逻辑
Route::get('logout','LoginController@logout');
//个人设置页面
Route::get('user/me/setting','UserController@setting');
//个人设置操作
Route::post('user/me/setting','UserController@settingStore');

//个人中心
Route::get('user/{user}','UserController@show');
Route::post('user/{user}/fan','UserController@fan');
Route::post('user/{user}/unfan','UserController@unfan');

//专题详情页
Route::get('topic/{topic}','TopicController@show');
Route::post('topic/{topic}/submit','TopicController@submit');

//引入管理后台的路由
include_once('admin.php');
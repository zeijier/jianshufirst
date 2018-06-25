<?php



Route::group(['prefix'=>'admin'],function (){
//    登录展示页面
    Route::get('login','\App\Admin\Controllers\LoginController@index');
//    登录行为
    Route::post('login','\App\Admin\Controllers\LoginController@login');
//    登出行为
    Route::get('logout','\App\Admin\Controllers\LoginController@logout');

        //这里用中间件 auth:admin admin代表用的哪个guards
//    Route::group(['middleware'=>['auth:admin']],function(){
    Route::group(['auth:admin'],function(){
//    首页
        Route::get('home','\App\Admin\Controllers\HomeController@index');
//        管理人员模块
        Route::get('users','\App\Admin\Controllers\UserController@index');
//        管理人添加页面
        Route::get('users/create','\App\Admin\Controllers\UserController@create');
//        管理人添加逻辑
        Route::post('users/store','\App\Admin\Controllers\UserController@store');
//      用户角色关联页面
        Route::get('users/{user}/role','\App\Admin\Controllers\UserController@role');
//       储存一个用户的角色
        Route::post('users/{user}/role','\App\Admin\Controllers\UserController@storeRole');

//        角色
        Route::get('roles','\App\Admin\Controllers\RoleController@index');
//        角色创建页面
        Route::get('roles/create','\App\Admin\Controllers\RoleController@index');
//        角色创建逻辑
        Route::post('roles/store','\App\Admin\Controllers\RoleController@index');

//        角色和权限的关系
        Route::get('roles/{role}/permission','\App\Admin\Controllers\RoleController@permission');
        Route::post('roles/{role}/permission','\App\Admin\Controllers\RoleController@StorePermission');


//        权限
        Route::get('permissions','\App\Admin\Controllers\PermissionController@index');
        Route::get('permissions/create','\App\Admin\Controllers\PermissionController@create');
        Route::get('permissions/store','\App\Admin\Controllers\PermissionController@store');

//        审核模块页面
        Route::get('posts','\App\Admin\Controllers\PostController@index');
//        审核模块逻辑
        Route::post('posts/{post}/status','\App\Admin\Controllers\PostController@status');
    });

});
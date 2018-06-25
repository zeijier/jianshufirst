<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use App\User;

class UserController extends Controller{
//    管理员列表页面
    public function index(){
//        分页
        $paginate = AdminUser::paginate(5);
        return view('admin.user.index',compact('paginate'));
    }
//管理员创建页面
    public function create(){
        return view('admin.user.add');
    }
// 创建操作
    public function store(){
        $this->validate(request(),[
            'name'=>'required|min:3',
            'password'=>'required|min:3',
        ]);
//        逻辑   用下面写法 定义的$name ,$password 就要和数据库字段名字一制。
// 所有存入的密码 都要用bcrypt（）加密
        $name = request('name');
        $password = bcrypt(request('password'));
        AdminUser::create(compact('name','password'));
//        渲染
        return redirect('admin/users');
    }
//  角色页面
    public function role(User $user){

        return view('admin.user.role');
    }
//  存储用户角色
    public function StoreRole(User $user){

        return back();
    }

}
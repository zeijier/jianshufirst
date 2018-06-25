<?php

namespace App\Admin\Controllers;

use App\AdminUser;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller{

//    登录展示页
    public function index(){
        return view('admin.login.index');
    }

//    登录逻辑
    public function login(){
        $this->validate(request(),[
            'name'=>'required|min:2',
            'password'=>'required|min:3|max:10'
        ]);
//        逻辑    password一定要用bcrypt（）加密 才能正常认证！！！
        $user = request(['name','password']);
//        如果登录成功就跳转到首页 方法一 直接用Auth::guard("admin") 指定guards!!! 同样在模板里面用auth 也要指定guard
//        if (Auth::guard("admin")->attempt($user)){
//        方法2  写guard函数返回guard 实例
        if ($this->guard()->attempt($user)){
//        if ($name==$aname && $pd ==$apassword){
            return redirect('admin/home');
        }
//        if (Auth::guard("admin")->attempt(['name'=>$name,'password'=>$pd])) {
////            echo 'caonima';
////            die();
//            return redirect('admin/home');
//        }
        else{
            //  渲染
            return back()->withErrors('用户名和密码不匹配');
        }
    }
//    建立guards实例
    protected function guard(){
        return Auth::guard('admin');
    }
//
    public function logout(){
//        要去AdminUser模型重写remember_token才能正常退出，因为数据库里没有存入remember_token
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
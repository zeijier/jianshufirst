<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //登录页面
    public function index(){
        return view('login.index');
    }
//    登陆逻辑
    public function login(){
        $this->validate(\request(),[
            'email'=>'email|required',
            'password'=>'required|min:5|max:10',
            'is_remember'=>'integer'
        ]);
//        逻辑
        $user = \request(['email','password']);
//        boolval() 转换为布尔类型
        $is_remember = boolval(\request('is_remember'));
//      登录成功就去列表页
        if (Auth::attempt($user,$is_remember)){
            return redirect('posts');
        }
//        返回上一级，withErrors 带上错误信息
        return redirect()->back()->withErrors('邮箱密码不匹配');
    }
//    登出逻辑
    public function logout(){
        Auth::logout();
        return redirect('login');
    }
}

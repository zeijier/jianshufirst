<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //注册页面
    public function index(){
        return view('register/index');
    }
//    注册逻辑
    public function register(){
//        表单提交三步骤 验证， 逻辑，渲染
        $this->validate(\request(),[
            'name'=>'required|max:10|min:1|unique:users,name',
            "email"=>'required|unique:users,email|email',
            'password'=>'required|min:5|max:10|confirmed'
        ]);
        $name=\request('name');
        $email=\request('email');
//        bcrypt() 把明文转化成密文
        $password=bcrypt(\request('password'));
        User::create(compact('name','email','password'));
        return redirect('login');
    }

}

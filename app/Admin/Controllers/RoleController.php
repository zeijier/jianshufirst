<?php

namespace App\Admin\Controllers;

class RoleController extends Controller{
//    角色列表
    public function index(){
        return view('admin.role.index');
    }
//  创建角色页面
    public function create(){
        return view('admin.role.add');
    }
//    创建角色逻辑
    public function store(){

    }
//  角色权限关系页面
    public function  permission(){
        return view('admin/role/permission');
    }
//  存储角色权限行为
    public function StorePermission(){

    }


}
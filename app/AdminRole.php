<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table  = 'admin_roles';
//    当前角色的所有权限
    public function permissions(){
        return $this->belongsToMany('App\AdminPermission','admin_permissions_role','role_id','permissions_id')
            ->withRivot(['role_id','permissions_id']);
    }
//    给角色赋予权限
    public function grantPermission($permission){
        return $this->permissions()->save($permission);
    }
//    取消角色赋予的权限
    public function deletePermission($permission)
    {
        return $this->permissions()->delete($permission);
    }
//    判断角色是否有权限
    public function hasPermission($permission){
//        contains方法判断集合是否包含一个给定项
        return $this->permissions()->contains($permission);
    }
}

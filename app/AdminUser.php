<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
//    laravel模型名字对应数据库表，如果是驼峰式命名 如该例：AdminUser 默认对应数据库表为admin_users
//    protected $table='admin_users';
    protected $fillable = [
        'name', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

//   数据库不存入remember_token 则要重写protected $rememberTokenName = 'remember_token';
    protected $rememberTokenName = '';

//    用户有哪一些角色
    public function roles(){
//    确定关联关系，再用  withPivot() 把关系表中的role_id 和 user_id字段获取出来
        return $this->belongsToMany('App\AdminUser','admin_role_user','role_id','user_id')
            ->withPivot(['role_id','user_id']);
    }
//    判断是否有某个角色，某些角色
    public function isInRoles($roles){
//     使用！！返回一个布尔类型  判断count()是不是0    intersect() 把2个collection  进行比较
//        TODO
        return !!$roles->intersect($this->roles())->count();
    }
//    给用户分配角色
    public function assignRole($role){
        return $this->roles()->save($role);
    }
//    取消用户分配的角色
    public function deleteRole($role){
        return $this->roles()->detach($role);
    }
//    用户是否有权限
    public function hasPermission($permission){
//TODO
//        这个permission 的角色 是否符合isInRoles  符合有交集就是有权限
        return $this->isInRoles($permission->roles());
    }
}

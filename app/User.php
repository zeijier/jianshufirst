<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

//    用户的文章列表
    public function posts(){
//        return $this->hasMany('App\Post','user_id');
        return $this->hasMany('App\Post');
    }
//    关注我的Fan模型
    public function fans(){
        return $this->hasMany('App\Fan','star_id');
    }
//    我关注的Fan模型 代表我是粉丝
    public function stars(){
        return $this->hasMany('App\Fan','fan_id');
    }
//    关注某人 就是我关注的模型里面要存一条记录
    public function doFan($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
//        再把这条记录给存进去
        $this->stars()->save($fan);
    }
//    取消关注
    public function doUnFan($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
//        再把这条记录从Fan模型删除
        $this->stars()->delete($fan);
    }
//    当前用户是否被uid 关注了   是否有这个粉丝
    public function hasFan($uid){
//        返回个数 count();
        $this->fans()->where('fan_id',$uid)->count();
    }
//    当前用户是否关注了uid
    public function hasStar($uid){
        return $this->stars()->where('star_id',$uid)->count();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'password', 'remember_token',
//    ];
}

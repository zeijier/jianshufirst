<?php

namespace App;

use App\Model;

class Fan extends Model
{
    //获取粉丝用户
    //通过user的id 找到
    public function fuser(){
        return $this->hasOne(\App\User::class,'id','fan_id');
    }
//    被关注的用户
    public function suser(){
        return $this->hasOne('\App\User','id','star_id');
    }
}

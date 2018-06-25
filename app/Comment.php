<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;
//**************这里同样要使用basemodel 就可以批量插入数据
use App\Model;

class Comment extends Model
{
//    评论所属文章
    public function post(){
        return $this->belongsTo('App\Post');
    }
//    评论所属用户
    public function user(){
        return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;

//如果这里不指定表则指定表为posts
class Model extends BaseModel
{
//    可以注入数据库的字段  public 和protected  修饰都可以
    protected $fillable=['title','content','user_id','post_id','fan_id','star_id','topic_id'];
//    不可以注入的字段 =[] 就是表示所有自段都可以
//    public $guarded=[];
}

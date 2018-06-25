<?php

namespace App;

use App\Model;

class Topic extends Model
{
//    属于这个专题的所有文章
    public function posts(){
//        四个参数，第一个关联模型，第二个2个表的关系表，第三个当前这个模型的在关系表的外键，第四个关联模型在关系表的外键
        return $this->belongsToMany('App\Post','Post_Topic','topic_id','post_id');
    }
//专题的文章数   用于withCount
    public function postTopics(){
        return $this->hasMany('App\PostTopic','topic_id');
    }
}

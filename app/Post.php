<?php

namespace App;
//这个命名空间表示使用的是BaseModel这个自己新建的model，因为BaseModel里面写了public $guarded=[]; 所以所有继承的都不要写了
use App\Model;

use Illuminate\Database\Eloquent\Builder;
// 使可搜索
use Laravel\Scout\Searchable;

//如果这里不指定表则指定表为posts
class Post extends Model
{
    //    使用Searchable   ---------搜索
//  然后使用php artisan scout:import "\App\Post"   导入数据
    use Searchable;
    // 定义索引里面的type
    public function searchableAs()
    {
        return 'post';
    }
    //定义有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'content'=>$this->content,
        ];
    }
//    可以注入数据库的字段  public 和protected  修饰都可以
//    protected $fillable=['title','content'];
//    不可以注入的字段 =[] 就是表示所有自段都可以
//    public $guarded=[];

    //    关联用户
    public function user(){
//        belongsTo 第二个参数是代表posts表中的外键，第三个参数是代表users表中的主键。因为这里遵循laravel命名规范，所以2,3参数省略。
//        post模型属于user
            return $this->belongsTo('App\User');
    }
//    评论模型 然后通过orderby 设置排序方式
    public function comment(){
//        post模型有很多的comment
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
//  和用户关联  （一篇文章对于某一个用户是否有赞）   这里的话，一篇文章，一个用户只能产生一个赞
    public function zan($user_id){
        return $this->hasOne('App\Zan')->where('user_id',$user_id);
    }
//    文章的所有赞   一篇文章有很多赞
    public function zans(){
        return $this->hasMany('App\Zan');
    }

    //    获取文章里面有多少已经投稿的
    public function postTopics(){
        return $this->hasMany('\App\PostTopic','post_id');
    }
//    属于某个作者的所有文章   scope
    public function scopeAuthorBy(Builder $query,$user_id){
        return $query->where('user_id',$user_id);
    }
//    不属于某个专题的文章
    public function scopeTopicNotBy(Builder $query,$topic_id){
//       这个文章不在postTopic里面    用户use的方法把外面的$topic_id传到这个匿名函数中来
        return $query->doesntHave('postTopics','and',function ($q) use($topic_id) {
                $q->where('topic_id',$topic_id);
        });
    }

//    全局scope的方式
//  重写父类boot()方法，添加匿名全局作用域scope
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope('avaiable',function (Builder $builder){
            $builder->whereIn('status',[0,1]);
        });
    }
}

<?php

namespace App\Http\Controllers;

use App\Post;
use App\PostTopic;
use App\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
//    专题展示
    public function show(Topic $topic){
//        传递带文章数的专题
        $topic = Topic::withCount('postTopics')->find($topic->id);
//        专题的文章列表，按创建时间倒叙排列前10个 take()
        $posts = $topic->posts()->orderBy('created_at','desc')->take(10)->get();
//        属于我的未投稿的的文章
        $myposts = Post::authorBy(Auth::id())->topicNotBy($topic->id)->get();
        return view('topic.show',compact('topic','posts','myposts'));
    }
//    专题投稿
    public function submit(Topic $topic){
//        验证
        $this->validate(\request(),[
            'post_ids'=>'required|array'//要求必须填写，必须是数组
        ]);
//        逻辑
        $posts_id = \request('post_ids');

        $topic_id = $topic->id;
        foreach ($posts_id as $post_id){
            PostTopic::firstOrCreate(compact('post_id','topic_id'));
        }
//        渲染
        return back();
    }
}

<?php

namespace  App\Admin\Controllers;

use App\Post;

class PostController extends Controller{
//    审核页面
    public function index(){
//        获取status为0的文章，不经过 'avaiable'的scope
        $posts = Post::withoutGlobalScope('avaiable')->where('status',0)->orderBy('created_at','desc')->paginate(10);
        return view('admin.post.index',compact('posts'));
    }
//    审核逻辑
    public function status(Post $post){
        $this->validate(request(),[
//            必须要有  必须状态要是-1或则1
            'status'=>'required|in:-1,1'
        ]);
        $post->status=request('status');
        $post->save();
        return [
            'error'=>0,
            'msg'=>'',
        ];
//        最后把写的js 加到对应的页面中
    }
}
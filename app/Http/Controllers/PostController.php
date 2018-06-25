<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Scout\Searchable;

class PostController extends Controller
{

//    定义索引里面的type值
    public function searchableAs()
    {
        return "post";
    }
//定义有哪些字段需要搜索
    public function toSearchableArray()
    {
        return [
            'title'=>$this->title,
            'content'=>$this->content,
        ];
    }

    //首页文章列表页
    public function index(){
        //按创建时间顺序查找字段，get全部查找出来(是对象)
//        withCount（）获取统计数  comment和zan都是post模型关联里面的函数
        $posts = Post::orderby('created_at','desc')->withCount(['comment','zans'])->paginate(3);
        //用到数据库分页的话就不用get（） 直接用paginate（）就好了
//        $posts = Post::orderby('created_at','desc')->paginate(5);
        //**方法一 ：view2个参数，第一个是字符串模板相对地址，第二个参数是一个数组,表示要传递给这个模板的变量有哪些
//        return view('post/index',[
//    传过去的是post1这个变量，这里的意思是吧上面那个$posts的值赋给变量post1。尽量是2个名称相同以便调试，找错
//            'posts1'=>$posts
//        ]);
        //**方法二 ：为了后面更好传值最好用compact方法，把数据传递到页面上去
        return view('post/index',compact('posts'));
    }
    //详情页面------这里有模型绑定
    public function show(Post $post){
//       要遵循MVC模式，这里做预加载 （模型post里面关联了comment方法，这里就这么写）
//       预加载在渲染模板之前，而且在show模板里面也不会做查询操作。
        $post->load('comment');
        return view('post/show',compact('post'));
    }
    //创建文章
    public function create(){
       return view('post/create');
    }

    //创建新文章逻辑
    public function store(){
//     validate验证
        $this->validate(\request(),[
            'title'=> 'required|string|max:100|min:5',
            'content'=>'required|string|min:10',
        ]);

//        效果与下面$params 是一样的 得到request的值，并通过Post::create()方法存入数据库
//        $params = ['title'=> \request('title'),'content'=>\request('content')];
//        $params = \request(['title','content']);
//        Post::create($params);

        $user_id = Auth::id();
//        array_merge  把2个数组合并成一个数组
        $params = array_merge(\request(['title','content']),compact('user_id'));
// 除了 save 和 saveMany 方法，您也可以使用 create 方法，它接收一个属性数组、创建模型并插入数据库。还有，save 和 create 的不同之处在于，
//save 接收的是一个完整的 Eloquent 模型实例，而 create 接收的是一个纯 PHP 数组
//        Post::create(\request(['title','content']));

        Post::create($params);
//        重定位里面填的是路由，而view的是view文件
        return redirect('posts');

    }
    //编辑逻辑
    public function update(Post $post){
//        验证
        $this->validate(\request(),[
            'title'=> 'required|string|max:100|min:5',
            'content'=>'required|string|min:10',
        ]);
//对post模型进行update（方法）操作
        $this->authorize('update',$post);
        $post->title = \request('title');
        $post->content = \request('content');
        $post->save();
//        重定向到文章详情页
        return redirect("posts/{$post->id}");

    }
    //编辑页面
    public function edit(Post $post){
        return view('post/edit',compact('post'));
    }
    //删除逻辑
    public function delete(Post $post){
//        policy 的权限判断
        $this->authorize('delete',$post);
        $post->delete();
        return redirect('posts');
    }
//    提交评论逻辑
    public function comment(Post $post){
        $this->validate(\request(),[
            'content'=>'required|min:3'
        ]);

//        逻辑
        $comment = new Comment();
//        目前登录进来评论的user
        $comment->user_id=Auth::id();
        $comment->content=\request('content');
//+++++++++++==    post_id  不用传是因为form表单提交把{post}传过来了，进行了模型关系绑定，post_id 作为comments表的外键会获取到post的id，
//又因为提交过来是把文章（post模型）也给传过来了，所以这里posts表的id也就是知道了。
//        再把$comment传给comment模型 .
//        要用下面这个就还要实例化comment
        $post->comment()->save($comment);
//            渲染
        return back();
    }
//    赞模块
    public function zan(Post $post){
//        这里的post_id 要获取传值是因为，是直接a标签转过了的，而不是form表单提交
        $params = [
            'user_id'=>Auth::id(),
            'post_id'=>$post->id,
        ];

//        先查找一条数据表是否有一条$params 的数据，有就查找出来，没有就创建
        Zan::firstOrCreate($params);
        return back();
    }
//    取消赞
    public function unzan(Post $post){
//        获取到登录用户的赞 数据表，直接执行删除操作，把该条数据删除==取消赞
        $post->zan(Auth::id())->delete();
        return back();
    }

//    上传图片
    public function imageUpload(Request $request){
        $path = $request->file('wangEditH5File')->storePublicly(md5(time()));
        return asset('storage/'.$path);
//        dd(\request()->all());
    }
//    搜索结果页
    public function search(){
//        验证
        $this->validate(\request(),[
            'query'=>'required'
        ]);
//        逻辑
        $query = \request('query');
//   ！！！！！------搜索  scout 能像普通模型 一样对搜索引擎进行查询。
        $posts = \App\Post::search($query)->paginate(2);
//        渲染
        return view('post/search',compact('posts','query'));
    }
}

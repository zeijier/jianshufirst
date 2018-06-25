<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function setting(){
        return view('user.setting');
    }
//    个人设置
    public function settingstore(){

    }
//    个人中心页面
    public function show(User $user){
//        这个人的信息,关注/粉丝/文章数
//        下面三个参数都是在模型里面创建的关联 函数
        $user = User::withCount(['stars','fans','posts'])->find($user->id);

//      这个人的文章列表，取创建时间最新的前10条
//**********  tabke(10)   里面参数是取出的条数
        $posts= $user->posts()->orderBy('created_at','desc')->take(10)->get();

//        这个人关注的用户，包含关注用户的  关注/粉丝/文章数
        $stars = $user->stars;
        $susers = User::whereIn('id',$stars->pluck('star_id'))->withCount(['stars','fans','posts'])->get();

//        这个人的粉丝用户，包含粉丝用户的  关注/粉丝/文章数
        $fans = $user->fans;
        $fusers = User::whereIn('id',$fans->pluck('fan_id'))->withCount(['stars','fans','posts'])->get();

        return view('user.show',compact('user','posts','susers','fusers'));
    }
//    关注用户
    public function fan(User $user){
//        获取出当前用户
        $me = Auth::user();
//当前用户对正在访问的$user 进行关注
        $me->doFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];
    }
//    取消关注用户
    public function unfan(User $user){
        //        获取出当前用户
        $me = Auth::user();
//当前用户对正在访问的$user 进行关注
        $me->doUnFan($user->id);
        return [
            'error'=>0,
            'msg'=>''
        ];
    }


}

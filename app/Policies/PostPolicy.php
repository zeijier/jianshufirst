<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
//    修改权限  (哪一个人可以对哪一个文章进行修改)
    public function update(User $user,Post $post){
        return $user->id==$post->user_id;//返回的值是true和false。
    }
//删除权限
    public function delete(User $user,Post $post){
        return $user->id==$post->user_id;//返回的值是true和false。
    }
}

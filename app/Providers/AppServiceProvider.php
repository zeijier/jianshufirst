<?php

namespace App\Providers;

use function foo\func;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        laravel 用的是mb4string 编码 767/4=191.xxx
        //为自带的user表添加默认的字符串长度。要引入Schema命名空间
        Schema::defaultStringLength(191);

//        这里View 用的是 use Illuminate\Support\Facades\View;  这个命名空间
        View::composer('layout.sidebar',function ($view){
//            找出所有的topic 注入到topics里面去
            $topics = \App\Topic::all();
            $view->with('topics',$topics);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

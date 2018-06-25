<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
//*******对App\User 进行数据填充。用的是第三方库faker(用来生成假数据)
//在这里添加好后，用tinker执行 （php artisan tinker）,factory(App\Post::class,10)->make()  用make只打印在页面上，用create（）就直接插入数据库了
//  https://github.com/fzaninotto/Faker
$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});
//对Post进行数据填充
$factory->define(\App\Post::class,function (Faker $faker){
    //return 一个数组过去
    return [
        //sentence 句子  paragraph 段落 可以去github上看
        'title' => $faker->sentence(6),
        'content'=>$faker->paragraph(10),
    ];
});

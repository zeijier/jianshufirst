<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //执行migration函数
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
//            default设置默认值，当没有title时，不错报错
            $table->string('title', 100)->default('');
            $table->text('content');
            $table->integer('user_id')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
//    回滚函数
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}

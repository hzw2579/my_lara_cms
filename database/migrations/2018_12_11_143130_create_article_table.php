<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',500)->default('')->comment('文章标题');
            $table->tinyInteger('type')->comment('类型');
            $table->string('subtitle',500)->default('')->comment('副标题');
            $table->string('keyword',500)->default('')->comment('关键词');
            $table->string('description',500)->default('')->comment('文章描述');
            $table->string('author',60)->default('')->comment('作者');
            $table->text('content')->comment('文章内容');
            $table->string('thumb',255)->default('')->comment('封面');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->unsignedInteger('like')->default(0)->comment('点赞');
            $table->unsignedInteger('read')->default(0)->comment('阅读');
            $table->unsignedInteger('dummy_like')->default(0)->comment('虚拟点赞');
            $table->unsignedInteger('dummy_read')->default(0)->comment('虚拟阅读');
            $table->unsignedInteger('status')->default(0)->comment('状态');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
}

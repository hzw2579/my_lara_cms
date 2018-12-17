<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->default('')->comment('分类名称');
            $table->unsignedInteger('type')->comment('分类类别');
            $table->unsignedInteger('pid')->comment('上级菜单');
            $table->text('account')->nullable()->comment('分类描述');
            $table->string('icon',500)->nullable()->default('')->comment('分类图标');
            $table->tinyInteger('sort')->nullable()->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态');
            $table->tinyInteger('false_del')->default(1)->comment('假删除');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}

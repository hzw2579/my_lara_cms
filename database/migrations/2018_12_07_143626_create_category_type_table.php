<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->default('')->comment('类型名称');
            $table->tinyInteger('sort')->default(0)->comment('排序');
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
        Schema::dropIfExists('category_type');
    }
}

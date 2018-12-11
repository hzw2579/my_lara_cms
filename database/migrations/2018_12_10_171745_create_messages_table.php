<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message')->comment('留言');
            $table->tinyInteger('type')->default(1)->comment('类型：1：邮箱2：手机3：QQ 4：微信');
            $table->string('contact',255)->default('')->comment('联系方式');
            $table->string('image',255)->default('')->comment('附件');
            $table->text('handling')->comment('处理结果');
            $table->tinyInteger('status')->default(0)->comment('留言状态');
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
        Schema::dropIfExists('messages');
    }
}

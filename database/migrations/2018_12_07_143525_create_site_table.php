<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 500)->default('')->comment('站点名称');
            $table->string('domain', 500)->default('')->comment('域名');
            $table->string('records_number', 255)->default('')->comment('备案号');
            $table->text('statistical_code')->comment('统计代码');
            $table->text('copyright')->comment('版权');
            $table->string('title_keyword', 500)->default('')->comment('标题关键字');
            $table->string('meta_keyword', 500)->default('')->comment('MATA关键词');
            $table->text('meta_describe')->comment('META描述');
            $table->string('company_name', 500)->default('')->comment('公司名称');
            $table->text('company_intro')->comment('公司介绍');
            $table->string('linkman', 255)->default('')->comment('联系人');
            $table->string('phone', 255)->default('')->comment('联系电话');
            $table->string('mobile_phone', 500)->default('')->comment('移动电话');
            $table->string('fax', 500)->default('')->comment('传真');
            $table->text('location')->comment('地址');
            $table->string('email', 255)->default('')->comment('邮箱');
            $table->string('qq', 11)->default('')->comment('qq');
            $table->string('coord', 500)->default('')->comment('地图坐标');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8mb4';
            $table->timestamps();
        });
        if(Schema::hasTable('site')) {
            $res = \DB::table('site')->find(1);
            if(!$res){
                \DB::table('site')->insert(['id'=>1,'statistical_code'=>'','copyright'=>'','meta_describe'=>'','company_intro'=>'','location'=>'']);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site');
    }
}

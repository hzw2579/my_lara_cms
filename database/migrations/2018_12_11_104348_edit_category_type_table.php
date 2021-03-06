<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditCategoryTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_type', function ($table) {
            $table->softDeletes();
            $table->dropColumn('false_del');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_type', function ($table) {
            $table->softDeletes();
            $table->tinyInteger('false_del')->default(1)->comment('假删除');
        });
    }
}

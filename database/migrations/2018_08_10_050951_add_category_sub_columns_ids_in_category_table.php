<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCategorySubColumnsIdsInCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('master_courses', function($table) {
            $table->integer('knowledge_id')->after('course_code')->nullable();
            $table->integer('sub_label_id')->after('course_code')->nullable();
            $table->integer('label_id')->after('course_code')->nullable();
            $table->integer('type_id')->after('course_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_courses', function($table) {
            $table->dropColumn('type_id');
            $table->dropColumn('label_id');
            $table->dropColumn('sub_label_id');
            $table->dropColumn('knowledge_id');
        });
    }
}

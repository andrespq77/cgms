<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsInMasterCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('master_courses', function($table) {
            $table->string('course_code', 50)->after('name')->nullable();
            $table->integer('subject_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

        Schema::table('master_courses', function($table) {
            $table->dropColumn('course_code');
            $table->dropColumn('subject_id');
        });
    }
}

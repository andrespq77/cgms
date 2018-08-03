<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMasterCourseInCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('courses', function($table) {
            $table->bigInteger('master_course_id')->after('comment')->nullable()->unsigned();
            $table->string('edition', 100)->nullable();
            $table->float('cost')->nullable()->default(0);
            $table->string('finance_type', 200)->nullable();
            $table->boolean('has_disclaimer')->default(false);
            $table->string('disclaimer_file', 256)->nullable();

            $table->date('grade_upload_start_date')->nullable();
            $table->date('grade_upload_end_date')->nullable();

            $table->tinyInteger('stage')->default(COURSE_STAGE_PUBLISHED);//1=published /  0 = draft
            $table->tinyInteger('status')->default(COURSE_STATUS_ACTIVE);//1=active / 0  = inactive
            $table->integer('course_type_id')->nullable()->unsigned();

            $table->dropColumn('modality');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function($table) {
            $table->dropColumn('master_course_id');
            $table->dropColumn('edition');
            $table->dropColumn('cost');
            $table->dropColumn('finance_type');
            $table->dropColumn('has_disclaimer');
            $table->dropColumn('disclaimer_file');
            $table->dropColumn('grade_upload_start_date');
            $table->dropColumn('grade_upload_end_date');
            $table->dropColumn('stage');
            $table->dropColumn('status');
            $table->dropColumn('course_type_id');

            $table->string('modality', 100)->nullable();

        });
    }
}

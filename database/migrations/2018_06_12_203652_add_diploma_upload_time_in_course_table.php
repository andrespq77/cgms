<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDiplomaUploadTimeInCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('courses', function($table) {

            $table->bigInteger('diploma_uploaded_by_id')->after('university_id')->unsigned()->nullable();
            $table->timestamp('diploma_upload_time')->after('university_id')->nullable();
            $table->boolean('diploma_uploaded')->after('university_id')->default(false);
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
            $table->dropColumn('diploma_uploaded_by_id');
            $table->dropColumn('diploma_upload_time');
            $table->dropColumn('diploma_uploaded');
        });
    }
}

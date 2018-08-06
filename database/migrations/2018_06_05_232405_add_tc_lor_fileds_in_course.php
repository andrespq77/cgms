<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTcLorFiledsInCourse extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function($table) {
            $table->string('lor_file_path', 255)->after('inspection_form_generated')->nullable();
            $table->string('tc_file_path', 255)->after('inspection_form_generated')->nullable();

            $table->dropColumn('terms_and_conditions');

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
            $table->dropColumn('lor_file_path');
            $table->dropColumn('tc_file_path');
            $table->text('terms_and_conditions')->nullable();
        });
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEmail2InTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function($table) {

            $table->string('email2', 100)->nullable()->before('join_date');
            $table->string('phone2', 100)->nullable()->before('join_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function($table) {
            $table->dropColumn('email2');
            $table->dropColumn('phone2');

        });
    }
}

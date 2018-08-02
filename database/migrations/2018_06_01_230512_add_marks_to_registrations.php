<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

    /**
     * Class AddMarksToRegistrations
     */
    class AddMarksToRegistrations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrations', function(Blueprint $table) {

            $table->float('mark')->nullable()->default(null);
            $table->boolean('mark_approved')->default(REGISTRATION_MARK_NOT_APPROVED); // 0=false or 1=true
            $table->bigInteger('mark_approved_by')->unsigned()->nullable();
            $table->timestamp('mark_upload_time')->nullable();

            $table->foreign('mark_approved_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registrations', function($table) {

            $table->dropColumn('mark');
            $table->dropColumn('mark_approved');

            $table->dropForeign(['mark_approved_by']);
            $table->dropColumn('mark_approved_by');

            $table->dropColumn('mark_upload_time');
        });
    }
}

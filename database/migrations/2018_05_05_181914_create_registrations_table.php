<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->date('reg_date')->nullable();
            $table->bigInteger('teacher_id')->unsigned();

            $table->bigInteger('course_id')->unsigned();


            $table->string('user_social_id')->nullable();
            $table->string('user_first_name')->nullable();
            $table->string('user_last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('cell_phone')->nullable();
            $table->tinyInteger('accept_tc')->nullable()->default(REGISTRATION_NOT_ACCEPTED_TERMS_AND_CONDITION);
            $table->timestamp('tc_accept_time')->nullable();

            $table->string('inspection_certificate')->nullable();
            $table->boolean('inspection_certificate_signed')->nullable()->default(REGISTRATION_INSPECTION_CERTIFICATE_NOT_SIGNED);
            $table->timestamp('inspection_certificate_upload_time')->nullable();

            $table->tinyInteger('registry_is_generated')->default(REGISTRATION_REGISTRY_IS_NOT_GENERATED);
            $table->string('certificate_path', 255)->nullable();

            $table->tinyInteger('status')->default(REGISTRATION_STATUS_INCOMPLETE);
            $table->tinyInteger('is_approved')->default(REGISTRATION_IS_NOT_APPROVED);
            $table->timestamp('approval_time')->nullable();

            $table->bigInteger('approved_by')->unsigned()->nullable();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
}

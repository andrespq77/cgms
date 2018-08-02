<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {

            $table->engine = 'InnoDB';


            $table->bigIncrements('id');

            $table->string('first_name', 50);  // first_name
            $table->string('last_name', 50);  // last_name
            $table->string('social_id', 30)->unique();  // CEDULA
            $table->string('moodle_id', 20)->nullable();
            $table->string('username', 30)->nullable();

            $table->string('cc', 50)->nullable();       // c_c
            $table->date('date_of_birth')->nullable();       // DOB
            $table->string('gender', 1)->nullable();
            $table->string('email', 100)->nullable();       // this will be used to create login email
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();

            $table->string('university_name', 255)->nullable();       // column z
            $table->string('inst_email',100)->nullable();       // column k
            $table->date('join_date')->nullable();          // column w
            $table->date('end_date')->nullable();           // column x
            $table->string('amie', 50)->nullable();             // column y

            $table->string('function', 100)->nullable();         // column p
            $table->string('work_area', 100)->nullable();        // column q
            $table->string('category', 100)->nullable();         // column r
            $table->string('reason_type', 100)->nullable();      // column s
            $table->string('action_type', 100)->nullable();      // column t
            $table->string('action_description', 255)->nullable();// column u
            $table->string('speciality', 100)->nullable();       // column v

            $table->string('disability', 100)->nullable();             // column aa
            $table->string('ethnic_group', 100)->nullable();       // ab

            $table->string('province', 100)->nullable();       // ab
            $table->string('canton', 100)->nullable();       // ab
            $table->string('parroquia', 100)->nullable();       // ab
            $table->string('district', 100)->nullable();       // ab
            $table->string('district_code', 10)->nullable();       // ab
            $table->string('zone', 10)->nullable();       // ab
            $table->integer('parroquia_id')->nullable();       // parroquia

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('updated_by')->unsigned();
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');


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
        Schema::dropIfExists('teachers');
    }
}

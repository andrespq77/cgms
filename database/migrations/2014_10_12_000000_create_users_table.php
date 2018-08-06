<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->bigIncrements('id');

            $table->string('name');
            $table->string('email')->unique();

            // USER PERMISSION & SETTINGS SPECIFIC
            $table->tinyInteger('role')->default(USER_ROLE_ADMIN); //1. admin, 2. student, 3. teacher
            $table->tinyInteger('status')->default(USER_STATUS_ACTIVE); //1. active, 0. inactive

            $table->string('password');

            $table->string('creation_type')->default(USER_CREATION_TYPE_CMS);        // 1.by online, 2. by_import
            $table->bigInteger('created_by')->nullable();        // logged in user id
            $table->bigInteger('updated_by')->nullable();        // logged in user id

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCantonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cantons', function (Blueprint $table) {

            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->integer('province_id')->unsigned();
            $table->string('name', 100);         // canton name
            $table->string('capital', 100)->nullable();         // canton capital

            $table->string('dist_name', 100)->nullable();        // dist name
            $table->string('dist_code', 10)->nullable();        // dist code
            $table->string('zone', 8)->nullable();             // zone


            $table->foreign('province_id')->references('id')->on('provinces')->onDelete('cascade');

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
        Schema::dropIfExists('cantons');
    }
}

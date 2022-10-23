<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200)->nullable();
            $table->timestamps();
            $table->text('desc')->nullable();
            $table->string('slug', 128)->nullable();
            $table->dateTime('open_time')->nullable();
            $table->dateTime('close_time')->nullable();
            $table->tinyInteger('closed')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forms');
    }
}

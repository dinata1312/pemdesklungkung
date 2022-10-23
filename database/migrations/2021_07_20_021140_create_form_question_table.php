<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_question', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('form_id')->nullable()->index('form_id');
            $table->unsignedBigInteger('question_id')->nullable()->index('question_id');
            $table->timestamps();
            $table->unsignedInteger('sequence')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_question');
    }
}

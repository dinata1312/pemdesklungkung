<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_response', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('respondent_id')->nullable()->index('respondent_id');
            $table->unsignedBigInteger('form_question_id')->nullable()->index('form_question_id');
            $table->timestamps();
            $table->text('value')->nullable();
            $table->text('meta')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_response');
    }
}

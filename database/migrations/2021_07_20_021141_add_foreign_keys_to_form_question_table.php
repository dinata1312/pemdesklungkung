<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFormQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_question', function (Blueprint $table) {
            $table->foreign('question_id', 'form_question_ibfk_1')->references('id')->on('questions')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('form_id', 'form_question_ibfk_2')->references('id')->on('forms')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_question', function (Blueprint $table) {
            $table->dropForeign('form_question_ibfk_1');
            $table->dropForeign('form_question_ibfk_2');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFormResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form_response', function (Blueprint $table) {
            $table->foreign('form_question_id', 'form_response_ibfk_1')->references('id')->on('form_question')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('respondent_id', 'form_response_ibfk_2')->references('id')->on('form_respondent')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form_response', function (Blueprint $table) {
            $table->dropForeign('form_response_ibfk_1');
            $table->dropForeign('form_response_ibfk_2');
        });
    }
}

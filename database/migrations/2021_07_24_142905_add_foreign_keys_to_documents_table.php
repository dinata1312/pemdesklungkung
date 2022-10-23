<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->foreign('created_by', 'documents_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('form_id', 'documents_ibfk_2')->references('id')->on('forms')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('documents', function (Blueprint $table) {
            $table->dropForeign('documents_ibfk_1');
            $table->dropForeign('documents_ibfk_2');
        });
    }
}

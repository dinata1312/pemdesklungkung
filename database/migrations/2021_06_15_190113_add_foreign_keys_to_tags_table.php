<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->foreign('term_id', 'tags_ibfk_1')->references('id')->on('terms')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('created_by', 'tags_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign('tags_ibfk_1');
            $table->dropForeign('tags_ibfk_2');
        });
    }
}

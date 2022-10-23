<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->foreign('child_of', 'navigations_ibfk_1')->references('id')->on('navigations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
            $table->foreign('created_by', 'navigations_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('navigations', function (Blueprint $table) {
            $table->dropForeign('navigations_ibfk_1');
            $table->dropForeign('navigations_ibfk_2');
        });
    }
}

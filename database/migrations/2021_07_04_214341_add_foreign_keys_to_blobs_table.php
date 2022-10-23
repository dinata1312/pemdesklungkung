<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToBlobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('blobs', function (Blueprint $table) {
            $table->foreign('created_by', 'blobs_ibfk_1')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('blobs', function (Blueprint $table) {
            $table->dropForeign('blobs_ibfk_1');
        });
    }
}

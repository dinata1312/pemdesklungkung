<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostImageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_image', function (Blueprint $table) {
            $table->foreign('post_id', 'post_image_ibfk_1')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('image_id', 'post_image_ibfk_2')->references('id')->on('blobs')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('created_by', 'post_image_ibfk_3')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_image', function (Blueprint $table) {
            $table->dropForeign('post_image_ibfk_1');
            $table->dropForeign('post_image_ibfk_2');
            $table->dropForeign('post_image_ibfk_3');
        });
    }
}

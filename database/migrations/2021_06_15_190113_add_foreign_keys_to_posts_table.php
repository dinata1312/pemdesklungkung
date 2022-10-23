<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('type_id', 'posts_ibfk_1')->references('id')->on('post_type')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('created_by', 'posts_ibfk_2')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
            $table->foreign('publish_by', 'posts_ibfk_3')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_ibfk_1');
            $table->dropForeign('posts_ibfk_2');
            $table->dropForeign('posts_ibfk_3');
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->foreign('post_id', 'post_tag_ibfk_1')->references('id')->on('posts')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('tag_id', 'post_tag_ibfk_2')->references('id')->on('tags')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('created_by', 'post_tag_ibfk_3')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropForeign('post_tag_ibfk_1');
            $table->dropForeign('post_tag_ibfk_2');
            $table->dropForeign('post_tag_ibfk_3');
        });
    }
}

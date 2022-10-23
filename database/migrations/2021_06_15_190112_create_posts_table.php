<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('title');
            $table->unsignedBigInteger('type_id')->nullable()->index('type_id');
            $table->text('slug');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
            $table->text('content')->nullable();
            $table->text('setting')->nullable();
            $table->tinyInteger('publish')->default(0);
            $table->unsignedBigInteger('publish_by')->nullable()->index('publish_by');
            $table->unsignedBigInteger('created_by')->nullable()->index('created_by');
            $table->integer('view')->nullable()->default(0);
            $table->text('reaction')->nullable();
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
        Schema::dropIfExists('posts');
    }
}

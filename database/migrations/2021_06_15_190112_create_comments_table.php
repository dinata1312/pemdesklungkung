<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id')->nullable()->index('post_id');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('created_by')->nullable()->index('created_by');
            $table->string('author_ip', 100)->nullable();
            $table->unsignedBigInteger('child_of')->nullable()->index('child_of');
            $table->text('content');
            $table->string('type', 200);
            $table->integer('rate')->nullable();
            $table->text('reaction')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

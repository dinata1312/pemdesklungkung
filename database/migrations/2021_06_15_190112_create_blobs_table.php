<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('filename')->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
            $table->string('extension')->nullable();
            $table->string('directory')->nullable();
            $table->text('path')->nullable();
            $table->tinyInteger('private')->default(0);
            $table->unsignedBigInteger('created_by')->nullable()->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blob');
    }
}

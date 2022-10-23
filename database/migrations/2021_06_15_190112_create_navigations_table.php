<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNavigationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('label');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable();
            $table->softDeletes();
            $table->string('slug')->default('#');
            $table->integer('sequence')->nullable()->default(1);
            $table->unsignedBigInteger('child_of')->nullable()->index('child_of');
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
        Schema::dropIfExists('navigations');
    }
}

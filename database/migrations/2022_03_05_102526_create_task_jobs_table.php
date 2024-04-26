<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_jobs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('User_id');
            $table->foreign('User_id')->references('id')->on('users');
            $table->longText('Conten')->nullable();
            $table->string('status')->default(1)->nullable();
            $table->boolean('action')->default(1)->nullable();
            $table->boolean('private')->default(1)->nullable();
            $table->string('note')->default(1)->nullable();
            $table->timestamps();
            $table->softDeletes(); // add
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('task_jobs');
    }
}

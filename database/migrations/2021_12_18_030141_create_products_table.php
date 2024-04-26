<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_type');
            $table->foreign('id_type')->references('id')->on('type_products');
            $table->unsignedBigInteger('User_id');
            $table->foreign('User_id')->references('id')->on('users');
            $table->unsignedBigInteger('id_idea')->nullable();
            $table->foreign('id_idea')->references('id')->on('users');
            $table->string('image')->nullable();
            $table->longText('description')->nullable();
            $table->string('ImagePNG')->nullable();
            $table->string('status')->default(1)->nullable();
            $table->boolean('action')->default(1)->nullable();
            $table->string('note')->default(1)->nullable();
            $table->timestamps();
            $table->softDeletes(); // add

        });
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('id_idea')->index();
            $table->unsignedBigInteger('User_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOderEbaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oder__ebays', function (Blueprint $table) {
            $table->id();
            $table->string('oder_Title')->nullable();
            $table->string('Number_Items')->nullable();
            $table->string('Sale_Date')->nullable();
            $table->string('Order_Total')->nullable();
            $table->string('Date_Shipped')->nullable();
            $table->string('saller')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oder__ebays');
    }
}

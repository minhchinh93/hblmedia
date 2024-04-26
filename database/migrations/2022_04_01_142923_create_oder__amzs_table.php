<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOderAmzsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oder__amzs', function (Blueprint $table) {
            $table->id();
            $table->string('oder_Title')->nullable();
            $table->float('Number_Items')->nullable();
            $table->string('Sale_Date')->nullable();
            $table->float('Order_Total')->nullable();
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
        Schema::dropIfExists('oder__amzs');
    }
}

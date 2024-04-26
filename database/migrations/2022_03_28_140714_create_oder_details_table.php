<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('oder_details');
        Schema::create('oder_details', function (Blueprint $table) {
            $table->id();
            $table->string('oder_sku')->nullable();
            $table->string('Number_Items')->nullable();
            $table->string('Sale_Date')->nullable();
            $table->float('Order_Total')->nullable();
            $table->string('Date_Shipped')->nullable();
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
        Schema::dropIfExists('oder_details');
    }
}

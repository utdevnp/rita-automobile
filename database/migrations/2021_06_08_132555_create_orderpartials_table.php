<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderpartialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        if(! Schema::hasTable("orderpartials")){
            Schema::create('orderpartials', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->bigInteger("order_id")->nullable();
                $table->bigInteger("product_id")->nullable();
                $table->bigInteger("user_id")->nullable();
                $table->bigInteger("qty")->nullable();
                $table->bigInteger("action_by")->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderpartials');
    }
}

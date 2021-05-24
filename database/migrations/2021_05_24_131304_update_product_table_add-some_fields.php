<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductTableAddSomeFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        if(! Schema::hasTable("products","segment_id")){
            Schema::table('products', function (Blueprint $table) {
                $table->bigInteger("segment_id")->nullable();
                $table->bigInteger("model_id")->nullable();
                $table->string("smart_part_no")->nullable();
                $table->string("ref_part_no")->nullable();
                $table->string("oe_part_no")->nullable();
                $table->string("size")->nullable();
                $table->string("mega_categories")->nullable();
                $table->string("series")->nullable();
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
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}

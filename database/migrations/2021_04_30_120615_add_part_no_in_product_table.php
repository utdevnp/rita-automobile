<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPartNoInProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasColumn("products","part_no")){
            Schema::table('products', function (Blueprint $table) {
                $table->string("part_no")->nullable();
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
        if(! Schema::hasColumn("products","part_no")){
            Schema::table('products', function (Blueprint $table) {
                $table->string("part_no")->nullable();
            });
        }
    }
}

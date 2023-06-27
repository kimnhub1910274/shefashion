<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_ship', function (Blueprint $table) {
            $table->Increments('ship_id');
            $table->Integer('customer_id');
            $table->String('ship_name');
            $table->String('ship_address');
            $table->String('ship_phone');
            $table->String('ship_note');
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
        Schema::dropIfExists('tbl_ship');
    }
};

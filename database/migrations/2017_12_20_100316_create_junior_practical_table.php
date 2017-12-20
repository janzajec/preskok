<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJuniorPracticalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('junior_practical', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vehicle_id');
            $table->smallInteger('inhouse_seller_id');
            $table->smallInteger('buyer_id');
            $table->smallInteger('model_id');
            $table->date('sale_date');
            $table->date('buy_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('junior_practical');
    }
}

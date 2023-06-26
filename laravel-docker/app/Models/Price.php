<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceTable extends Migration
{
    public function up()
    {
        Schema::create('price', function (Blueprint $table) {
            $table->id();
            $table->string('carrier_name');
            $table->string('service');
            $table->integer('deadline');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('price');
    }
}

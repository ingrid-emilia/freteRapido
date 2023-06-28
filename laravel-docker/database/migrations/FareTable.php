<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFareTable extends Migration
{
    public function up()
    {
        Schema::create('fare', function (Blueprint $table) {
            $table->id();
            $table->string('Frete_Rapido');
            $table->string('service');
            $table->integer('deadline');
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fare');
    }
}

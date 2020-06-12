<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableworksTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tableworks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('region_id'); // Relación con usuario
            $table->foreign('region_id')->references('id')->on('regions')->cascadeOnDelete();
            $table->string('name');
            $table->string('comuna')->nullable();
            $table->string('comunidad')->nullable();
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
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
        Schema::dropIfExists('tableworks');
    }
}

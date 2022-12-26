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
        Schema::create('productvariation_values', function (Blueprint $table) {
            $table->id();
            $table->string('variationValue');
            $table->bigInteger('productVariationId')->unsigned();
            $table->foreign('productVariationId')->references('id')->on('productvariations')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('productvariation_values');
    }
};

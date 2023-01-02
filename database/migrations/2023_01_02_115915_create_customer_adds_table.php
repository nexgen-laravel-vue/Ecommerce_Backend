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
        Schema::create('customer_adds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phoneno');
            $table->string('FlatNumber')->nullable();
            $table->string('HouseNumber')->nullable();
            $table->string('Street')->nullable();
            $table->string('City')->nullable();
            $table->string('State');
            $table->String('PinOrZipCode');
            $table->string('Country');
            $table->bigInteger('AddressTypeId')->unsigned();
            $table->bigInteger('userId')->unsigned();
            $table->foreign('AddressTypeId')->references('id')->on('address_types')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('customer_adds');
    }
};

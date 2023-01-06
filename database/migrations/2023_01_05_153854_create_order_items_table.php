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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->uuid('orderId');
            $table->bigInteger('productId')->unsigned();
            $table->bigInteger('userId')->unsigned();
            $table->integer('quantity');
            $table->float('selling_price');
            $table->float('Actual_price');
            $table->string('promocode')->nullable()->default(null);
            $table->timestamp('created_date');
            $table->string('created_by')->default('Application');
            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('productId')->references('id')->on('product_details')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('order_items');
    }
};

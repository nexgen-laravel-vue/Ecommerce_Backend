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
        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->integer('productId');
            $table->integer('userId');
            $table->integer('quantity');
            $table->float('selling_price');
            $table->float('Actual_price');
            $table->string('promocode')->nullable()->default(null);
            $table->tinyInteger('is_paid')->default(0);
            $table->timestamp('created_date');
            $table->string('created_by')->default('Application');
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
        Schema::dropIfExists('cart_products');
    }
};

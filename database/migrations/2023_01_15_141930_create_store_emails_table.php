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
        Schema::create('store_emails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('emailTypeId')->unsigned();
            $table->string('Email');
            $table->string('firstName');
            $table->string('lastName');
            $table->foreign('emailTypeId')->references('id')->on('mail_types')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('store_emails');
    }
};

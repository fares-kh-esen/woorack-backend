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
        //groomer table is refer to User table
        //bile a new groomer registered, the groomer details will be created as well
        Schema::create('groomers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('groomer_id')->unique();
            $table->string('category')->nullable();
            $table->unsignedInteger('customers')->nullable();
            $table->unsignedInteger('experience')->nullable();
            $table->longText('bio_data')->nullable();
            $table->string('status')->nullable();
            $table->foreign('groomer_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('groomers');
    }
};

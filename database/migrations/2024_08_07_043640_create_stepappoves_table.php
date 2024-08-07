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
        Schema::create('stepappoves', function (Blueprint $table) {
            $table->id();
            $table->integer('bookingID');
            $table->string('email')->nullable();
            $table->string('is_step')->nullable();
            $table->boolean('is_status')->default(false);
            $table->dateTime('action_date')->nullable();
            $table->boolean('is_read')->default(false);
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
        Schema::dropIfExists('stepappoves');
    }
};
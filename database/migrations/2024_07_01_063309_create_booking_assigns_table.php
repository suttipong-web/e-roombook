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
        Schema::create('booking_assigns', function (Blueprint $table) {
            $table->id();
            $table->string('cmuitaccount');
            $table->bigInteger('bookingID');
            $table->boolean('is_read')->default(false);
            $table->boolean('is_send_email')->default(false);
            $table->boolean('is_send_line')->default(false);
            $table->boolean('is_confirm')->default(false);
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
        Schema::dropIfExists('booking_assigns');
    }
};

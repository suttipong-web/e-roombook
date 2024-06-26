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
        Schema::create('booking_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('booking_no', 32);
            $table->string('roomID', 254);
            $table->char('booking_date', 10);
            $table->char('booking_time_start', 4);
            $table->char('booking_time_finish', 4);
            $table->string('booking_subject')->nullable();
            $table->string('booking_subject_sec')->nullable();
            $table->string('booking_Instructor')->nullable();
            $table->string('booking_booker')->nullable();
            $table->smallInteger('booking_ofPeople')->default(0);
            $table->string('booking_department')->nullable();;
            $table->boolean('booking_autio')->default(false);
            $table->boolean('booking_lcd')->default(false);
            $table->boolean('booking_computer')->default(false);
            $table->string('booking_zoom')->nullable();
            $table->string('bookingToken')->nullable();
            $table->tinyInteger('booking_status')->default(0);
            $table->tinyInteger('booking_type')->default(0);
            $table->boolean('booking_AdminApprove')->default(false);
            $table->boolean('booking_DeanApprove')->default(false);
            $table->string('description')->nullable();
            $table->timestamp('booking_at')->nullable();
            $table->boolean('booking_cancel')->default(false);
            $table->boolean('booking_food')->default(false);
            $table->boolean('booking_camera')->default(false);
            $table->string('booker_cmuaccount')->nullable();
            $table->boolean('booking_AdminApprove')->default(false);
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
        Schema::dropIfExists('booking_rooms');
    }
};

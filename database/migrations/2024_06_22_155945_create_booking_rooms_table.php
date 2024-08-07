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
            $table->string('booking_type', 15)->nullable();
            $table->string('booking_AdminAction', 20)->nullable();
            $table->string('booking_DeanAction', 20)->nullable();
            $table->string('description')->nullable();
            $table->dateTime('booking_at')->nullable();
            $table->boolean('booking_cancel')->default(false);
            $table->boolean('booking_food')->default(false);
            $table->boolean('booking_camera')->default(false);
            $table->string('booker_cmuaccount')->nullable();
            $table->boolean('booking_AdminApprove')->default(false);
            $table->string('booking_email')->nullable();
            $table->string('booking_phone')->nullable();
            $table->dateTime('admin_action_date')->nullable();
            $table->dateTime('dean_action_date')->nullable();
            $table->string('admin_action_acount')->nullable();
            $table->string('dean_action_acount')->nullable();
            $table->string('booking_fileurl')->nullable();
            $table->boolean('is_read')->default(false);
            $table->boolean('dean_appove_status')->default(false);            
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

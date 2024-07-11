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
        Schema::create('room_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('courseNO');
            $table->string('courseTitle')->nullable();
            $table->string('courseSec')->nullable();
            $table->integer('Stdamount')->default(0);
            $table->string('onDays');
            $table->time('booking_time_start');
            $table->time('booking_time_finish');
            $table->string('roomNo')->nullable();
            $table->integer('roomID')->default(0);
            $table->string('lecturer')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_confirm')->default(false);
            $table->boolean('admin_confirm')->default(false);
            $table->dateTime('is_confirm_date')->nullable();
            $table->dateTime('admin_confirm_date')->nullable();
            $table->dateTime('straff_account')->nullable();
            $table->char('group_year', 4)->nullable();
            $table->date('schedule_startdate')->nullable();
            $table->date('schedule_enddate')->nullable();
            $table->string('schedule_repeatday', 20)->nullable();
            $table->char('courseofyear', 4)->nullable();
            $table->tinyInteger('terms', 1)->default(0);
            $table->boolean('is_duplicate')->default(false);
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
        Schema::dropIfExists('room_schedules');
    }
};

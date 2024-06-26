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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('roomToken');
            $table->string('roomFullName');       
            $table->string('roomTitle')->nullable();    
            $table->string('roomSize')->nullable();  
            $table->integer('roomTypeId')->default(0);
            $table->integer('placeId')->default(0);
            $table->string('thumbnail')->nullable();
            $table->string('roomDetail')->nullable();
            $table->boolean('is_open')->default(true);
            $table->boolean('is_status')->default(false);            
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
        Schema::dropIfExists('rooms');
    }
};

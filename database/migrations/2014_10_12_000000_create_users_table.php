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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('isDean')->default(false);
            $table->boolean('isAdmin')->default(false);
            $table->rememberToken();
            $table->string('cmuitaccount_name')->nullable();
            $table->string('prename_TH')->nullable();
            $table->string('firstname_TH')->nullable();
            $table->string('lastname_TH')->nullable();
            $table->string('itaccounttype_id')->nullable();
            $table->string('itaccounttype_TH')->nullable();
            $table->string('positionName')->nullable();
            $table->string('positionName2')->nullable();
            $table->timestamp('last_activity')->nullable();
            $table->integer('dep_id')->nullable();

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
        Schema::dropIfExists('users');
    }
};

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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('customerToken',100)->nullable();
            $table->string('urlPayment',150)->nullable();    
            $table->integer('bookingID');            
            $table->string('customerName',254)->nullable();;
            $table->string('customerEmail',100)->nullable();;
            $table->string('customerPhone',100)->nullable();;
            $table->string('organization')->nullable();    
            $table->string('customerTaxid',20)->nullable();
            $table->string('customerAddress')->nullable();           
            $table->decimal('totalAmount', 10, 2)->default(0);
            $table->boolean('payment_status')->default(false);
            $table->boolean('is_confirm')->default(false);
            $table->timestamp('payment_date')->nullable();      
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
        Schema::dropIfExists('payments');
    }
};

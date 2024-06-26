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
        Schema::create('customer_payment', function (Blueprint $table) {
            $table->id();
            $table->string('payment_ref1',100)->nullable();
            $table->string('payment_ref2',20)->nullable();
            $table->string('orderInv',32);
            $table->string('customerName',254)->nullable();;
            $table->string('customerEmail',100)->nullable();;
            $table->string('customerPhone',100)->nullable();;
            $table->string('organization')->nullable();
            $table->string('receipt_fname',254)->nullable();          
            $table->string('receipt_taxid',20)->nullable();
            $table->string('receipt_address')->nullable();
            $table->string('receipt_phone',50)->nullable();
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
        Schema::dropIfExists('customer_payment');
    }
};

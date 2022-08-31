<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->from(1501);
            $table->integer('order_id');
            $table->integer('vehicle_id');
            $table->integer('dealer_id');
            $table->decimal('price');
            $table->decimal('tax_percentage');
            $table->decimal('discount_percentage');
            $table->decimal('total_amount');
            $table->string('payment_method');
            $table->string('transaction_id');
            $table->string('verified_by');
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
        Schema::dropIfExists('invoices');
    }
}

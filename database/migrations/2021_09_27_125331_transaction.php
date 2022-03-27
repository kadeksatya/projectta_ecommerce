<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Transaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('transaction');

        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('order_no')->nullable();
            $table->integer('customer_id')->nullable();
            $table->string('status')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('resi_no')->nullable();
            $table->integer('ongkir_id')->nullable();
            $table->integer('bank_id')->nullable();
            $table->integer('grand_total')->nullable();
            $table->integer('transfer_value')->nullable();
            $table->integer('address_id')->nullable();
            $table->longText('remark')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}




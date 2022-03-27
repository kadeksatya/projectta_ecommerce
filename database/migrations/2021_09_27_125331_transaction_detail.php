<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TransactionDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('transaction_detail');

        Schema::create('transaction_detail', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('trx_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->integer('variant_id')->nullable();
            $table->integer('qty')->nullable();
            $table->integer('sub_total')->nullable();
            $table->integer('product_price')->nullable();
            $table->integer('discount')->nullable();
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
        Schema::dropIfExists('transaction_detail');
    }
}




<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('stock');

        Schema::create('stock', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('variant_id')->nullable();
            $table->integer('stock_in')->nullable();
            $table->integer('stock_out')->nullable();
            $table->string('remark', 255)->nullable();
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
        Schema::dropIfExists('stock');
    }
}

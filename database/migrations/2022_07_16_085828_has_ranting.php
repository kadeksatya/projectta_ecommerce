<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HasRanting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('has_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->nullable();
            $table->integer('rating_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->boolean('is_reviewed')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('has_ratings');
    }
}

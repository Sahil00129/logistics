<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('maplocation_id')->nullable();
            $table->string('vehcapacity_id')->nullable();
            $table->string('payment_type')->nullable()->comment('1=>advance_payment 2=>pending_payment 3=>other_charges');
            $table->string('payment_to')->nullable()->comment('1=>broker/owner 2=>driver');
            $table->string('purchase_price')->nullable();
            $table->string('advance_payment')->nullable();
            $table->string('pending_payment')->nullable();
            $table->tinyinteger('status')->nullable();
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
        Schema::dropIfExists('payment_histories');
    }
}

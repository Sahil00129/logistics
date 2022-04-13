<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStopHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stop_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('payment_id')->nullable();
            $table->string('lr_number')->nullable();
            $table->date('lr_date')->nullable();
            $table->string('gross_wt')->nullable();
            $table->string('truck_number')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('stop_histories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('map_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();            
            $table->string('vehcapacity_id')->nullable();
            $table->string('payment_type')->nullable()->comment('1=>advance_payment 2=>pending_payment 3=>other_charges');
            $table->string('payment_to')->nullable()->comment('1=>broker/owner 2=>driver');
            $table->string('paytobroker_id')->nullable();
            $table->string('paytodriver_id')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('number_stops')->nullable();
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
        Schema::dropIfExists('map_locations');
    }
}

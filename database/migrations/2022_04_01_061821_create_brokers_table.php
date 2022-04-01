<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrokersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brokers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('branch_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('gst_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->tinyinteger('broker_type')->default(0)->comment('0=>non contracted 1=>contracted');
            $table->tinyinteger('is_lane_approved')->default(0)->comment('0=>not approved 1=>approved');
            $table->text('address')->nullable();
            $table->string('pan_card')->nullable();
            $table->string('cancel_cheque')->nullable();
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
        Schema::dropIfExists('brokers');
    }
}

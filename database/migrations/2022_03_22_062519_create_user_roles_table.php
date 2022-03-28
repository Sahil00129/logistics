<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedInteger('role_id');
            $table->foreign('role_id')
                  ->references('id')->on('roles')
                  ->onDelete('cascade');
            $table->tinyInteger('status')->default(0);
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
        Schema::table('user_roles', function (Blueprint $table) {
            // 1. Drop foreign key constraints
            $table->dropForeign(['user_id']);
            $table->dropForeign(['role_id']);
            
            $table->dropColumn('user_id');
            $table->dropColumn('role_id');
        });
        Schema::dropIfExists('user_roles');
    }
}

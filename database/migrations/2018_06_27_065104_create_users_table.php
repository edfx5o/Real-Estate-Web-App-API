<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('usertype_id');
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('username', 30)->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->steing('secret');
            $table->string('work_phone');
            $table->string('office_phone');
            $table->string('mobile_phone');
            $table->foreign('usertype_id')
                ->references('id')
                ->on('user_type')
                ->onDelete('cascade');
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
        Schema::dropIfExists('users');
    }
}

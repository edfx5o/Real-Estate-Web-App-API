<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokerageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brokerage', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner');
            $table->string('name');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('address_line3');
            $table->unsignedInteger('city_id');
            $table->string('primary_phone');
            $table->string('secondary_phone');
            $table->string('primary_fax');
            $table->string('secondary_fax');
            $table->foreign('owner')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('city_id')
                ->references('id')
                ->on('city_town');
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
        Schema::dropIfExists('brokerage');
    }
}

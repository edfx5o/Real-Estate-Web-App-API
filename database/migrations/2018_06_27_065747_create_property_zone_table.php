<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyZoneTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_zone', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('broker_id');
            $table->string('name');
            $table->string('short_name');
            $table->foreign('broker_id')
                ->references('id')
                ->on('brokerage')
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
        Schema::dropIfExists('property_zone');
    }
}

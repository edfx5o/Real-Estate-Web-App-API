<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrokerPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broker_properties', function (Blueprint $table) {
            $table->unsignedInteger('property_id');
            $table->unsignedInteger('broker_id');
            $table->unsignedInteger('zone_id');
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
                ->onDelete('cascade');
            $table->foreign('broker_id')
                ->references('id')
                ->on('brokerage')
                ->onDelete('cascade');
            $table->foreign('zone_id')
                ->references('id')
                ->on('property_zone');
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
        Schema::dropIfExists('broker_properties');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ltype_id');
            $table->unsignedInteger('ptype_id');
            $table->unsignedInteger('broker_id')->nullable();
            $table->unsignedInteger('zone_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->boolean('is_agent');
            $table->unsignedInteger('owner_id');
            $table->string('deed_no');
            $table->string('listing_no');
            $table->decimal('market_price', 20, 2);
            $table->decimal('list_price', 20, 2);
            $table->decimal('commission', 20, 2);
            $table->decimal('fees', 20, 2);
            $table->string('notes', 255);
            $table->string('status');
            $table->string('description', 255);
            $table->string('directions', 255);
            $table->string('service_charge');
            $table->string('geolocation');
            $table->foreign('ltype_id')
                ->references('id')
                ->on('list_type');
            $table->foreign('ptype_id')
                ->references('id')
                ->on('property_type')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('owner_id')
                ->references('id')
                ->on('owners')
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
        Schema::dropIfExists('properties');
    }
}

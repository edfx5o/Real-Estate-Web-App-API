<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFullPropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('full_property', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ltype_id');
            $table->unsignedInteger('ptype_id');
            $table->unsignedInteger('broker_id')->nullable();
            $table->unsignedInteger('zone_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->boolean('is_agent');
            $table->unsignedInteger('owner_id')->nullable();
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
            $table->string('land_size');
            $table->string('building_size');
            $table->string('viewing_info', 255);
            $table->string('furnishings', 255);
            $table->string('misc_info', 255);
            $table->string('mortgage_info', 255);
            $table->string('tenure');
            $table->string('years');
            $table->string('ren_opt', 255);
            $table->string('rent');
            $table->string('topo');
            $table->string('address_line1');
            $table->string('address_line2');
            $table->string('address_line3');
            $table->string('taxes');
            $table->string('wasa');
            $table->string('maintenance');
            $table->string('insurance');
            $table->string('comp_cert');
            $table->string('ac');
            $table->string('security');
            $table->string('pool');
            $table->string('w_tanks');
            $table->string('w_heater');
            $table->string('generator');
            $table->string('elevator');
            $table->string('partition');
            $table->string('fence');
            $table->string('bedrooms');
            $table->string('baths');
            $table->string('kitchen');
            $table->string('living');
            $table->string('dining');
            $table->string('family');
            $table->string('study');
            $table->string('tvroom');
            $table->string('powder');
            $table->string('laundry');
            $table->string('maid');
            $table->string('storage_room');
            $table->string('porch');
            $table->string('parking');
            $table->string('other');
            $table->string('age');
            $table->string('ceiling');
            $table->string('walls');
            $table->string('floors');
            $table->string('structure');
            $table->string('roof');
            $table->boolean('has_levels');
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
        Schema::dropIfExists('full_property');
    }
}

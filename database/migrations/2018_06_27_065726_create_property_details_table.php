<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_details', function (Blueprint $table) {
            $table->unsignedInteger('property_id');
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
            $table->foreign('property_id')
                ->references('id')
                ->on('properties')
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
        Schema::dropIfExists('property_details');
    }
}

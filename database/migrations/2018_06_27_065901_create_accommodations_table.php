<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('property_id');
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
        Schema::dropIfExists('accommodations');
    }
}

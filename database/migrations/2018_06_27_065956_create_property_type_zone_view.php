<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyTypeZoneView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW property_type_zone_view AS SELECT full_property.id, full_property.listing_no, list_type.name AS list_type, property_type.name AS property_type, full_property.status, full_property.list_price, property_zone.short_name AS zone FROM full_property, list_type, property_type, property_zone WHERE full_property.ltype_id = list_type.id AND full_property.ptype_id = property_type.id AND full_property.zone_id = property_zone.id;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW property_type_zone_view');
    }
}
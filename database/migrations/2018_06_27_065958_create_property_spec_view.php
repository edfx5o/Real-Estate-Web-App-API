<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertySpecView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW property_spec_view AS SELECT list_type.id AS "ltype_id", list_type.name AS "list_type", property_type.id AS "ptype_id", property_type.name AS "property_type", users.id AS "user_id", users.first_name, users.last_name, CONCAT(users.first_name, " ", users.last_name) AS "agent", properties.id AS "property_id", properties.status, properties.listing_no,properties.list_price,properties.directions,properties.description,properties.commission,properties.fees,properties.service_charge,properties.deed_no, property_details.land_size,property_details.building_size,property_details.viewing_info,property_details.mortgage_info,property_details.misc_info,property_details.furnishings,property_details.tenure,property_details.years,property_details.ren_opt,property_details.rent,property_details.topo, property_zone.id AS "zone_id", property_zone.short_name, property_zone.name,accommodations.id AS "accommodation_id", accommodations.bedrooms,accommodations.baths,accommodations.kitchen,accommodations.living,accommodations.dining,accommodations.tvroom,accommodations.powder,accommodations.storage_room,accommodations.maid,accommodations.family,accommodations.study,accommodations.laundry,accommodations.porch,accommodations.parking,accommodations.other, owners.id AS "owner_id",owners.name AS "owner_name",owners.address AS "owner_address",owners.contact,owners.contact_phone,owners.contact_email,owners.contact_fax,owners.fax,owners.primary_phone AS "owner_phone1",owners.secondary_phone AS "owner_phone2",owners.email AS "owner_email",owners.organisation, property_address.address_line1,property_address.address_line2,property_address.address_line3,property_construct.id AS "construct_id", property_construct.age,property_construct.ceiling,property_construct.walls,property_construct.floors,property_construct.structure,property_construct.roof,property_features.id AS "feature_id", property_features.ac, property_features.security,property_features.pool,property_features.w_tanks,property_features.w_heater,property_features.generator,property_features.elevator,property_features.partition,property_features.fence,property_taxes.id AS "tax_id",property_taxes.taxes,property_taxes.wasa,property_taxes.maintenance,property_taxes.insurance,property_taxes.comp_cert, brokerage.id AS "broker_id", brokerage.name AS "brokerage", brokerage.primary_phone AS "broker_phone"
            FROM list_type
            JOIN properties ON properties.ltype_id = list_type.id
            JOIN property_type ON property_type.id = properties.ptype_id
            JOIN users ON users.id = properties.user_id
            JOIN property_details ON property_details.property_id = properties.id
            JOIN property_zone ON property_zone.id = properties.zone_id
            JOIN accommodations ON accommodations.property_id = properties.id
            JOIN owners ON owners.id = properties.owner_id
            JOIN property_address ON property_address.property_id = properties.id
            JOIN property_construct ON property_construct.property_id = properties.id
            JOIN property_features ON property_features.property_id = properties.id
            JOIN property_taxes ON property_taxes.property_id = properties.id
            JOIN brokerage ON brokerage.id = properties.broker_id;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW property_spec_view');
    }
}
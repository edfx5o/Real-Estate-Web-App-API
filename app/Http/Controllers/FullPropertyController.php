<?php

namespace App\Http\Controllers;

use App\FullProperty;
use Illuminate\Http\Request;

class FullPropertyController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'ltype_id' => 'required',
            'ptype_id' => 'required',
            'user_id' => 'required',
            'listing_no' => 'required'
        ]);

        $data = new FullProperty;
        $data->ltype_id = $request->ltype_id;
        $data->ptype_id = $request->ptype_id;
        $data->user_id = $request->user_id;
        $data->listing_no = $request->listing_no;


        if ($request->owner_id) { $data->owner_id = $request->owner_id; }
        if ($request->status) { $data->status = $request->status; }
        if ($request->broker_id) { $data->broker_id = $request->broker_id; }
        if ($request->zone_id) { $data->zone_id = $request->zone_id; }
        if ($request->is_agent) { $data->is_agent = $request->is_agent; }
        if ($request->deed_no) { $data->deed_no = $request->deed_no; }
        if ($request->list_price) { $data->list_price = $request->list_price; }
        if ($request->market_price) { $data->market_price = $request->market_price; }
        if ($request->commission) { $data->commission = $request->commission; }
        if ($request->fees) { $data->fees = $request->fees; }
        if ($request->description) { $data->description = $request->description; }
        if ($request->directions) { $data->directions = $request->directions; }
        if ($request->service_charge) { $data->service_charge = $request->service_charge; }
        if ($request->address_line1) { $data->address_line1 = $request->address_line1; }
        if ($request->address_line2) { $data->address_line2 = $request->address_line2; }
        if ($request->address_line3) { $data->address_line3 = $request->address_line3; }
        if ($request->age) { $data->age = $request->age; }
        if ($request->ceiling) { $data->ceiling = $request->ceiling; }
        if ($request->walls) { $data->walls = $request->walls; }
        if ($request->floors) { $data->floors = $request->floors; }
        if ($request->structure) { $data->structure = $request->structure; }
        if ($request->roof) { $data->roof = $request->roof; }
        if ($request->land_size) { $data->land_size = $request->land_size; }
        if ($request->building_size) { $data->building_size = $request->building_size; }
        if ($request->viewing_info) { $data->viewing_info = $request->viewing_info; }
        if ($request->mortgage_info) { $data->mortgage_info = $request->mortgage_info; }
        if ($request->furnishings) { $data->furnishings = $request->furnishings; }
        if ($request->misc_info) { $data->misc_info = $request->misc_info; }
        if ($request->tenure) { $data->tenure = $request->tenure; }
        if ($request->years) { $data->years = $request->years; }
        if ($request->ren_opt) { $data->ren_opt = $request->ren_opt; }
        if ($request->rent) { $data->rent = $request->rent; }
        if ($request->topo) { $data->topo = $request->topo; }
        if ($request->ac) { $data->ac = $request->ac; }
        if ($request->security) { $data->security = $request->security; }
        if ($request->pool) { $data->pool = $request->pool; }
        if ($request->w_tanks) { $data->w_tanks = $request->w_tanks; }
        if ($request->w_heater) { $data->w_heater = $request->w_heater; }
        if ($request->generator) { $data->generator = $request->generator; }
        if ($request->elevator) { $data->elevator = $request->elevator; }
        if ($request->partition) { $data->partition = $request->partition; }
        if ($request->fence) { $data->fence = $request->fence; }
        if ($request->bedrooms) { $data->bedrooms = $request->bedrooms; }
        if ($request->baths) { $data->baths = $request->baths; }
        if ($request->kitchen) { $data->kitchen = $request->kitchen; }
        if ($request->living) { $data->living = $request->living; }
        if ($request->dining) { $data->dining = $request->dining; }
        if ($request->tvroom) { $data->tvroom = $request->tvroom; }
        if ($request->powder) { $data->powder = $request->powder; }
        if ($request->storage_room) { $data->storage_room = $request->storage_room; }
        if ($request->maid) { $data->maid = $request->maid; }
        if ($request->family) { $data->family = $request->family; }
        if ($request->study) { $data->study = $request->study; }
        if ($request->laundry) { $data->laundry = $request->laundry; }
        if ($request->porch) { $data->porch = $request->porch; }
        if ($request->parking) { $data->parking = $request->parking; }
        if ($request->other) { $data->other = $request->other; }
        if ($request->taxes) { $data->taxes = $request->taxes; }
        if ($request->wasa) { $data->wasa = $request->wasa; }
        if ($request->maintenance) { $data->maintenance = $request->maintenance; }
        if ($request->insurance) { $data->insurance = $request->insurance; }
        if ($request->comp_cert) { $data->comp_cert = $request->comp_cert; }
        if ($request->notes) { $data->notes = $request->notes; }
        if ($request->geolocation) { $data->geolocation = $request->geolocation; }

        try {
            $data->save();
            return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return response()->json(['status' => 500, 'desc' => 'ERROR', 'message' => 'Listing Number already exists', 'field' => 'listing_no']);
            }
            return response()->json(['status' => 500, 'desc' => 'ERROR', 'message' => $e->getMessage()]);
        } catch (PDOException $e) {
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return response()->json(['status' => 500, 'desc' => 'ERROR', 'message' => 'Listing Number already exists', 'field' => 'listing_no']);
            }
            return response()->json(['status' => 500, 'desc' => 'ERROR', 'message' => $e->getMessage()]);
        }
        
    }

    public function update ($id, Request $request)
    {
        $data = FullProperty::findOrFail($id);

        if ($request->user_id) { $data->user_id = $request->user_id; }
        if ($request->listing_no) { $data->listing_no = $request->listing_no; }
        if ($request->ltype_id) { $data->ltype_id = $request->ltype_id; }
        if ($request->ptype_id) { $data->ptype_id = $request->ptype_id; }
        if ($request->owner_id) { $data->owner_id = $request->owner_id; }
        if ($request->status) { $data->status = $request->status; }
        if ($request->broker_id) { $data->broker_id = $request->broker_id; }
        if ($request->zone_id) { $data->zone_id = $request->zone_id; }
        if ($request->is_agent) { $data->is_agent = $request->is_agent; }
        if ($request->deed_no) { $data->deed_no = $request->deed_no; }
        if ($request->list_price) { $data->list_price = $request->list_price; }
        if ($request->market_price) { $data->market_price = $request->market_price; }
        if ($request->commission) { $data->commission = $request->commission; }
        if ($request->fees) { $data->fees = $request->fees; }
        if ($request->description) { $data->description = $request->description; }
        if ($request->directions) { $data->directions = $request->directions; }
        if ($request->service_charge) { $data->service_charge = $request->service_charge; }
        if ($request->address_line1) { $data->address_line1 = $request->address_line1; }
        if ($request->address_line2) { $data->address_line2 = $request->address_line2; }
        if ($request->address_line3) { $data->address_line3 = $request->address_line3; }
        if ($request->age) { $data->age = $request->age; }
        if ($request->ceiling) { $data->ceiling = $request->ceiling; }
        if ($request->walls) { $data->walls = $request->walls; }
        if ($request->floors) { $data->floors = $request->floors; }
        if ($request->structure) { $data->structure = $request->structure; }
        if ($request->roof) { $data->roof = $request->roof; }
        if ($request->land_size) { $data->land_size = $request->land_size; }
        if ($request->building_size) { $data->building_size = $request->building_size; }
        if ($request->viewing_info) { $data->viewing_info = $request->viewing_info; }
        if ($request->mortgage_info) { $data->mortgage_info = $request->mortgage_info; }
        if ($request->furnishings) { $data->furnishings = $request->furnishings; }
        if ($request->misc_info) { $data->misc_info = $request->misc_info; }
        if ($request->tenure) { $data->tenure = $request->tenure; }
        if ($request->years) { $data->years = $request->years; }
        if ($request->ren_opt) { $data->ren_opt = $request->ren_opt; }
        if ($request->rent) { $data->rent = $request->rent; }
        if ($request->topo) { $data->topo = $request->topo; }
        if ($request->ac) { $data->ac = $request->ac; }
        if ($request->security) { $data->security = $request->security; }
        if ($request->pool) { $data->pool = $request->pool; }
        if ($request->w_tanks) { $data->w_tanks = $request->w_tanks; }
        if ($request->w_heater) { $data->w_heater = $request->w_heater; }
        if ($request->generator) { $data->generator = $request->generator; }
        if ($request->elevator) { $data->elevator = $request->elevator; }
        if ($request->partition) { $data->partition = $request->partition; }
        if ($request->fence) { $data->fence = $request->fence; }
        if ($request->bedrooms) { $data->bedrooms = $request->bedrooms; }
        if ($request->baths) { $data->baths = $request->baths; }
        if ($request->kitchen) { $data->kitchen = $request->kitchen; }
        if ($request->living) { $data->living = $request->living; }
        if ($request->dining) { $data->dining = $request->dining; }
        if ($request->tvroom) { $data->tvroom = $request->tvroom; }
        if ($request->powder) { $data->powder = $request->powder; }
        if ($request->storage_room) { $data->storage_room = $request->storage_room; }
        if ($request->maid) { $data->maid = $request->maid; }
        if ($request->family) { $data->family = $request->family; }
        if ($request->study) { $data->study = $request->study; }
        if ($request->laundry) { $data->laundry = $request->laundry; }
        if ($request->porch) { $data->porch = $request->porch; }
        if ($request->parking) { $data->parking = $request->parking; }
        if ($request->other) { $data->other = $request->other; }
        if ($request->taxes) { $data->taxes = $request->taxes; }
        if ($request->wasa) { $data->wasa = $request->wasa; }
        if ($request->maintenance) { $data->maintenance = $request->maintenance; }
        if ($request->insurance) { $data->insurance = $request->insurance; }
        if ($request->comp_cert) { $data->comp_cert = $request->comp_cert; }
        if ($request->notes) { $data->notes = $request->notes; }
        if ($request->geolocation) { $data->geolocation = $request->geolocation; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(FullProperty::all());
    }

    public function get ($id)
    {
        return response()->json(FullProperty::find($id));
    }

    public function delete ($id)
    {
        FullProperty::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
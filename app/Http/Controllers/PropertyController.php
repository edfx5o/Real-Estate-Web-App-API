<?php

namespace App\Http\Controllers;

use App\Level;
use App\Property;
use App\PropertySpecView;
use App\PropertyTypeZoneView;
use Illuminate\Http\Request;

class PropertyController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'ltype_id' => 'required',
            'ptype_id' => 'required',
            'user_id' => 'required',
            'listing_no' => 'required'
        ]);

        $data = new Property;
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
        //if ($request->market_price) { $data->market_price = $request->market_price; }
        if ($request->list_price) { $data->list_price = $request->list_price; }
        if ($request->commission) { $data->commission = $request->commission; }
        if ($request->fees) { $data->fees = $request->fees; }
        //if ($request->notes) { $data->notes = $request->notes; }
        if ($request->description) { $data->description = $request->description; }
        if ($request->directions) { $data->directions = $request->directions; }
        //if ($request->geolocation) { $data->geolocation = $request->geolocation; }
        if ($request->service_charge) { $data->service_charge = $request->service_charge; }
        $data->save();

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Property::findOrFail($id);

        if ($request->ltype_id) { $data->ltype_id = $request->ltype_id; }
        if ($request->ptype_id) { $data->ptype_id = $request->ptype_id; }
        if ($request->broker_id) { $data->broker_id = $request->broker_id; }
        if ($request->zone_id) { $data->zone_id = $request->zone_id; }
        if ($request->user_id) { $data->user_id = $request->user_id; }
        if ($request->is_agent) { $data->is_agent = $request->is_agent; }
        if ($request->owner_id) { $data->owner_id = $request->owner_id; }
        if ($request->deed_no) { $data->deed_no = $request->deed_no; }
        if ($request->listing_no) { $data->listing_no = $request->listing_no; }
        //if ($request->market_price) { $data->market_price = $request->market_price; }
        if ($request->list_price) { $data->list_price = $request->list_price; }
        if ($request->commission) { $data->commission = $request->commission; }
        if ($request->fees) { $data->fees = $request->fees; }
        //if ($request->notes) { $data->notes = $request->notes; }
        if ($request->status) { $data->status = $request->status; }
        if ($request->description) { $data->description = $request->description; }
        if ($request->directions) { $data->directions = $request->directions; }
        //if ($request->geolocation) { $data->geolocation = $request->geolocation; }
        if ($request->service_charge) { $data->service_charge = $request->service_charge; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getPropertySpec ($id)
    {
        $spec = PropertySpecView::where('property_id', $id)->get();
        $lvl =  Level::where('property_id', $id)->get();

        return response()->json(['status' => 200, 'spec' => $spec, 'levels' => $lvl]); 
    }

    public function getAll ()
    {
        return response()->json(Property::all());
    }

    public function getList ()
    {
        return response()->json(PropertyTypeZoneView::all());
    }

    public function get ($id)
    {
        return response()->json(Property::find($id));
    }

    public function delete ($id)
    {
        Property::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
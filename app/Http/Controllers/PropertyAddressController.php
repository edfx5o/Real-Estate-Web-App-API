<?php

namespace App\Http\Controllers;

use App\PropertyAddress;
use Illuminate\Http\Request;

class PropertyAddressController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'property_id' => 'required'
        ]);

        $data = new PropertyAddress;
        $data->property_id = $request->property_id;

        if ($request->address_line1) { $data->address_line1 = $request->address_line1; }
        if ($request->address_line2) { $data->address_line2 = $request->address_line2; }
        if ($request->address_line3) { $data->address_line3 = $request->address_line3; }
        // if ($request->city_id) { $data->city_id = $request->city_id; }
        // if ($request->geolocation) { $data->geolocation = $request->geolocation; }
        
        $data->save();
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = PropertyAddress::findOrFail($id);

        if ($request->address_line1) { $data->address_line1 = $request->address_line1; }
        if ($request->address_line2) { $data->address_line2 = $request->address_line2; }
        if ($request->address_line3) { $data->address_line3 = $request->address_line3; }
        // if ($request->city_id) { $data->city_id = $request->city_id; }
        // if ($request->geolocation) { $data->geolocation = $request->geolocation; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(PropertyAddress::all());
    }

    public function get ($id)
    {
        return response()->json(PropertyAddress::find($id));
    }

    public function delete ($id)
    {
        PropertyAddress::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
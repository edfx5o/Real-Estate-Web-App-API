<?php

namespace App\Http\Controllers;

use App\PropertyDetails;
use Illuminate\Http\Request;

class PropertyDetailsController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'property_id' => 'required'
        ]);

        $data = new PropertyDetails;
        $data->property_id = $request->property_id;
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
        $data->save();

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = PropertyDetails::findOrFail($id);

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
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(PropertyDetails::all());
    }

    public function get ($id)
    {
        return response()->json(PropertyDetails::find($id));
    }

    public function delete ($id)
    {
        PropertyDetails::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
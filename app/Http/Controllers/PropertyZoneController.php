<?php

namespace App\Http\Controllers;

use App\PropertyZone;
use Illuminate\Http\Request;

class PropertyZoneController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'broker_id' => 'required',
            'name' => 'required',
            'short_name' => 'required'
        ]);

        $data = PropertyZone::create($request->all());

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = PropertyZone::findOrFail($id);

        if ($request->name) { $data->name = $request->name; }
        if ($request->short_name) { $data->short_name = $request->short_name; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(PropertyZone::all());
    }

    public function get ($id)
    {
        return response()->json(PropertyZone::find($id));
    }

    public function delete ($id)
    {
        PropertyZone::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
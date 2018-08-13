<?php

namespace App\Http\Controllers;

use App\PropertyFeature;
use Illuminate\Http\Request;

class PropertyFeatureController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'property_id' => 'required'
        ]);

        $data = new PropertyFeature;
        $data->property_id = $request->property_id;
        if ($request->ac) { $data->ac = $request->ac; }
        if ($request->security) { $data->security = $request->security; }
        if ($request->pool) { $data->pool = $request->pool; }
        if ($request->w_tanks) { $data->w_tanks = $request->w_tanks; }
        if ($request->w_heater) { $data->w_heater = $request->w_heater; }
        if ($request->generator) { $data->generator = $request->generator; }
        if ($request->elevator) { $data->elevator = $request->elevator; }
        if ($request->partition) { $data->partition = $request->partition; }
        if ($request->fence) { $data->fence = $request->fence; }
        
        $data->save();
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = PropertyFeature::findOrFail($id);

        if ($request->ac) { $data->ac = $request->ac; }
        if ($request->security) { $data->security = $request->security; }
        if ($request->pool) { $data->pool = $request->pool; }
        if ($request->w_tanks) { $data->w_tanks = $request->w_tanks; }
        if ($request->w_heater) { $data->w_heater = $request->w_heater; }
        if ($request->generator) { $data->generator = $request->generator; }
        if ($request->elevator) { $data->elevator = $request->elevator; }
        if ($request->partition) { $data->partition = $request->partition; }
        if ($request->fence) { $data->fence = $request->fence; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(PropertyFeature::all());
    }

    public function get ($id)
    {
        return response()->json(PropertyFeature::find($id));
    }

    public function delete ($id)
    {
        PropertyFeature::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
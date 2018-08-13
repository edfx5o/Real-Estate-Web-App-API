<?php

namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = Feature::create($request->all());
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Feature::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(Feature::all());
    }

    public function get ($id)
    {
        return response()->json(Feature::find($id));
    }

    public function delete ($id)
    {
        Feature::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
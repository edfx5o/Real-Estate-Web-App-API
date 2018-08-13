<?php

namespace App\Http\Controllers;

use App\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = PropertyType::create($request->all());
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = PropertyType::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(PropertyType::all());
    }

    public function get ($id)
    {
        return response()->json(PropertyType::find($id));
    }

    public function delete ($id)
    {
        PropertyType::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
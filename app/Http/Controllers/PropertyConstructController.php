<?php

namespace App\Http\Controllers;

use App\PropertyConstruct;
use Illuminate\Http\Request;

class PropertyConstructController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'property_id' => 'required'
        ]);

        $data = new PropertyConstruct;
        $data->property_id = $request->property_id;
        if ($request->age) { $data->age = $request->age; }
        if ($request->ceiling) { $data->ceiling = $request->ceiling; }
        if ($request->walls) { $data->walls = $request->walls; }
        if ($request->floors) { $data->floors = $request->floors; }
        if ($request->structure) { $data->structure = $request->structure; }
        if ($request->roof) { $data->roof = $request->roof; }
        
        $data->save();

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = PropertyConstruct::findOrFail($id);

        if ($request->age) { $data->age = $request->age; }
        if ($request->ceiling) { $data->ceiling = $request->ceiling; }
        if ($request->walls) { $data->walls = $request->walls; }
        if ($request->floors) { $data->floors = $request->floors; }
        if ($request->structure) { $data->structure = $request->structure; }
        if ($request->roof) { $data->roof = $request->roof; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(PropertyConstruct::all());
    }

    public function get ($id)
    {
        return response()->json(PropertyConstruct::find($id));
    }

    public function delete ($id)
    {
        PropertyConstruct::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}

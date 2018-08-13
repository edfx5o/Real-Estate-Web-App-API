<?php

namespace App\Http\Controllers;

use App\PinnedProperty;
use Illuminate\Http\Request;

class PinnedPropertyController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'user_id' => 'required',
            'property_id' => 'required'
        ]);

        $data = PinnedProperty::create($request->all());

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = PinnedProperty::findOrFail($id);

        if ($request->property_id) { $data->name = $request->property_id; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(PinnedProperty::all());
    }

    public function get ($id)
    {
        return response()->json(PinnedProperty::find($id));
    }

    public function delete ($id)
    {
        PinnedProperty::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
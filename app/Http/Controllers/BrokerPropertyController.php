<?php

namespace App\Http\Controllers;

use App\BrokerProperty;
use Illuminate\Http\Request;

class BrokerPropertyController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'property_id' => 'required',
            'broker_id' => 'required',
            'zone_id' => 'required'
        ]);

        $data = BrokerProperty::create($request->all());

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = BrokerProperty::findOrFail($id);

        if ($request->zone_id) { $data->name = $request->zone_id; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(BrokerProperty::all());
    }

    public function get ($id)
    {
        return response()->json(BrokerProperty::find($id));
    }

    public function delete ($id)
    {
        BrokerProperty::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
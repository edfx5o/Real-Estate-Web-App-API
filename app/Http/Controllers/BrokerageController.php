<?php

namespace App\Http\Controllers;

use App\Brokerage;
use Illuminate\Http\Request;

class BrokerageController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'owner' => 'required',
            'name' => 'required',
            'city_id' => 'required'
        ]);

        $data = Brokerage::create($request->all());;
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Brokerage::findOrFail($id);

        if ($request->owner) { $data->owner = $request->owner; }
        if ($request->name) { $data->name = $request->name; }
        if ($request->address_line1) { $data->address_line1 = $request->address_line1; }
        if ($request->address_line2) { $data->address_line2 = $request->address_line2; }
        if ($request->address_line3) { $data->address_line3 = $request->address_line3; }
        if ($request->city_id) { $data->city_id = $request->city_id; }
        if ($request->primary_phone) { $data->primary_phone = $request->primary_phone; }
        if ($request->secondary_phone) { $data->secondary_phone = $request->secondary_phone; }
        if ($request->primary_fax) { $data->primary_fax = $request->primary_fax; }
        if ($request->secondary_fax) { $data->secondary_fax = $request->secondary_fax; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(Brokerage::all());
    }

    public function get ($id)
    {
        return response()->json(Brokerage::find($id));
    }

    public function delete ($id)
    {
        Brokerage::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
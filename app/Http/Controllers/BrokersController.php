<?php

namespace App\Http\Controllers;

use App\Brokers;
use Illuminate\Http\Request;

class BrokersController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'user_id' => 'required',
            'broker_id' => 'required'
        ]);

        $data = Brokers::create($request->all());

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Brokers::findOrFail($id);

        if ($request->broker_id) { $data->broker_id = $request->broker_id; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(Brokers::all());
    }

    public function get ($id)
    {
        return response()->json(Brokers::find($id));
    }

    public function delete ($id)
    {
        Brokers::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
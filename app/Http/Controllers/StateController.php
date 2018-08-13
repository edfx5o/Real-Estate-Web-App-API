<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class StateController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'country_id' => 'required'
        ]);

        $data = State::create($request->all());
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = State::findOrFail($id);
        $data->name = $request->name;
        $data->country_id = $request->country_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function getAll ()
    {
        return response()->json(State::all());
    }

    public function get ($id)
    {
        return response()->json(State::find($id));
    }

    public function delete ($id)
    {
        State::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
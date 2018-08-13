<?php

namespace App\Http\Controllers;

use App\CityTown;
use Illuminate\Http\Request;

class CityTownController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'state_id' => 'required'
        ]);

        $data = CityTown::create($request->all());
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = CityTown::findOrFail($id);
        $data->name = $request->name;
        $data->state_id = $request->state_id;
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(CityTown::all());
    }

    public function get ($id)
    {
        return response()->json(CityTown::find($id));
    }

    public function delete ($id)
    {
        CityTown::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
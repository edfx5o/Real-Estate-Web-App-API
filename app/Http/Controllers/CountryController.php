<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'sortname' => 'required',
            'name' => 'required',
            'phonecode' => 'required'
        ]);

        $data = Country::create($request->all());
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Country::findOrFail($id);
        $data->sortname = $request->sortname;
        $data->name = $request->name;
        $data->phonecode = $request->phonecode;
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(Country::all());
    }

    public function get ($id)
    {
        return response()->json(Country::find($id));
    }

    public function delete ($id)
    {
        Country::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
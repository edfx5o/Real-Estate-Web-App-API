<?php

namespace App\Http\Controllers;

use App\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'property_id' => 'required'
        ]);

        $data = new Level;
        $data->property_id = $request->property_id;

        if ($request->level) { $data->level = $request->level; }
        if ($request->net_internal) { $data->net_internal = $request->net_internal; }
        if ($request->common) { $data->common = $request->common; }
        if ($request->rentable) { $data->rentable = $request->rentable; }
        if ($request->gross) { $data->gross = $request->gross; }
        if ($request->rent_psf) { $data->rent_psf = $request->rent_psf; }

        $data->save();
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Level::findOrFail($id);

        if ($request->level) { $data->level = $request->level; }
        if ($request->net_internal) { $data->net_internal = $request->net_internal; }
        if ($request->common) { $data->common = $request->common; }
        if ($request->rentable) { $data->rentable = $request->rentable; }
        if ($request->gross) { $data->gross = $request->gross; }
        if ($request->rent_psf) { $data->rent_psf = $request->rent_psf; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(Level::all());
    }

    public function getPropertyLevels ($id)
    {
        $data = Level::where('property_id', $id)->get();
        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function get ($id)
    {
        return response()->json(Level::find($id));
    }

    public function delete ($id)
    {
        Level::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
<?php

namespace App\Http\Controllers;

use App\ListType;
use Illuminate\Http\Request;

class ListTypeController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = ListType::create($request->all());
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = ListType::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(ListType::all());
    }

    public function get ($id)
    {
        return response()->json(ListType::find($id));
    }

    public function delete ($id)
    {
        ListType::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
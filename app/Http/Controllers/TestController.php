<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'title' => 'required'
        ]);

        $data = Test::create($request->all());;
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Test::findOrFail($id);

        if ($request->title) { $data->title = $request->title; }
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(Test::all());
    }

    public function get ($id)
    {
        return response()->json(Test::find($id));
    }

    public function delete ($id)
    {
        Test::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
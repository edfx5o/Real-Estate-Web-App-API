<?php

namespace App\Http\Controllers;

use App\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $data = UserType::create($request->all());
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = UserType::findOrFail($id);
        $data->name = $request->name;
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(UserType::all());
    }

    public function get ($id)
    {
        return response()->json(UserType::find($id));
    }

    public function delete ($id)
    {
        UserType::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
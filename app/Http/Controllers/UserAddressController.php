<?php

namespace App\Http\Controllers;

use App\UserAddress;
use Illuminate\Http\Request;

class UserAddressController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'user_id' => 'required'
        ]);

        $data = new UserAddress;
        $data->user_id = $request->user_id;

        if ($request->address_line1) { $data->address_line1 = $request->address_line1; }
        if ($request->address_line2) { $data->address_line2 = $request->address_line2; }
        if ($request->address_line3) { $data->address_line3 = $request->address_line3; }
        if ($request->city_id) { $data->city_id = $request->city_id; }
        
        $data->save()

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = UserAddress::findOrFail($id);

        if ($request->address_line1) { $data->address_line1 = $request->address_line1; }
        if ($request->address_line2) { $data->address_line2 = $request->address_line2; }
        if ($request->address_line3) { $data->address_line3 = $request->address_line3; }
        if ($request->city_id) { $data->city_id = $request->city_id; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(UserAddress::all());
    }

    public function get ($id)
    {
        return response()->json(UserAddress::find($id));
    }

    public function delete ($id)
    {
        UserAddress::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
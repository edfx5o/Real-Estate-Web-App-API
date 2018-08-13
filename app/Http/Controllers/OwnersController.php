<?php

namespace App\Http\Controllers;

use App\Owners;
use Illuminate\Http\Request;

class OwnersController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            //'name' => 'required'
        ]);

        $data = new Owners;

        if ($request->name) { $data->name = $request->name; }
        if ($request->address) { $data->address = $request->address; }
        if ($request->primary_phone) { $data->primary_phone = $request->primary_phone; }
        if ($request->secondary_phone) { $data->secondary_phone = $request->secondary_phone; }
        if ($request->organisation) { $data->organisation = $request->organisation; }
        if ($request->email) { $data->email = $request->email; }
        if ($request->contact) { $data->contact = $request->contact; }
        if ($request->contact_phone) { $data->contact_phone = $request->contact_phone; }
        if ($request->contact_email) { $data->contact_email = $request->contact_email; }
        if ($request->contact_fax) { $data->contact_fax = $request->contact_fax; }
        if ($request->note) { $data->note = $request->note; }
        if ($request->fax) { $data->fax = $request->fax; }
        
        $data->save();
        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Owners::findOrFail($id);

        if ($request->name) { $data->name = $request->name; }
        if ($request->address) { $data->address = $request->address; }
        if ($request->primary_phone) { $data->primary_phone = $request->primary_phone; }
        if ($request->secondary_phone) { $data->secondary_phone = $request->secondary_phone; }
        if ($request->organisation) { $data->organisation = $request->organisation; }
        if ($request->email) { $data->email = $request->email; }
        if ($request->contact) { $data->contact = $request->contact; }
        if ($request->contact_phone) { $data->contact_phone = $request->contact_phone; }
        if ($request->contact_email) { $data->contact_email = $request->contact_email; }
        if ($request->contact_fax) { $data->contact_fax = $request->contact_fax; }
        if ($request->note) { $data->note = $request->note; }
        if ($request->fax) { $data->fax = $request->fax; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(Owners::all());
    }

    public function get ($id)
    {
        return response()->json(Owners::find($id));
    }

    public function delete ($id)
    {
        Owners::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
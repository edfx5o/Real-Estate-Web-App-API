<?php

namespace App\Http\Controllers;

use App\PropertyTax;
use Illuminate\Http\Request;

class PropertyTaxController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'property_id' => 'required'
        ]);

        $data = new PropertyTax;
        $data->property_id = $request->property_id;
        if ($request->taxes) { $data->taxes = $request->taxes; }
        if ($request->wasa) { $data->wasa = $request->wasa; }
        if ($request->maintenance) { $data->maintenance = $request->maintenance; }
        if ($request->insurance) { $data->insurance = $request->insurance; }
        if ($request->comp_cert) { $data->comp_cert = $request->comp_cert; }
        
        $data->save();

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = PropertyTax::findOrFail($id);

        if ($request->taxes) { $data->taxes = $request->taxes; }
        if ($request->wasa) { $data->wasa = $request->wasa; }
        if ($request->maintenance) { $data->maintenance = $request->maintenance; }
        if ($request->insurance) { $data->insurance = $request->insurance; }
        if ($request->comp_cert) { $data->comp_cert = $request->comp_cert; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(PropertyTax::all());
    }

    public function get ($id)
    {
        return response()->json(PropertyTax::find($id));
    }

    public function delete ($id)
    {
        PropertyTax::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
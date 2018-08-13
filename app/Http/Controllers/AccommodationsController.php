<?php

namespace App\Http\Controllers;

use App\Accommodations;
use Illuminate\Http\Request;

class AccommodationsController extends Controller
{

    public function create (Request $request) {
        $this->validate($request, [
            'property_id' => 'required'
        ]);

        $data = Accommodations::create($request->all());
        $data->property_id = $request->property_id;
        if ($request->bedrooms) { $data->bedrooms = $request->bedrooms; }
        if ($request->baths) { $data->baths = $request->baths; }
        if ($request->kitchen) { $data->kitchen = $request->kitchen; }
        if ($request->living) { $data->living = $request->living; }
        if ($request->dining) { $data->dining = $request->dining; }
        if ($request->tvroom) { $data->tvroom = $request->tvroom; }
        if ($request->powder) { $data->powder = $request->powder; }
        if ($request->storage_room) { $data->storage_room = $request->storage_room; }
        if ($request->maid) { $data->maid = $request->maid; }
        if ($request->family) { $data->family = $request->family; }
        if ($request->study) { $data->study = $request->study; }
        if ($request->laundry) { $data->laundry = $request->laundry; }
        if ($request->porch) { $data->porch = $request->porch; }
        if ($request->parking) { $data->parking = $request->parking; }
        if ($request->other) { $data->other = $request->other; }
        
        $data->save();

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = Accommodations::findOrFail($id);

        if ($request->bedrooms) { $data->bedrooms = $request->bedrooms; }
        if ($request->baths) { $data->baths = $request->baths; }
        if ($request->kitchen) { $data->kitchen = $request->kitchen; }
        if ($request->living) { $data->living = $request->living; }
        if ($request->dining) { $data->dining = $request->dining; }
        if ($request->tvroom) { $data->tvroom = $request->tvroom; }
        if ($request->powder) { $data->powder = $request->powder; }
        if ($request->storage_room) { $data->storage_room = $request->storage_room; }
        if ($request->maid) { $data->maid = $request->maid; }
        if ($request->family) { $data->family = $request->family; }
        if ($request->study) { $data->study = $request->study; }
        if ($request->laundry) { $data->laundry = $request->laundry; }
        if ($request->porch) { $data->porch = $request->porch; }
        if ($request->parking) { $data->parking = $request->parking; }
        if ($request->other) { $data->other = $request->other; }
        
        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getAll ()
    {
        return response()->json(Accommodations::all());
    }

    public function get ($id)
    {
        return response()->json(Accommodations::find($id));
    }

    public function delete ($id)
    {
        Accommodations::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
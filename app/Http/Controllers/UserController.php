<?php

namespace App\Http\Controllers;

use App\User;
use App\Session;
use App\Brokers;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function login (Request $request)
    {
        
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $data = User::where('email', $request->email)
                        ->where('password', sha1(md5($request->input('password'))))
                        ->first();

            if (!is_null($data)) {
                
                $session = Session::firstOrNew(array('user_id' => $data->id));
                $session->token = sha1(md5(str_random(10).date('Y-m-d H:i:s')));
                $session->identifier = !is_null($session->identifier) ? $session->identifier : sha1(md5(str_random(10).date('His')));
                $session->save();

                $brokerage = Brokers::where('user_id', $data->id)->get();

                return response()->json(['status' => 200, 'desc' => 'OK', 'data' => $data, 'session' => $session, 'brokerage' => $brokerage]); 
            } else {
                return response()->json(['status' => 404, 'desc' => 'NOT FOUND']); 
            }
        }
    }

    public function create (Request $request) {
        $this->validate($request, [
            'usertype_id' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data = new User;
        $data->usertype_id = $request->usertype_id;
        $data->email = $request->email;
        $data->secret = sha1(md5($request->email));
        $data->password = sha1(md5($request->password));

        if ($request->first_name) { $data->first_name = $request->first_name; }
        if ($request->last_name) { $data->last_name = $request->last_name; } // user->lastname needs to be changed to ->last_name
        if ($request->username) { $data->username = $request->username; }
        if ($request->work_phone) { $data->work_phone = $request->work_phone; }
        if ($request->office_phone) { $data->office_phone = $request->office_phone; }
        if ($request->mobile_phone) { $data->mobile_phone = $request->mobile_phone; }

        $data->save();

        return response()->json(['status' => 201, 'desc' => 'CREATED', 'request' => $data]); 
    }

    public function update ($id, Request $request)
    {
        $data = User::findOrFail($id);
        
        if ($request->usertype_id) { $data->usertype_id = $request->usertype_id; }
        if ($request->email) { 
            $data->email = $request->email;
            $data->secret = sha1(md5($request->email));
        }
        if ($request->password) { $data->password = sha1(md5($request->password)); }
        if ($request->first_name) { $data->first_name = $request->first_name; }
        if ($request->last_name) { $data->last_name = $request->last_name; }
        if ($request->username) { $data->username = $request->username; }
        if ($request->work_phone) { $data->work_phone = $request->work_phone; }
        if ($request->office_phone) { $data->office_phone = $request->office_phone; }
        if ($request->mobile_phone) { $data->mobile_phone = $request->mobile_phone; }

        $data->save();

        return response()->json(['request' => $data, 'status' => 200]);
    }

    public function getUserBySecret (Request $request) 
    {
        $data = User::where('secret', $request->secret)->get();
        return response()->json($data);
    }

    public function getAgents ()
    {
        $data = User::where('usertype_id', '>', 1)->get();
        return response()->json($data);
    }

    public function getAll ()
    {
        return response()->json(User::all());
    }

    public function get ($id)
    {
        return response()->json(User::find($id));
    }

    public function delete ($id)
    {
        User::findOrFail($id)->delete();
        return response()->json(['status' => 200, 'desc' => 'Successfully deleted']); 
    }
}
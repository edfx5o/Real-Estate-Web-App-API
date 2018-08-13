<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ValidationController extends Controller
{

    public function user (Request $request)
    {
        
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            $user = User::where('email', $request->input('email'))->where('password', sha1(md5($request->input('password'))))->first();

            if (!is_null($user)) {
                return response()->json(['status' => 200, 'desc' => 'OK', 'data' => $user]); 
            } else {
                return response()->json(['status' => 404, 'desc' => 'NOT FOUND']); 
            }
        }
    }
}
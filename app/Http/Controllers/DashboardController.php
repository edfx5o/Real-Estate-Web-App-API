<?php

namespace App\Http\Controllers;

//use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function checkLogin () {
        return view('dashboard');
    }

    public function load () {

    }
}
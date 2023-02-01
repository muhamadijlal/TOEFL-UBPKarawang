<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardAdmin(){
        return view('layouts.admin.dashboard');
    }

    public function dashboardUser(){
        return view('layouts.user.dashboard');
    }
}

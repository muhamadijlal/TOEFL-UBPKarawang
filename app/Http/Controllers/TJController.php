<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TJController extends Controller
{
    public function pelatihan(){
        return view('layouts.admin.japan.pelatihan.index');
    }

    public function test(){
        return view('layouts.admin.japan.test.index');
    }

    public function pelatihan_test(){
        return view('layouts.admin.japan.pelatihan_test.index');
    }
}

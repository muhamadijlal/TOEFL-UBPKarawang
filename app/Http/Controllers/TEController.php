<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TEController extends Controller
{
    public function pelatihan(){
        return view('layouts.admin.english.pelatihan.index');
    }

    public function test(){
        return view('layouts.admin.english.test.index');
    }

    public function pelatihan_test(){
        return view('layouts.admin.english.pelatihan_test.index');
    }
}

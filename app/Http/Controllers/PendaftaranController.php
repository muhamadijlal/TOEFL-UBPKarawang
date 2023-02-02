<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function create(){
        return view('layouts.user.pendaftaran.create');
    }

    public function invoice(){
        return view('layouts.user.pendaftaran.invoice');
    }

    public function store(Request $request){

        $request->validate([
            'nama' => ['required'],
            'nim' => ['required'],
            'telepon' => ['required','numeric'],
            'email' => ['required','email'],
            'semester' => ['required'],
            'bahasa' => ['required'],
            'jenis' => ['required'],
        ]);

        Pendaftaran::create([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'telepon' => $request->telepon,
            'email' => $request->email,
            'semester' => $request->semester,
            'bahasa' => $request->bahasa,
            'jenis' => $request->jenis,
        ]);

        return redirect()->route('user.invoice')->with('status','Pendaftaran Selesai, Lanjutkan pembayaran menggunakan Nomor Virtual');
    }
}

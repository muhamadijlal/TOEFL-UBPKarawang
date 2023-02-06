<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Mail\registeredMail;
use Illuminate\Support\Facades\Mail;

class PendaftaranController extends Controller
{
    public function create(){
        return view('layouts.user.pendaftaran.create');
    }

    public function invoice($nim){
        $data = Pendaftaran::where('nim', $nim)->first();
        return view('layouts.user.pendaftaran.invoice', compact('data'));
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
            'status_pembayaran' => 'belum dibayar',
        ]);

        Mail::to('haidarijlal027@gmail.com')
            ->send(new registeredMail());

        return redirect()->route('user.invoice', $request->nim)->with('status','Pendaftaran Selesai, Lanjutkan pembayaran menggunakan Nomor Virtual');
    }
}

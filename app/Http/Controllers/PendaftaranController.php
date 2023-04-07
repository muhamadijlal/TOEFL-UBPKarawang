<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pendaftaran;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\registeredMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function create(){
        $jenisTOEFL = Product::get();
        return view('layouts.user.pendaftaran.create', compact('jenisTOEFL'));
    }

    public function invoice($pendaftaran_id){
        $data = Pendaftaran::with(['user','product'])->where('id', $pendaftaran_id)->first();
        return view('layouts.user.pendaftaran.invoice', compact('data'));
    }

    public function store(Request $request){

        $request->validate([
            'semester' => ['required'],
            'jenis' => ['required'],
        ]);

        $product = Product::where('id',$request->jenis)->first('harga');
        $subtotal = $product->harga;
        
        $pendaftaran_id = Pendaftaran::create([
            'user_id' => Auth::user()->id,
            'semester' => $request->semester,
            'product_id' => $request->jenis,
            'subtotal' => $subtotal,
            'VA' => Str::random(10),
            'status_pembayaran' => 'belum dibayar',
        ])->id;

        Invoice::create([
            'nomor_invoice' => date('dmY').Str::random(5),
            'user_id' => Auth::user()->id,
            'pendaftaran_id' => $pendaftaran_id,
        ]);

        Mail::to('haidarijlal027@gmail.com')
            ->send(new registeredMail());

        return redirect()->route('user.dashboard')->with('success','Pendaftaran Selesai, Lanjutkan pembayaran menggunakan Nomor Virtual');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pendaftaran;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\registeredMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    public function __construct()
    {
        $client_id = 2108;
    }

    public function pendaftaran(){
        $jenisTOEFL = Product::get();
        if(Auth::user()->profile == null){
            return redirect()->route('user.dashboard');
        }

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
        
        // $this->apiBniResponse();

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

    public function apiBniResponse($data){
        // $response = Http::withHeaders([
        //     'Authorization' => 'ec7f27469786d4d06bdda37ebb20e435',
        //     'Content-Type' => 'application/json'
        // ])
        // ->post('https://apibeta.bni-ecollection.com/', [
        //     date_default_timezone_set('Asia/Jakarta'),
        //     $datetime_expired=date('c', time() + 12 * 3600),
        //     $data_asli = array(
        //                 'client_id' => $this->client_id,
        //                 'trx_id' => mt_rand(), // fill with Billing ID
        //                 'trx_amount' => $total_bayar, 
        //                 'billing_type' => 'c',
        //                 'datetime_expired' => $datetime_expired,
        //                 'customer_name' => $customer_name,
        //                 'customer_email' => $mhs_ukt->email,
        //                 'customer_phone' => $mhs_ukt->handphone ,
        //                 'description' => $customer_name,
        //                 'type'=>'createBilling'
        //             )
        // ]);
    }
}

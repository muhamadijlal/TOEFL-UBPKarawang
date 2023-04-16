<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Pendaftaran;
use App\Models\Periode;
use App\Models\Product;
use App\Models\User;
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
        
        if(Auth::user()->profile->no_handphone == null || Auth::user()->profile->semester == null || Auth::user()->profile->program_studi == null){
            return redirect()->route('user.dashboard');
        }

        $jenisTOEFL = Product::get();
        $periode = Periode::where('status',1)->get();

        return view('layouts.user.pendaftaran.create', compact('jenisTOEFL','periode'));
    }

    public function invoice($pendaftaran_id){
        $data = Pendaftaran::with(['user','product'])->where('id', $pendaftaran_id)->first();
        return view('layouts.user.pendaftaran.invoice', compact('data'));
    }

    public function store(Request $request){

        $request->validate([
            'jenis' => ['required'],
            'periode' => ['required'],
        ]);

        if($this->checkIfRegistered($request)){
            return redirect()
                    ->route('user.dashboard')
                    ->withErrors('Periode sebelumnya masih aktif, tidak dapat mendaftar diperiode yang sama jika periode pendaftaran sebelumnya masih aktif');
        };
        

        $product = Product::where('id',$request->jenis)->first('harga');
        $subtotal = $product->harga;

        $this->sendMail();

        $pendaftaran_id = Pendaftaran::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request->jenis,
            'periode_id' => $request->periode,
            'virtual_account' => Str::random(10),
            'subtotal' => $subtotal,
            'status_pembayaran' => 0,
        ])->id;

        Invoice::create([
            'nomor_invoice' => date('dmY').Str::random(5),
            'user_id' => Auth::user()->id,
            'pendaftaran_id' => $pendaftaran_id,
        ]);

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

    protected function sendMail(){
        Mail::to('haidarijlal027@gmail.com')
            ->send(new registeredMail());
    }

    protected function checkIfRegistered($req){

        // Check history pendaftaran
        // Jika status periode masih aktif 
        // User tidak dapat mendaftar di gelombang/periode yang sama

        $collection = Pendaftaran::with(['user','periode'])
                    ->whereHas('user', function($query){
                        $query->whereHas('profile', function($query){
                            $query->where('nim', Auth::user()->profile->nim);
                        });
                    })->whereHas('periode', function($query) use ($req){
                        $query->where('status',1)
                            ->where('id', $req->periode);
                    })
                    ->get();

        if($collection->isNotEmpty()){
            return true;
        }else{
            return false;
        };
    }
}

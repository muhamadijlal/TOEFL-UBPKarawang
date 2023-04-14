<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Product;
use Illuminate\Http\Request;

class TEController extends Controller
{
    public function pelatihan(){
        return view('layouts.admin.english.pelatihan.index');
    }

    public function datatablePelatihan(){
        $product = Product::where('bahasa','inggris')
                            ->where('jenis','pelatihan')
                            ->first();

        $collection = Pendaftaran::with(['user'])
                                ->orderBy('id','DESC')
                                ->where('product_id', $product->id)
                                 ->get();

        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('nama', function($row){
                    return $row->user->nama;
                })
                ->addColumn('nim', function($row){
                    return $row->user->profile->nim;
                })
                ->addColumn('email', function($row){
                    return $row->user->email;
                })
                ->addColumn('status_pembayaran', function($row){
                    if($row->status_pembayaran == 1){
                        return '
                            <span class="badge badge-success">Lunas</span>
                        ';
                    }else{
                        return '
                            <span class="badge badge-secondary">Belum Lunas</span>
                        ';
                    }
                })
                ->addColumn('aksi', function($row){
                    return '
                        <button type="button" class="btn btn-block btn-info">Send Notif</button>
                    ';
                })
                ->rawColumns(['aksi','status_pembayaran'])
                ->make(true);
    }

    public function test(){
        return view('layouts.admin.english.test.index');
    }

    public function datatableTest(){
        $product = Product::where('bahasa','inggris')
                            ->where('jenis','test')
                            ->first();

        $collection = Pendaftaran::with(['user'])
                                ->orderBy('id','DESC')
                                ->where('product_id', $product->id)
                                 ->get();
        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('nama', function($row){
                    return $row->user->nama;
                })
                ->addColumn('nim', function($row){
                    return $row->user->profile->nim;
                })
                ->addColumn('email', function($row){
                    return $row->user->email;
                })
                ->addColumn('status_pembayaran', function($row){
                    if($row->status_pembayaran == 1){
                        return '
                            <span class="badge badge-success">Lunas</span>
                        ';
                    }else{
                        return '
                            <span class="badge badge-secondary">Belum Lunas</span>
                        ';
                    }
                })
                ->addColumn('aksi', function($row){
                    return '
                        <button type="button" class="btn btn-block btn-info">Send Notif</button>
                    ';
                })
                ->rawColumns(['aksi','status_pembayaran'])
                ->make(true);
    }
    public function pelatihan_test(){
        return view('layouts.admin.english.pelatihan_test.index');
    }

    public function datatablePelatihanTest(){
        $product = Product::where('bahasa','inggris')
                          ->where('jenis','pelatihan dan test')
                          ->first();

        $collection = Pendaftaran::with(['user'])
                                 ->orderBy('id','DESC')
                                 ->where('product_id', $product->id)
                                 ->get();

        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('nama', function($row){
                    return $row->user->nama;
                })
                ->addColumn('nim', function($row){
                    return $row->user->profile->nim;
                })
                ->addColumn('email', function($row){
                    return $row->user->email;
                })
                ->addColumn('status_pembayaran', function($row){
                    if($row->status_pembayaran == 1){
                        return '
                            <span class="badge badge-success">Lunas</span>
                        ';
                    }else{
                        return '
                            <span class="badge badge-secondary">Belum Lunas</span>
                        ';
                    }
                })
                ->addColumn('aksi', function($row){
                    return '
                        <button type="button" class="btn btn-block btn-info">Send Notif</button>
                    ';
                })
                ->rawColumns(['aksi','status_pembayaran'])
                ->make(true);
    }
}

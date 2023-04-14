<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Pendaftaran;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboardAdmin(){

        $total_inggris = Pendaftaran::get();
        $total_jepang = Pendaftaran::get();
        return view('layouts.admin.dashboard', compact('total_inggris','total_jepang'));
    }

    public function dashboardUser(){
        return view('layouts.user.dashboard');
    }

    public function datatableUser()
    {
        $collection = Pendaftaran::with(['user','product'])->where('user_id', Auth::user()->id)->orderBy('id','DESC')->get();
        return datatables()
            ->of($collection)
            ->addColumn('nama', function($row){
                return $row->user->nama;
            })
            ->addColumn('nim', function($row){
                return $row->user->profile->nim;
            })
            ->addColumn('periode', function($row){
                return $row->periode->nama_periode;
            })
            ->addColumn('semester', function($row){
                return ucwords($row->user->profile->semester);
            })
            ->addColumn('email', function($row){
                return $row->user->email;
            })
            ->addColumn('bahasa', function($row){
                return ucwords($row->product->bahasa);
            })
            ->addColumn('jenis', function($row){
                return ucwords($row->product->jenis);
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
            ->addColumn('invoice', function($row){
                return "
                    <a href='/toefl/invoice/".$row->id."' class='btn-sm btn btn-outline-info'>
                        <i class='fas fa-copy'></i>
                    </a>
                ";
            })
            ->rawColumns(['invoice','status_pembayaran'])
            ->make(true);
    }
}

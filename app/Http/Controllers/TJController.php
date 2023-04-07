<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class TJController extends Controller
{
    public function pelatihan(){
        return view('layouts.admin.japan.pelatihan.index');
    }

    public function datatablePelatihan(){
        $collection = Pendaftaran::with(['user'])
                                    ->where('bahasa','jepang')
                                    ->where('jenis','pelatihan')
                                    ->orderBy('id','DESC')
                                    ->get();
        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('nama', function($row){
                    return $row->user->name;
                })
                ->addColumn('nim', function($row){
                    return $row->user->nim;
                })
                ->addColumn('email', function($row){
                    return $row->user->email;
                })
                ->addColumn('aksi', function($row){
                    return '';
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function test(){
        return view('layouts.admin.japan.test.index');
    }

    public function datatableTest(){
        $collection = Pendaftaran::with(['user'])
                                    ->where('bahasa','jepang')
                                    ->where('jenis','test')
                                    ->orderBy('id','DESC')
                                    ->get();
        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('nama', function($row){
                    return $row->user->name;
                })
                ->addColumn('nim', function($row){
                    return $row->user->nim;
                })
                ->addColumn('email', function($row){
                    return $row->user->email;
                })
                ->addColumn('aksi', function($row){
                    return '';
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function pelatihan_test(){
        return view('layouts.admin.japan.pelatihan_test.index');
    }

    public function datatablePelatihanTest(){
        $collection = Pendaftaran::with(['user'])
                                    ->where('bahasa','jepang')
                                    ->where('jenis','pelatihan dan test')
                                    ->orderBy('id','DESC')
                                    ->get();
        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('nama', function($row){
                    return $row->user->name;
                })
                ->addColumn('nim', function($row){
                    return $row->user->nim;
                })
                ->addColumn('email', function($row){
                    return $row->user->email;
                })
                ->addColumn('aksi', function($row){
                    return '';
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }
}

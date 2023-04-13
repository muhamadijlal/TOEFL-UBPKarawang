<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index()
    {
        return view('layouts.admin.periode.index');
    }

    public function datatable()
    {
        $collection = Periode::get();

        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('start_periode', function($row){
                    return date('d M Y', strtotime($row->start_periode));
                })
                ->addColumn('end_periode', function($row){
                    return date('d M Y', strtotime($row->end_periode));
                })
                ->addColumn('status', function($row){
                    if($row->status == 1){
                        return '
                            <span class="badge badge-success">Aktif</span>
                        ';
                    }else{
                        return '
                            <span class="badge badge-secondary">Tidak aktif</span>
                        ';
                    }
                })
                ->addColumn('aksi', function($row){
                    return '
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                    ';
                })
                ->rawColumns(['aksi','status'])
                ->make(true);
    }

    public function store(Request $request){
        $request->validate([
            'nama_periode' => ['required'],
            'rangeDate' => ['required']
        ]);

        // explode date range to each date
        $dates = explode(" - ",$request->rangeDate);
        // Store date to each variable
        $dateFrom = date('Y-m-d', strtotime($dates[0]));
        $dateTo = date('Y-m-d', strtotime($dates[1]));

        Periode::create([
            'nama_periode' => $request->nama_periode,
            'start_periode' => $dateFrom,
            'end_periode' => $dateTo,
            'status' => 1,
        ]);

        return response()->json(['status_code' => 200, 'status_message' => 'success', 'message' => 'Periode berhasil ditambahkan']);
    }
}

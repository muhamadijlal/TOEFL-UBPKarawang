<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    public function index()
    {
        $products = Product::get();

        foreach($products as $product){
            $bahasa[] = $product->bahasa;
            $jenis[] = $product->jenis;
        }

        return view('layouts.admin.periode.index', compact('bahasa','jenis'));
    }

    public function datatable()
    {
        $collection = Periode::with(['product'])->get();

        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('bahasa', function($row){
                    return ucwords($row->product->bahasa);
                })
                ->addColumn('jenis', function($row){
                    return ucwords($row->product->jenis);
                })
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
                    <button onclick="confirmDelete('.$row->id.')" type="submit" class="btn btn-danger btn-sm">
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
            'rangeDate' => ['required'],
            'bahasa' => ['required'],
            'jenis' => ['required']
        ]);

        // explode date range to each date
        $dates = explode(" - ",$request->rangeDate);
        // Store date to each variable
        $dateFrom = date('Y-m-d', strtotime($dates[0]));
        $dateTo = date('Y-m-d', strtotime($dates[1]));

        // Expire date is + 1 day dateTo
        $expireDate = date('Y-m-d', strtotime('+ 1 day', strtotime($dateTo)));

        
        $product = Product::where('bahasa', $request->bahasa)
                            ->where('jenis', $request->jenis)
                            ->first();

        Periode::create([
            'nama_periode' => $request->nama_periode,
            'start_periode' => $dateFrom,
            'product_id' => $product->id,
            'end_periode' => $dateTo,
            'expired_periode' => $expireDate,
            'status' => 1,
        ]);

        return response()->json(['status_code' => 200, 'status_message' => 'success', 'message' => 'Periode berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        Periode::findOrFail($id)->delete();
     
        return response()->json(['status_code' => 200, 'status_message' => 'success', 'message' => 'Periode berhasil dihapus']);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return view('layouts.admin.product.index');
    }

    public function datatable()
    {
        $collection = Product::get();

        return datatables()
                ->of($collection)
                ->addIndexColumn()
                ->addColumn('aksi', function($row){
                    return '
                    <button onclick="confirmDelete('.$row->id.')" type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                    ';
                })
                ->rawColumns(['aksi'])
                ->make(true);
    }

    public function store(Request $request){
        $request->validate([
            'bahasa' => ['required'],
            'jenis' => ['required'],
            'harga' => ['required']
        ]);

        // Change format harga, remove vharacter "."
        $harga = str_replace('.','', $request->harga);

        Product::create([
            'bahasa' => $request->bahasa,
            'jenis' => $request->jenis,
            'harga' => $harga
        ]);

        return response()->json(['status_code' => 200, 'status_message' => 'success', 'message' => 'Product berhasil ditambahkan']);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
     
        return response()->json(['status_code' => 200, 'status_message' => 'success', 'message' => 'Product berhasil dihapus']);
    }
}

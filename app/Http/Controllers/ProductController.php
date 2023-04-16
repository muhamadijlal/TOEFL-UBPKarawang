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
                ->addColumn('harga', function($row){
                    return 'Rp. '.number_format($row->harga,0,',','.').',-';
                })
                ->addColumn('aksi', function($row){
                    return '
                    <button onclick="confirmDelete('.$row->id.')" type="submit" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                    <a href="/admin/product/edit/'.$row->id.'" class="btn btn-warning btn-sm">
                        <i class="fas fa-pen"></i>
                    </a>
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

    public function edit($id)
    {
        $item = Product::findOrFail($id);

        return view('layouts.admin.product.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bahasa' => ['required'],
            'jenis' => ['required'],
            'harga' => ['required']
        ]);

        // Change format harga, remove vharacter "."
        $harga = str_replace('.','', $request->harga);

        Product::where('id',$id)->update([
            'bahasa' => $request->bahasa,
            'jenis' => $request->jenis,
            'harga' => $harga
        ]);

        return response()->json(['status_code' => 200, 'status_message' => 'success', 'message' => 'Product berhasil diupdate']);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
     
        return response()->json(['status_code' => 200, 'status_message' => 'success', 'message' => 'Product berhasil dihapus']);
    }
}

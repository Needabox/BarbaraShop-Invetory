<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $title = 'Master Data Produk';
        $products = Product::simplePaginate(10);
        $supplier = Supplier::all();
        $kode = mt_rand(10000, 99999);
        return view('kasir.produk.index', compact('products', 'title', 'supplier', 'kode'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $validated = $request->validate([
            'id_supplier'   => 'required',
            'nama'          => 'required',
            'kode'          => 'required|unique:products',
            'minimal_stock' => 'required',
            'buy'           => 'required',
            'harga'         => 'required',
        ]);

        $products = Product::create([
            'id_supplier' => $request->id_supplier,
            'nama' => $request->nama,
            'kode' => $request->kode,
            'stock' => 0,
            'minimal_stock' => $request->minimal_stock,
            'buy' => $request->buy,
            'harga' => $request->harga,
        ]);

        return redirect()
                ->route('products')
                ->with('message', 'Produk '. $request['nama'].' dengan atas nama '.$products->supplier->nama. ' Berhasil Ditambahkan');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $supplier = Supplier::all();
        return view('kasir.produk.edit', compact('product', 'supplier'));
    }

    public function update(Request $request, $id)
    {
        $products = Product::find($id);
        DB::table('products')->where('id' , $products->id)->update([
            'id_supplier' => $request->id_supplier,
            'nama' => $request->nama,
            'stock' => $request->stock,
            'minimal_stock' => $request->minimal_stock,
            'buy' => $request->buy,
            'harga' => $request->harga,
        ]);
        
        $product = Product::all();
        $product = $request->id_supplier;

        return redirect()
                ->route('products')
                ->with('message', 'Product '.$request['nama']. ' Berhasil Diupdae');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()
                ->route('products')
                ->with('message','Product '.$product['nama']. ' Berhasil Dihapus!');
    }
}

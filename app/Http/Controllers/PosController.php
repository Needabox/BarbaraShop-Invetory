<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Product;
use App\Models\Sales_line;
use Illuminate\Http\Request;

class PosController extends Controller
{
    public function index()
    {
        $title = 'Penjualan Barang';

        return view('kasir.penjualan.index', compact('title'));
    }

    public function get_product($kode)
    {
        $product = Product::where('kode', $kode)->first();
        
        return response()->json([
            'data' => $product,
        ]);
    }

    public function store(Request $request)
    {
        //dd($request);
        $product = $request->product;
        $qty = $request->qty;
        $harga = $request->harga;
        $jumlah_bayar = $request->jumlah_bayar;

        $total_qty = array_sum($qty);
        $total_harga = array_sum($harga);
        $total_bayar = $total_qty * $total_harga;

        if ($jumlah_bayar < $total_harga) {
            $kurangnya = $total_harga - $jumlah_bayar;
            return redirect()
                    ->back()
                    ->with('error', 'Jumlah Yang Anda Masukan Kurang Dari Total Harga. Uang Kurang Rp.'. number_format($kurangnya));
        }

        $sales = Sales::insertGetId([
            'no_struk' => 'S-'.mt_rand(10000, 99999),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);


        foreach ($product as $e => $pd) {
            Sales_line::insert([
                'sales' => $sales,
                'product' => $pd,
                'harga' => $harga[$e],
                'qty' => $qty[$e],
                'grand_total' => (Int)$qty[$e] * (Int)$harga[$e],
            ]);

            $data_product = Product::find($pd);
            $qty_now = $data_product->stock;
            $qty_new = $qty_now - $qty[$e];

            Product::where('id', $pd)->update([
                'stock' => $qty_new,
            ]);
        }

        $sum_total = Sales_line::where('sales', $sales)->sum('grand_total');

        $kembalian = $jumlah_bayar - $sum_total;
        sales::where('id', $sales)->update([
            'grand_total' => $sum_total,
            'jumlah_bayar' => $jumlah_bayar,
            'kembalian' => $kembalian,
        ]);

        return redirect()
                ->back()
                ->with('message', 'Transaksi Berhasil Dilakukan. Kembalian '. number_format($kembalian));
    }
}

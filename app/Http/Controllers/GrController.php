<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Goods_receipt;

class GrController extends Controller
{
    public function index()
    {
        $good_receipt = Goods_receipt::orderBy('created_at', 'desc')->get();
        $title = 'Master Good Receipt List';

        return view('kasir.goodreceipt.index', compact('good_receipt', 'title'));
    }

    public function details($id)
    {
        $good_receipt = Goods_receipt::find($id);

        return view('kasir.goodreceipt.details', compact('good_receipt'));
    }

    public function approve($id)
    {
        $good_receipt = Goods_receipt::find($id);

        if ($good_receipt->status == 2) {
            return redirect()->back()->with('error', 'Maaf Dokumen Ini Sudah Pernah DI Approve');
        }
        Goods_receipt::where('id', $id)->update([
            'status' => 2,
        ]);

        foreach ($good_receipt->purchase_orders->lines as $grl) {
            $qty = $grl->qty;
            $prouct = $grl->product;

            $pd = Product::find($prouct);
            $stock_sekarang = $pd->stock;
            $stock_baru = $stock_sekarang + $qty;

            Product::where('id', $prouct)->update([
                'stock' => $stock_baru,
            ]);
        }

        return redirect()
                ->back()
                ->with('message', 'Dokumen Berhasil Di Approve');
    }
}

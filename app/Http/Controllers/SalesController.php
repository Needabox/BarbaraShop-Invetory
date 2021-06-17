<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        $title = 'Master Histori Penjualan';
        $sales = Sales::withCount('lines')->orderBy('created_at', 'desc')->paginate(5);

        $awal = date('Y-m-d', strtotime('-1 days'));
        $akhir = date('Y-m-d');

        return view('kasir.sales.index', compact('title', 'sales', 'awal', 'akhir'));
    }

    public function filter(Request $request)
    {
        //dd($request);
        $awal = date('Y-m-d', strtotime($request->awal));
        $akhir = date('Y-m-d', strtotime($request->akhir));

        $title = 'Histori Transaksi Penjualan';
        $sales = Sales::whereDate('created_at', '>=', $awal)->whereDate('created_at', '<=', $akhir)->orderBy('created_at', 'desc')->paginate(5);

        return view('kasir.sales.index', compact('title', 'sales', 'awal', 'akhir'));
    }

    public function details($id)
    {
        $sales = Sales::find($id);
        $title = 'Details Penjualan '.$sales->no_struk;
        $title2 = 'Details Product Penjualan '.$sales->no_struk;

        return view('kasir.sales.details', compact('sales','title', 'title2'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Models\Purchase_order;

class DashboardController extends Controller
{
    public function index(){
        
        $total_pendapatan = Sales::whereDate('created_at', date('Y-m-d'))->sum('grand_total');

        $total_suppliers = Supplier::count();
        $suppliers = Supplier::orderBy('created_at', 'desc')->first();
        
        $total_po = Purchase_order::count();
        $po = Purchase_order::orderBy('created_at', 'desc')->first();

        $total_products = Product::count();
        $product = Product::orderBy('created_at', 'desc')->first();

        $purchase_order = Purchase_order::orderBy('created_at', 'desc')->withCount('lines')->paginate(5);

        return view('kasir.dashboard.index', compact('total_pendapatan', 'total_suppliers','suppliers', 'total_products', 'total_po', 'po', 'product', 'purchase_order'));
    }
}

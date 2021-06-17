<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Supplier;
use PDF;
use Illuminate\Http\Request;
use App\Models\Goods_receipt;
use App\Models\Purchase_order;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase_order_line;

class PoController extends Controller
{
    public function index()
    {
        $purchase_order = Purchase_order::withCount('lines')->orderBy('created_at', 'desc')->get();
        $title = 'Master Data Purchase Order';
        $nodoc = 'PO-'.mt_rand(100000, 999999);
        $supplier = Supplier::all();

        return view('kasir.purchaseorder.index', compact('purchase_order', 'title', 'nodoc', 'supplier'));
    }
    
    public function getproduct($id_supplier)
    {
        $purchase_order = Purchase_order::all();
        $title = 'Daftar Product Supplier';
        $nodoc = 'PO-'.mt_rand(100000, 999999);
        $supplier = Supplier::all();
        $product = Product::where('id_supplier', $id_supplier)->get();

        return view('kasir.purchaseorder.tambah-po', compact('purchase_order', 'title', 'nodoc', 'supplier', 'product','id_supplier'));
    }
    
    public function create()
    {
        $purchase_order = Purchase_order::all();
        $title = 'Master Data Purchase Order';
        $nodoc = 'PO-'.mt_rand(100000, 999999);
        $supplier = Supplier::all();

        return view('kasir.purchaseorder.tambah-po', compact('purchase_order', 'title', 'nodoc', 'supplier'));
    }

    public function store(Request $request)
    {
        //dd($request);
        // try{
            $product = $request->product;
            $qty = $request->qty;

            $no_document = $request->no_document;
            $supplier = $request->supplier;

            $id_po = Purchase_order::insertGetId([
                'no_document' => $no_document,
                'supplier' => $supplier,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);

            // $id_po = Purchase_order::create([
            //     'no_document' => $no_document,
            //     'supplier' => $supplier,
            //     'created_at' => Carbon::now()->isoFormat('Y-m-d H:m:s'),
            //     'updated_at' => Carbon::now()->isoFormat('Y-m-d H:m:s'),
            // ]);

            foreach ($qty as $e=>$q) {
                if ($q == 0) {
                    continue;
                }

                $dt_product = Product::where('id', $product[$e])->first();
                $buy = $dt_product->buy;
                $grand_total = $q * $buy;

                Purchase_order_line::insert([
                    'purchase_order' => $id_po,
                    'product' => $product[$e],
                    'qty' => $q,
                    'buy' => $buy,
                    'grand_total' => $grand_total,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

        //     \Session::flash('message', 'PO Berhasil Dibuat!');
        // } catch (\Exception $e) {
        //     \Session::flash('gagal', $e->getMessage());
        // }

        return redirect()
                ->route('po')
                ->with('message', 'PO Berhasil Dibuat');
    }

    public function approve($id)
    {
        Purchase_order::where('id', $id)->update([
            'status' => 2,
        ]);
        
        Goods_receipt::where('purchase_order', $id)->delete();

        Goods_receipt::create([
            'purchase_order' => $id,
            'no_document' => 'GR-'.mt_rand(10000,99999),
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
                ->route('po')
                ->with('message', 'PO Berhasil Di Approve!');
    }

    public function details($id)
    {
        $purchase_order = Purchase_order::find($id);

        return view('kasir.purchaseorder.details', compact('purchase_order'));
    }

    public function updateQty(Request $request, $id)
    {
        //dd($request);
        $qty = $request->qty;
        $id_line = $request->id_line;
        $buy = $request->buy;
        $product = $request->product;

        foreach ($qty as $e => $dt) {
            $data['qty'] = $dt;
            $data['grand_total'] = $dt * $buy[$e];
            $data['buy'] = $buy[$e];

            $line = $id_line[$e];

            Purchase_order_line::where('id', $line)->update($data);

            Product::where('id', $product[$e])->update([
                'buy' => $data['buy'],
            ]);
        }

        return redirect()
                ->back()
                ->with('message', 'Qty Product Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $purchase_order = Purchase_order_line::find($id);

        $purchase_order->delete();

        return redirect()
                ->back()
                ->with('message', 'Qty Product Berhasil Dihapus!');
    }

    public function cetak($id)
    {   
        $purchase_order = Purchase_order::find($id);
        $title = 'Details '.$purchase_order->no_document;

        $pdf = PDF::loadview('kasir.purchaseorder.cetak', compact('purchase_order', 'title'))->setPaper('A4','potrait');
        return $pdf->stream();
    }
}

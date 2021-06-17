<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Master Data Supplier';
        $supplier = Supplier::orderby('nama', 'asc')->get();

        return view('kasir.supplier.index', compact('title', 'supplier'));
    }   

    public function store(Request $request)
    {
        $supplier = Supplier::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
        ]);

        return redirect()
                ->route('supplier')
                ->with('message', 'Supplier Atas Nama '.$supplier['nama'].' Berhasil Ditambah!');
    }

    public function edit($id)
    {
        $supplier = Supplier::find($id);
        return view('kasir.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::find($id);

        DB::table('suppliers')->where('id', $supplier->id)->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
        ]);

        return redirect()
            ->route('supplier')
            ->with('message', 'Supplier Atas Nama '.$request['nama'].' Berhasil Diubah!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        return redirect()
                ->route('supplier')
                ->with('message', 'Supplier Atas Nama '.$supplier['nama'].' Berhasil Dihapus!');
    }

    // public function search(Request $request)
    // {
    //     if ($request->ajax()) 
    //     {
    //         $output = "";
    //         $supplier = DB::table('suppliers')->where('nama','LIKE','%'.$request->search."%")->get();

    //         if ($supplier) {
    //             foreach($supplier as $key => $s){
    //                 $output .= '<tr>'.
    //                 '<td>'.$s->id.'</td>'.
    //                 '<td>'.$s->nama.'</td>'.
    //                 '<td>'.$s->alamat.'</td>'.
    //                 '<td>'.$s->no_tlp.'</td>'.
    //                 '</tr>';
    //             }

    //             return Response($output);
    //         }
    //     }
    // }
}

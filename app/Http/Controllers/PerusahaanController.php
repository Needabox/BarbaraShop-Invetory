<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        $title = 'Update Data Perusahaan';
        $perusahaan = Perusahaan::first();

        return view('kasir.perusahaan.index', compact('title', 'perusahaan'));
    }

    public function update(Request $request)
    {
        $perusahaan = Perusahaan::first();
        
        $update = $request->except(['_token', '_method']);
        $update['updated_at'] = date('Y-m-d H:i:s');

        Perusahaan::where('id', $perusahaan->id)->update($update);

        return redirect()
                ->back()
                ->with('message', 'Data Perusahaan Berhasil Di-Update');
    }
}

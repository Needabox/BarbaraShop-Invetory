@extends('layouts.master2')
@section('title')
    Supplier - Barbara Shop
@endsection
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Produk</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                    Tambah Produk
                </button>
            </li>
        </ol>
    </div>
</div>

        @if (session()->has('message'))
            <div class="container alert alert-success">
                <strong style="color: rgb(255, 255, 255)">{{ session()->get('message') }}</strong>
                <button class="close" type="button" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif


<div class="col-lg-12 mb-4 mt-3">
    @if ($errors->any())
                <div class="alert alert-danger">
                    <button class="close text-white" type="button" data-dismiss="alert">
                        <span>&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
        @endif
    <!-- Simple Tables -->
    <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        </div>
        <div div class="table-responsive">
            <table class="table align-items-center table-flush myTable">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Supplier</th>
                    <th>Nama Produk</th>
                    <th>Kode Produk</th>
                    <th>Stock</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->supplier->nama }}</td>
                    <td>{{ $product->nama }}</td>
                    <td>{{ $product->kode }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>Rp. {{ number_format($product->buy) }}</td>
                    <td>Rp. {{ number_format($product->harga) }}</td>
                    <td>
                        <!-- Button Details Product modal -->
                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#detailsProduct-{{ $product->id }}" data-id="{{ $product->id }}">
                            <i class="fa fa-eye" aria-hidden="true"></i>                   
                        </button>

                        {{-- Link For Edits And Delete --}}
                        <a href="{{ route('product.edit', ['id' => $product->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a>
                    </td>
                    @empty
                        <h2 class="text-center">Data Tidak Ditemukan</h2>
                    @endforelse
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        {{ $products->links() }}
    </div>
</div>
</div>

<!-- Tambah Produk Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('product.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="id_supplier">Supplier</label>
                        <select name="id_supplier" id="id_supplier" class="form-control">
                            <option value="#">=== Pilih Supplier ===</option>
                            @foreach ($supplier as $s)
                                <option value="{{ $s->id }}">{{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Produk</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Produk"  autofocus>
                    </div>
                    <div class="form-group">
                        <label for="kode">Kode Produk</label>
                        <input type="text" name="kode" id="kode" class="form-control" value="{{ $kode }}" readonly>
                    </div>
                    <div class="form-group">
                        <label for="minimal_stock">Minimal Stock Produk</label>
                        <input type="text" name="minimal_stock" id="minimal_stock" class="form-control" placeholder="Masukan Minimal Stock" >
                    </div>
                    <div class="form-group">
                        <label for="buy">Harga Beli Product</label>
                        <input type="number" name="buy" id="buy" class="form-control" placeholder="Masukan harga Beli Produk" >
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga Jual Product</label>
                        <input type="number" name="harga" id="harga" class="form-control" placeholder="Masukan harga Jual Produk" >
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Details Product Modal -->
@foreach ($products as $product)
<div class="modal fade" id="detailsProduct-{{ $product->id }}" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Details Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                {{-- <img class="mx-auto d-block" src="data:image/png;base64,{{DNS1D::getBarcodePNG('134', 'C39')}}" alt="barcode" width="300"/> --}}
                <div class="text-center">
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('products.details', $product->id) }}">
                                    <p class="text-center">Scan Barcode dibawah untuk mendapatkan kode product</p>
                                    <div align="center" >
                                        {!! DNS1D::getBarcodeHTML($product->kode, 'C39',2,33); !!}
                                        <br>
                                        <table class="table-responsive">
                                            <td>
                                                <tr>Nama Product</tr>
                                                <tr> : </tr>
                                                <tr>{{ $product->nama }}</tr>
                                            </td>
                                            <br>
                                            <td>
                                                <tr>Harga</tr>
                                                <tr> : </tr>
                                                <tr>Rp. {{ number_format($product->harga) }}</tr>
                                            </td>
                                            <br>
                                            <td>
                                                <tr>Minimal Product</tr>
                                                <tr> : </tr>
                                                <tr>{{ $product->minimal_stock }}</tr>
                                            </td>
                                        </table>
                                    </div>
                                </form> 
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control">
                </div> --}}
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
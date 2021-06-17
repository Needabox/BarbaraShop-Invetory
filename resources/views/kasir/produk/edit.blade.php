@extends('layouts.master2')
@section('title')
    Produk Edit - Barbara Shop
@endsection
@section('content')

        @if (session()->has('message'))
            <div class="container alert alert-success">
                <strong style="color: rgb(255, 255, 255)">{{ session()->get('message') }}</strong>
                <button class="close" type="button" data-dismiss="alert">
                    <span>&times;</span>
                </button>
            </div>
        @endif

<div class="col-lg-12 mb-4 mt-3">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><a class="text-primary" href="{{ route('products') }}"><i class="fa fa-chevron-left" aria-hidden="true"></i> Edit Produk</a></h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('product.update', ['id' => $product->id]) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="kode">Kode Produk</label>
                    <input name="kode" type="text" class="form-control" id="kode" value="{{ $product->kode}}" disabled>
                </div>
                <div class="form-group">
                    <label for="id_supplier">Supplier</label>
                    <select name="id_supplier" id="id_supplier" class="form-control">
                        @foreach ($supplier as $s)
                            <option value="{{ $s->id }}" {{ ($product->id_supplier == $s->id) ? 'selected' : '' }}>{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input name="nama" type="text" class="form-control" id="nama" value="{{ $product->nama }}">
                </div>
                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input name="stock" type="text" class="form-control" id="stock" value="{{ $product->stock }}" readonly>
                </div>
                <div class="form-group">
                    <label for="minimal_stock">Minimal Stock</label>
                    <input name="minimal_stock" type="text" class="form-control" id="minimal_stock" value="{{ $product->minimal_stock }}">
                </div>
                <div class="form-group">
                    <label for="buy">Harga Beli Product</label>
                    <input name="buy" type="text" class="form-control" id="buy" value="{{ $product->buy }}">
                </div>
                <div class="form-group">
                    <label for="harga">Harga Jual Product</label>
                    <input name="harga" type="text" class="form-control" id="harga" value="{{ $product->harga }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#hapus">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="hapus" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white">Hapus Data Supplier</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus <strong>{{ $product->nama }} </strong> Dengan Supplier Atas Nama <strong>{{ $product->supplier->nama }}</strong>?
            </div>
            <div class="modal-footer">
                <a href="{{ route('product.delete', ['id' => $product->id]) }}" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endsection

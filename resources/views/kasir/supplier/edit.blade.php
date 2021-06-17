@extends('layouts.master2')
@section('title')
    Supplier Edit - Barbara Shop
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
            <h6 class="m-0 font-weight-bold text-primary">Edit Supplier</h6>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('supplier.update', ['id' => $supplier->id]) }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nama">Nama Supplier</label>
                    <input name="nama" type="text" class="form-control" id="nama" value="{{ $supplier->nama }}">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat Supplier</label>
                    <textarea name="alamat" type="text" class="form-control" id="alamat"">{{ $supplier->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label for="no_tlp">No Telephone Supplier</label>
                    <input name="no_tlp" type="text" class="form-control" id="no_tlp" value="{{ $supplier->no_tlp }}">
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
                Apakah anda yakin ingin menghapus <strong>{{ $supplier->nama }}</strong>?
            </div>
            <div class="modal-footer">
                <a href="{{ route('supplier.delete', ['id' => $supplier->id]) }}" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>
@endsection

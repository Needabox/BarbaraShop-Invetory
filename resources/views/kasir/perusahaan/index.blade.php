@extends('layouts.master2')
@section('title')
    Update Perusahaan - Barbara Shop
@endsection
@section('content')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>
</div>
        @if (session()->has('message'))
            <div class="container alert alert-success">
                <strong style="color: rgb(255, 255, 255)">{{ session()->get('message') }}</strong>
                <button class="close" type="button" data-dismiss="alert">
                    <span class="text-white">&times;</span>
                </button>
            </div>
        @endif

<div class="col-lg-12 mb-4 mt-3">
    <div class="card mb-4">
        <div class="card-body">
            <form method="POST" action="{{ route('update.perusahaan') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nama">Nama Perusahaan</label>
                    <input name="nama" type="text" class="form-control" id="nama" value="{{ $perusahaan->nama}}">
                </div>
                <div class="form-group">
                    <label for="no_tlp">Nomor Telephone</label>
                    <input name="no_tlp" type="text" class="form-control" id="no_tlp" value="{{ $perusahaan->no_tlp }}">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" cols="30" rows="2" class="form-control">{{ $perusahaan->alamat }}</textarea>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input name="email" type="text" class="form-control" id="email" value="{{ $perusahaan->email }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>

@endsection

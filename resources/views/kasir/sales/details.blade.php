@extends('layouts.master2')
@section('title')
    Details Penjualan - Barbara Shop
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
    <a href="{{ route('sales') }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</a>
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table align-items-center table-flush">
                        <tr>
                            <th>No Struk</th>
                            <th> : </th>
                            <th>{{ $sales->no_struk }}</th>

                            <th>Jumlah Bayar</th>
                            <th> : </th>
                            <th>Rp. {{ number_format($sales->jumlah_bayar) }}</th>
                        </tr>
                        <tr>
                            <th>Kembalian</th>
                            <th> : </th>
                            <th>Rp. {{ number_format($sales->kembalian) }}</th>

                            <th>Grand Total</th>
                            <th> : </th>
                            <th>Rp. {{ number_format($sales->grand_total) }}</th>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12 mb-4 mt-3">
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title2 }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table align-items-center table-flush">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales->lines as $sl)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sl->products->nama }}</td>
                                    <td>Rp. {{ number_format($sl->harga) }}</td>
                                    <td>{{ $sl->qty }}</td>
                                    <td>Rp. {{ number_format($sl->grand_total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
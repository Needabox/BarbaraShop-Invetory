@extends('layouts.master2')
@section('title')
    Details Purchase Order - Barbara Shop
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
    <a href="{{ route('po') }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</a>
    <a href="{{ route('po.cetak', ['id' => $purchase_order->id]) }}" class="btn btn-success btn-sm mb-3"><i class="fas fa-print"></i> Print</a>
    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Details Purchase Order</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <table class="table align-items-center table-flush">
                        <tr>
                            <th>No Document</th>
                            <th> : </th>
                            <th>{{ $purchase_order->no_document }}</th>
                            <th>Supplier</th>
                            <th> : </th>
                            <th>{{ $purchase_order->suppliers->nama }}</th>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th> : </th>
                            <th>
                                @if ($purchase_order->status == 1)
                                    <span class="badge badge-warning text-white">Pending</span>
                                @elseif($purchase_order->status == 2)
                                    <span class="badge badge-success text-white">Completed</span>
                                @else
                                    <span class="badge badge-danger text-white">NULL</span>
                                @endif
                            </th>
                            <th>Tanggal</th>
                            <th> : </th>
                            <th>{{ \Carbon\Carbon::parse($purchase_order->created_at)->isoFormat('D MMMM Y') }}</th>
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
            <h6 class="m-0 font-weight-bold text-primary">Details Product Purchase Order</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('po.update.qty', ['id', $purchase_order->id]) }}" method="POST">
                        {{ csrf_field() }}
                        <table class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Harga Beli</th>
                                    <th>Total Harga</th>
                                    @if ($purchase_order->status != 2)
                                        <th>Action</th>  
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $total_qty = 0;
                                    $total_buy = 0;
                                    $total = 0;
                                ?>
                                @foreach ($purchase_order->lines as $pol)
                                <?php
                                    $total_qty += $pol->qty;
                                    $total_buy += $pol->buy;
                                    $total += $pol->grand_total;
                                ?>
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $pol->products->nama }}</th>
                                        <th>
                                            @if ( $purchase_order->status != 2)
                                                <input name="qty[]" type="number" class="form-control" value="{{ $pol->qty }}" placeholder="Qty">
                                                <input name="id_line[]" type="hidden" value="{{ $pol->id }}">
                                                <input name="product[]" type="hidden" value="{{ $pol->product }}"> 
                                            @else
                                                {{ $pol->qty }}
                                            @endif
                                        </th>
                                        <th>
                                            @if ($purchase_order->status != 2)
                                                <input name="buy[]" type="number" class="form-control" value="{{ $pol->buy }}" placeholder="Harga Beli">    
                                            @else
                                                Rp. {{ number_format($pol->buy) }}
                                            @endif
                                        </th>
                                        <th>Rp.{{ number_format($pol->grand_total) }}</th>
                                        <th>
                                            @if ($purchase_order->status != 2)
                                                <!-- Button Hapus Qty modal -->
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modelId">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @else
                                                
                                            @endif
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th>
                                        <b><i>Jumlah</i></b>
                                    </th>
                                    <th>
                                        <b><i>{{ $total_qty }}</i></b>
                                    </th>
                                    <th>
                                        <b><i>Rp. {{ number_format($total_buy) }}</i></b>
                                    </th>
                                    <th>
                                        <b><i>Rp.{{ number_format($total) }}</i></b>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            @if ($purchase_order->status != 2)
                <button class="btn btn-success" type="submit">Simpan</button>
            @endif
        </form>
    </div>
</div>

<!-- Modal Hapus Qty -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Hapus Qty</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus Qty Produk Ini?
            </div>
            <div class="modal-footer">
                <form action="{{ route('po.delete', ['id' => $purchase_order->id]) }}">
                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
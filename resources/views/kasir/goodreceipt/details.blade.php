@extends('layouts.master2')
@section('title')
    Details Goods Receipt - Barbara Shop
@endsection
@section('content')

<div class="col-lg-12 mb-4 mt-3">
    
    <a href="{{ route('gr') }}" class="btn btn-primary btn-sm mb-3"><i class="fa fa-arrow-alt-circle-left"></i> Kembali</a>

    @if ($good_receipt->status != 2)
        <!-- Button Approve modal -->
        <button type="button" class="btn btn-success btn-sm mb-3" data-toggle="modal" data-target="#approved">
            <i class="fa fa-check"></i> Approve
        </button>
    @endif

    @if (session()->has('message'))
        <div class="container alert alert-success">
            <strong style="color: rgb(255, 255, 255)">{{ session()->get('message') }}</strong>
            <button class="close" type="button" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="container alert alert-danger">
            <strong style="color: rgb(255, 255, 255)">{{ session()->get('error') }}</strong>
            <button class="close" type="button" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Details Good Receipt</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table align-items-center table-flush">
                        <tr>
                            <th>No Document GR</th>
                            <th> : </th>
                            <th>{{ $good_receipt->no_document }}</th>
                            <th>No Document PO</th>
                            <th> : </th>
                            <th>{{ $good_receipt->purchase_orders->no_document }}</th>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th> : </th>
                            <th>
                                @if ($good_receipt->status == 1)
                                    <span class="badge badge-warning text-white">Pending</span>
                                @elseif($good_receipt->status == 2)
                                    <span class="badge badge-success text-white">Completed</span>
                                @else
                                    <span class="badge badge-danger text-white">NULL</span>
                                @endif
                            </th>
                            <th>Tanggal</th>
                            <th> : </th>
                            <th>{{ \Carbon\Carbon::parse($good_receipt->created_at)->isoFormat('D MMMM Y') }}</th>
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
                    <form action="" method="POST">
                        {{ csrf_field() }}
                        <table class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Harga Beli</th>
                                    <th>Total Harga</th>
                            </thead>
                            <tbody>
                                <?php
                                    $total_qty = 0;
                                    $total_buy = 0;
                                    $total = 0;
                                ?>
                                @foreach ($good_receipt->purchase_orders->lines as $grl)
                                <?php
                                    $total_qty += $grl->qty;
                                    $total_buy += $grl->buy;
                                    $total += $grl->grand_total;
                                ?>
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <th>{{ $grl->products->nama }}</th>
                                        <th>
                                            @if ( $grl->status != 2)
                                                {{ $grl->qty }}
                                                <input name="id_line[]" type="hidden" value="{{ $grl->id }}">
                                                <input name="product[]" type="hidden" value="{{ $grl->product }}"> 
                                            @else
                                                {{ $grl->qty }}
                                            @endif
                                        </th>
                                        <th>
                                            Rp. {{ number_format($grl->buy) }}
                                        </th>
                                        <th>Rp.{{ number_format($grl->grand_total) }}</th>
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
                                        <b><i>Rp. {{ number_format($grl->sum_buy()) }}</i></b>
                                    </th>
                                    <th>
                                        <b><i>Rp.{{ number_format($grl->sum_grand_total()) }}</i></b>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

<!-- Approve Modal -->
<div class="modal fade" id="approved" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Approve Document</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
            </div>
            <div class="modal-body" style="color: black">
                Apakah anda yakin ingin Approve Dokumen ini?
            </div>
            <form action="{{ route('po.approve', ['id' => $good_receipt->id]) }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script>
        $(document).ready( function(){

        $('.approved').click(function(){
            
        })

        //Button refresh
        $('btn-refresh').click( function(e){
            e.preventDefault();
            $('.preloader').fadeIn();
            location.reload();
        })
    })
    </script>
@endsection
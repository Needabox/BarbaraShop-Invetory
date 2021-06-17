@extends('layouts.master2')
@section('title')
    Good Receipts List - Barbara Shop
@endsection
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Goods Receipt</h1>
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
                    <th>No. Document</th>
                    <th>Jumlah Product</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
                <tbody>
            </thead>
                @forelse ($good_receipt as $gr)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gr->no_document }}</td>
                        <td>{{ $gr->total_item() }}</td>
                        <td>Rp. {{ number_format($gr->purchase_orders->grand_total()) }}</td>
                        <td>
                            @if ($gr->status == 1)
                                <span class="badge badge-warning text-white">Pending</span>
                            @elseif($gr->status == 2)
                                <span class="badge badge-success text-white">Completed</span>
                            @else
                                <span class="badge badge-primarytext-white">NULL</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($gr->created_at)->isoFormat('D MMMM Y') }}</td>
                        <td>
                            <a href="{{ route('gr.details', ['id' => $gr->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
                @empty
                    <h2 class="text-center">Data Tidak Ditemukan</h2>
                @endforelse
            </table>
    </div>
    <div class="card-footer">
    </div>
</div>
</div>
@endsection

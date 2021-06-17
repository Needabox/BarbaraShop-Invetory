@extends('layouts.master2')
@section('title')
    Purchase Order - Barbara Shop
@endsection
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Purchase Order</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <!-- Button trigger modal -->
                <a href="{{ route('po.create') }}" class="btn btn-primary btn-sm">Tambah Purchase Order</a>
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
                    <th>Supplier</th>
                    <th>Jumlah Product</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
                <tbody>
            </thead>
                @forelse ($purchase_order as $po)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $po->no_document }}</td>
                        <td>{{ $po->suppliers->nama }}</td>
                        <td>{{ $po->lines_count }}</td>
                        <td>Rp.{{ number_format($po->grand_total()) }}</td>
                        <td>
                            @if ($po->status == 1)
                                <span class="badge badge-warning text-white">Pending</span>
                            @elseif($po->status == 2)
                                <span class="badge badge-success text-white">Completed</span>
                            @else
                                <span class="badge badge-primarytext-white">NULL</span>
                            @endif
                        </td>
                        <td>{{ \Carbon\Carbon::parse($po->created_at)->isoFormat('D MMMM Y') }}</td>
                        <td>
                            <!-- Button approve modal -->
                            {{-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#approve">
                                <i class="fa fa-check"></i>
                            </button> --}}
                            <a href="{{ route('po.approve', ['id' => $po->id]) }}" class="btn btn-sm btn-success" onclick="return confirm('Are you sure you want to approve?');"><i class="fas fa-check"></i></a>
                            <a href="{{ route('po.details', ['id' => $po->id]) }}" class="btn btn-sm btn-primary btn-sm"><i class="fas fa-info"></i></a>
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

<!-- Approve Modal -->
<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">Confirmation Approve</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                Are you sure want approve?
            </div>
            <div class="modal-footer">
                <form action="{{ route('po.approve', ['id' => $po->id]) }}" method="GET">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

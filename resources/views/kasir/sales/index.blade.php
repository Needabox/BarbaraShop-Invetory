@extends('layouts.master2')
@section('title')
    Histori Penjualan - Barbara Shop
@endsection
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        {{-- <button class="btn btn-sm btn-primary btn-filter">
            <i class="fas fa-sort"></i> Filter Tanggal
        </button> --}}
        <!-- Button Filter tanggal modal -->
        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#modal-filter">
            <i class="fas fa-sort"></i> Filter Tanggal
        </button>
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
                    <th>Nomor Struk</th>
                    <th>Jumlah Bayar</th>
                    <th>Kembalian</th>
                    <th>Grand Total</th>
                    <th>Total Item</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $e=>$s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->no_struk }}</td>
                        <td>Rp. {{ number_format($s->jumlah_bayar) }}</td>
                        <td>Rp. {{ number_format($s->kembalian) }}</td>
                        <td>Rp. {{ number_format($s->grand_total) }}</td>
                        <td>{{ $s->lines_count }}</td>
                        <td>{{ \Carbon\Carbon::parse($s->created_at)->isoFormat('D MMMM Y') }}</td>
                        <td>
                            <a href="{{ route('sales.details', ['id' => $s->id]) }}" class="btn btn-primary">
                                <i class="fa fa-info"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot border="1">
                <tr></tr>
                <tr></tr>
                <tr>
                    <th></th>
                    <th>
                        <b><i>Total :</i></b>
                    </th>
                    <th>
                        <b><i>Rp. {{ number_format($s->total_jumlah_bayar($awal,$akhir),0) }}</i></b>
                    </th>
                    <th>
                        <b><i>Rp. {{ number_format($s->total_kembalian($awal,$akhir),0) }}</i></b>
                    </th>
                    <th>
                        <b><i>Rp. {{ number_format($s->all_grand_total($awal,$akhir),0) }}</i></b>
                    </th>
                    <th></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer">
        {{ $sales->links() }}
    </div>
</div>
</div>
@endsection

<!-- Filter Tanggal Modal -->
<div class="modal fade" id="modal-filter" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title text-white">Filter Tanggal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('sales.filter') }}" method="GET">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="awal" style="color: black">Tanggal Awal</label>
                        <input type="date" name="awal" id="awal" class="form-control form-control-sm datepicker" autocomplete="off" value="{{ $awal }}">
                    </div>
                    <div class="form-group">
                        <label for="akhir" style="color: black">Tanggal Akhir</label>
                        <input type="date" name="akhir" id="akhir" class="form-control form-control-sm datepicker" autocomplete="off" value="{{ $akhir }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success text-white">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.btn-filter').click(function(e){
                e.preventDefault();
                $('#modal-filter').modal();
            })
        })
    </script>
@endsection

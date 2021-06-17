@extends('layouts.master2')
@section('title')
    Tambah Purchase Order - Barbara Shop
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
            <h6 class="m-0 font-weight-bold text-primary">Tambah Purchase Order</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('po.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="no_document">No Document</label>
                    <input type="text" name="no_document" id="no_document" class="form-control" value="{{ $nodoc }}" readonly>
                </div>
                @if(isset($id_supplier))
                    <div class="form-group">
                        <label for="">Pilih Supplier</label>
                        <select name="supplier" id="supplier" class="form-control select2">
                            <option value="">=== Pilih Supplier ===</option>
                            @foreach ($supplier as $s)
                                <option value="{{ $s->id }}" {{ ($id_supplier == $s->id) ? 'selected' : '' }}>{{ $s->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                @else
                <div class="form-group">
                    <label for="">Pilih Supplier</label>
                    <select name="supplier" id="supplier" class="form-control select2">
                        <option value="">=== Pilih Supplier ===</option>
                        @foreach ($supplier as $s)
                            <option value="{{ $s->id }}">{{ $s->nama }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-12 mb-4 mt-3">
        @if (isset($product))
        <!-- Simple Tables -->
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
                </div>
                    <div div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Product</th>
                                    <th>Harga Beli Product</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product as $e=>$p)
                                    <tr>
                                        <th>{{ $e+1 }}</th>
                                        <th>{{ $p->nama }}</th>
                                        <th>Rp.{{ number_format($p->buy) }}</th>
                                        <th>
                                            <input type="hidden" name="product[]" value="{{ $p->id }}">
                                            <input type="text" class="form-control form-control-sm" name="qty[]" value="0" size="30">
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                <div class="card-footer"></div>
            </div>
        @endif
        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
    </div>
</form>
@endsection

@section('scripts')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

        $("select[name='supplier']").change( function(e){
            var id_supplier = $(this).val();
            var url = "{{ url('purchase-order/product') }}"+'/'+id_supplier;

            window.location.href = url;
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

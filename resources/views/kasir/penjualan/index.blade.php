@extends('layouts.master2')
@section('title')
    Penjualan Barang - Barbara Shop
@endsection
@section('content')

<div class="col-lg-12 mb-4 mt-3">

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

    <input type="hidden" name="grand_total" value="0">

    <div class="card mb-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">{{ $title }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="">
                        <div class="form-group">
                            <label for="barcode">Scan Barcode</label>
                            <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Scan Barcode Here">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <form action="{{ route('pos.create') }}" method="POST">
        {{ csrf_field() }}
        <div class="col-lg-12 mb-4 mt-3">
            <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Data Product</h6>
                    </div>
                        <div div class="table-responsive">
                            <table class="table align-items-center table-flush">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Product</th>
                                        <th>Harga</th>
                                        <th>Qty</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody class="product-ajax">

                                </tbody>
                            </table>
                        </div>
                    <div class="card-footer"></div>
                </div>
        </div>

        <div class="col-lg-12 mb-4 mt-3">
            <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Total Harga Product</h6>
                </div>
                    <div div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <tbody>
                                <tr>
                                    <th>Total Harga</th>
                                    <th> : </th>
                                    <th>
                                        <input type="text" value="Rp. 100.000" readonly class="form-control">
                                    </th>
                                </tr>
                                <tr>
                                    <th>Jumlah Bayar</th>
                                    <th> : </th>
                                    <th>
                                        <input type="number" class="form-control form-control-sm" name="jumlah_bayar">
                                    </th>
                                </tr>

                                {{-- <tr>
                                    <th>Kembalian</th>
                                    <th> : </th>
                                    <th>
                                        <b>Rp.<i class="kembalian"></i></b>
                                    </th>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
            </div>
            <button class="btn btn-primary btn-block mt-3" type="submit">Submit</button>
        </div>
    </form>

@endsection

<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>  
    <script type="text/javascript">
        $(document).ready(function(){

            $("input[name='barcode']").focus();
            $("input[name='grand_total']").val(0);
            $("input[name='jumlah_bayar']").val('');

            $("input[name='barcode']").keypress(function(e){
                if (e.which == 13) {
                    e.preventDefault();
                    var kode = $(this).val();
                    var url = "{{ url('pos/product') }}"+'/'+kode;
                    var _this = $(this);

                    $.ajax({
                        type:'get',
                        dataType:'json',
                        url:url,
                        success:function(data){
                            console.log(data);
                            _this.val('');

                            var nilai = '';

                            nilai += '<tr>';
                                nilai += '<td>';
                                    nilai += data.data.kode;
                                    nilai += '<input type="hidden" class="form-control form-control-sm" name="product[]" value="'+data.data.id+'">';
                                nilai += '</td>';

                                nilai += '<td>';
                                    nilai += data.data.nama;
                                nilai += '</td>';

                                nilai += '<td class="harga">';
                                    nilai += data.data.harga;
                                    nilai += '<input id="harga" type="hidden" class="form-control form-control-sm" name="harga[]" value="'+data.data.harga+'">';
                                nilai += '</td>';

                                nilai += '<td>';
                                    nilai += '<input id="qty" type="number" class="form-control form-control-sm" name="qty[]" value="1">';
                                nilai += '</td>';

                                nilai += '<td>';
                                    nilai += '<button class="btn btn-outline-danger btn-xs hapus"><i class="fa fa-trash-alt"></i></button>';
                                nilai += '</td>';

                            nilai += '</tr>';

                            var total = parseInt($("input[name='grand_total']").val());
                            total += data.data.harga;

                            $("input[name='grand_total']").val(total);

                            $('.product-ajax').append(nilai);
                        }
                    })
                }
            })
        
        $('body').on('click', '.hapus',function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
        })

        // $('#qty').on('change', function(){
        //     $('harga').val()
        // })

        $("button[type='submit']").click(function(e){
            var grand_total = parseInt($("input[name='grand_total']").val());
            var jumlah_bayar = parseInt($("input[name='jumlah_bayar']").val());

            // if (jumlah_bayar < grand_total) {
            //     e.preventDefault();
            //     alert('Maaf Uang Yang Dimasukan Kurang Dari Total Pembelian. Silahkan Coba Lagi!');
            // }
            // alert(grand_total);
        })

        $("input[name='jumlah_bayar']").keyup(function(e){
            var grand_total = parseInt($("input[name='grand_total']").val());
            var jumlah_bayar = parseInt($(this).val());
            var kembalian = jumlah_bayar - grand_total;

            $(".kembalian").text(kembalian);
        })
    })
    </script>
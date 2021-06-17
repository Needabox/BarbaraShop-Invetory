<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

        <title>{{ $title }}</title>
    </head>
    <body>

    <h2 class="text-center mb-4">Detail Document {{ $purchase_order->no_document }}</h2>
    <table class="table table- mb-3">
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

    <br/>
    <br/>
    <table class="table table-striped">
        <thead class="thead-primary">
            <tr>
                <th>No</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Harga Beli</th>
                <th>Total Harga</th>
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

    <p class="mt-5" style="text-align:right">Mengetahui</p>
    <br>
    <br>
    <p style="text-align:right">...................</p>

    {{--  --}}
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
    </body>
</html>
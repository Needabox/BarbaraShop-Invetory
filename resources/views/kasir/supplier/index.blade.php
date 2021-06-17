@extends('layouts.master2')
@section('title')
    Supplier - Barbara Shop
@endsection
@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Supplier</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modelId">
                    Tambah Supplier
                </button>
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
                <th>Nama</th>
                <th>Alamat</th>
                <th>Nomor Telephone</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($supplier as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->nama }}</td>
                        <td>{{ $s->alamat }}</td>
                        <td>{{ $s->no_tlp }}</td>
                        <td><a href="{{ route('supplier.edit', ['id' => $s->id]) }}" class="btn btn-sm btn-primary"><i class="fas fa-pen"></i></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer">
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Tambah Supplier</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('supplier.store') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="nama">Nama Supplier</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukan Nama Supplier" aria-describedby="helpId" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat Supplier</label>
                        <textarea type="text" name="alamat" id="alamat" class="form-control" placeholder="Masukan Alamat Supplier" aria-describedby="helpId" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="no_tlp">No Telephone Supplier</label>
                        <input type="text" name="no_tlp" id="no_tlp" class="form-control" placeholder="Masukan No Telephone Supplier" aria-describedby="helpId" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    
     fetch_customer_data();
    
     function fetch_customer_data(query = '')
     {
      $.ajax({
       url:"{{ route('supplier') }}",
       method:'GET',
       data:{query:query},
       dataType:'json',
       success:function(data)
       {
        $('tbody').html(data.table_data);
        $('#total_records').text(data.total_data);
       }
      })
     }
    
     $(document).on('keyup', '#search', function(){
      var query = $(this).val();
      fetch_customer_data(query);
     });
    });
    </script> --}}
@endsection

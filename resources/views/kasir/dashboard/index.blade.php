@extends('layouts.master2')
@section('title')
    Dashboard - Barbara Shop
@endsection
@section('content')

<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <div class="row mb-3">
    <!-- Earnings Daily Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (daily)</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">Rp. {{ number_format($total_pendapatan) }}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span>Since Today</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-money-bill-wave-alt fa-2x text-primary"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Purchase Order Card -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Purchase Order</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_po }}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span>Since {{ \Carbon\Carbon::parse($po->created_at)->isoFormat('D MMMM Y') }}</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-shopping-cart fa-2x text-success"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Suppliers Card-->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Suppliers</div>
              <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $total_suppliers }}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span>Since {{ \Carbon\Carbon::parse($suppliers->created_at)->isoFormat('D MMMM Y') }}</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-users fa-2x text-info"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Product Card-->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card h-100">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-uppercase mb-1">Products</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $total_products }}</div>
              <div class="mt-2 mb-0 text-muted text-xs">
                <span>Since {{ \Carbon\Carbon::parse($product->created_at)->isoFormat('D MMMM Y') }}</span>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-cubes fa-2x text-warning"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
  <div class="row mb-3">

    <!-- Invoice Receipt -->
    <div class="col-xl-8 col-lg-7 mb-4">
      <div class="card">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Invoice Receipt</h6>
          <a class="m-0 float-right btn btn-danger btn-sm" href="{{ route('gr') }}">View More <i
              class="fas fa-chevron-right"></i></a>
        </div>
        <div class="table-responsive">
          <table class="table align-items-center table-flush">
            <thead class="thead-light">
              <tr>
                <th>No Document</th>
                <th>Suppliers</th>
                <th>Item</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($purchase_order as $pos)
                <tr>
                  <td><a href="{{ route('po.details', ['id' => $pos->id]) }}">{{ $pos->no_document }}</a></td>
                  <td>{{ $pos->suppliers->nama }}</td>
                  <td>{{ $pos->lines_count }}</td>
                  <td>                            
                    @if ($po->status == 1)
                        <span class="badge badge-warning text-white">Pending</span>
                    @elseif($po->status == 2)
                        <span class="badge badge-success text-white">Completed</span>
                    @else
                        <span class="badge badge-primarytext-white">NULL</span>
                    @endif
                  </td>
                  <td><a href="{{ route('po.details', ['id' => $pos->id]) }}" class="btn btn-sm btn-primary">Detail</a></td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>

    <?php 
      $stock = \DB::select("SELECT * FROM products WHERE stock < minimal_stock");
    ?>
    <!-- Message From Customer-->
    <div class="col-xl-4 col-lg-5 ">
      <div class="card">
        <div class="card-header py-4 bg-primary d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-light">Product Notification</h6>
        </div>
        <div>
          @forelse ($stock as $s)
            <div class="customer-message align-items-center">
              <a class="font-weight-bold" href="#">
                <div class="message-title">{{ $s->nama }} is less than the minimum amount of stock.</div>
                <div class="small text-gray-500 message-time font-weight-bold">{{ \Carbon\Carbon::parse($s->updated_at)->isoFormat('D MMMM Y') }}</div>
              </a>
            </div>
          @empty
            <p class="text-center mt-2">No notification. Have a nice day :)</p>
          @endforelse
          <div class="card-footer text-center">
            <a class="m-0 small text-primary card-link" href="{{ route('products') }}">View More Products <i
                class="fas fa-chevron-right"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

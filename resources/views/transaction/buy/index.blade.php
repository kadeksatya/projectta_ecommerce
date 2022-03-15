@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Transaksi Pembelian</h2>
</div>
<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-dollar"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">@currency($totals)</h2>
                        <p class="m-b-0 text-muted">Total Pembelian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="card">
    <div class="card-body">
        <h4>Data Pembelian</h4>
        <a href="{{route('buyer.create')}}" class="btn btn-primary">Tambah Pembelian</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Grand Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($transaction->count()==0)
                    <tr>
                        <td colspan="8" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($transaction as $t)
                    <tr>
                        <td>{{$t->order_no}}</td>
                        <td>{{$t->supplier_name}}</td>
                        <td>
                          @if ($t->status == 1)
                              <span class="badge badge-danger">Pending</span>
                          @endif
                          @if ($t->status == 2)
                          <span class="badge badge-dark">On Proses</span>
                          @endif
                          @if ($t->status == 3)
                          <span class="badge badge-success">Received</span>
                          @endif
                        </td>
                        <td>@currency($t->grand_total)</td>
                        <td class="">
                            @if ($t->status != 3)
                            <div class="dropdown dropdown-animated scale-right">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <i class="anticon anticon-setting"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{route('buyer.edit', $t->id)}}" class="dropdown-item">Edit</a>
                                    <a href="#" data-url="{{route('buyer.destroy', $t->id)}}" data-label="transaction" class="dropdown-item delete">Delete</a>

                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>

                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('script')
    <script>
    </script>
@endpush

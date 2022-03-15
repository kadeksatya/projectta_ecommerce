@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Transaksi Penjualan</h2>
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
                        <p class="m-b-0 text-muted">Total Penjualan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="card">
    <div class="card-body">
        <h4>Data Penjualan</h4>
        <a href="{{route('sales.create')}}" class="btn btn-primary">Tambah Penjualan</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Customer Name</th>
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
                        <td>#{{$t->order_no}}</td>
                        <td>{{$t->customer}}</td>
                        <td>
                            @if ($t->status == 1)
                            <span class="badge badge-danger">Pending</span>
                            @endif
                            @if ($t->status == 2)
                            <span class="badge badge-dark">Ordered</span>
                            @endif
                            @if ($t->status == 3)
                            <span class="badge badge-success">Completed</span>
                            @endif
                        </td>
                        <td>@currency($t->grand_total)</td>
                        <td class="">

                            <div class="dropdown dropdown-animated">

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <i class="anticon anticon-setting"></i>
                                </button>
                                <div class="dropdown-menu">
                                   
                                        <a href="/printinvoice/{{$t->id}}" class="dropdown-item">Print Invoice</a>
                                
                                        <a href="{{route('sales.edit', $t->id)}}" class="dropdown-item">Edit</a>
                                    
                                        <a href="#" data-url="{{route('sales.destroy', $t->id)}}" data-label="penjualan"
                                            class=" dropdown-item delete">Delete</a>
                                    
                                </div>
                            </div>

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
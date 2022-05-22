@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Dashboard</h2>
</div>
<div class="row">
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-shopping-cart"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{$best}}</h2>
                        <p class="m-b-0 text-muted">Total Best Seller</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-barcode"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">{{$product}}</h2>
                        <p class="m-b-0 text-muted">Total Barang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                        <i class="anticon anticon-pay-circle"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">Rp. {{$sales}}</h2>
                        <p class="m-b-0 text-muted">Total Penjualan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-header p-2 m-2">
               <H4> Best Seller Product</H4>
            </div>
            <div class="card-body">
                <table id="data-table" class="table">
                    <thead>
                        <th>No</th>
                        <th>Nama Product</th>
                        <th>Kategory Product</th>
                        <th>Total Penjualan</th>
                    </thead>
                    <tbody>

                        @php
                            $i = 1
                        @endphp
                        @foreach ($products as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->category->name ?? '-'}}</td>
                            <td>{{$item->checkout_time}}</td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

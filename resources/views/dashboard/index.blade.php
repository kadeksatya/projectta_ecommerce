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
    <div class="col-md-12 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                        <i class="anticon anticon-shopping-cart"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">Rp. {{$buyer}}</h2>
                        <p class="m-b-0 text-muted">Total Pembelian</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

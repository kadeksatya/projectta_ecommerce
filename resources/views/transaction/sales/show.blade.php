@extends('layouts.app')
@section('content')

<!-- Content Wrapper START -->
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between">
            <div class="media align-items-center m-b-15">
                <div class="avatar avatar-image rounded" style="height: 70px; width: 70px">
                    <img src="assets/images/others/thumb-16.jpg" alt="">
                </div>
                <div class="m-l-15">
                    <h4 class="m-b-0">{{$order->order_no}}</h4>
                    <p class="text-muted m-b-0">Status Order: <span class="badge badge-dark">{{$order->status}}</span></p>
                </div>
            </div>
            <div class="m-b-15">
                <button class="btn btn-primary">
                    <i class="anticon anticon-edit"></i>
                    <span>Edit</span>
                </button>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#product-overview">Overview</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#product-images">Product Images</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid">
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="product-overview">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Order</h4>
                        {{$order}}
                        <div class="table-responsive">
                            <table class="product-info-table m-t-20">
                                <tbody>
                                    <tr>
                                        <td>Customer Name:</td>
                                        <td class="text-dark font-weight-semibold">{{$order->customer->name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat:</td>
                                        <td> {{$order->address->address}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Tlpn:</td>
                                        <td>{{$order->customer->phone_number}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Penerima:</td>
                                        <td>{{$order->customer->name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Jasa Pengiriman:</td>
                                        <td>{{$order->ongkir->name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ongkir:</td>
                                        <td>{{$order->ongkir->value ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Keterangan Pengiriman:</td>
                                        <td>{{$order->ongkir->remark ?? '-'}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Pembelian</h4>
                        <div class="table-responsive">
                            <table class="product-info-table m-t-20">
                                <tbody>
                                    @foreach ($order->transaction_details as $key => $item)
                                    <tr>
                                        <div class="card">
                                            <div class="card-body">
                                              <h5 class="card-title">{{$item->product->name}}</h5>
                                              <hr>
                                              <p class="text-dark"><strong>Nama Varian</strong> : {{$item->variant->name}}.</p>
                                              <p class="text-dark"><strong>Jumlah Pembelian</strong> : {{$item->qty}} pcs</p>
                                            </div>
                                          </div>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td>Colors:</td>
                                        <td class="d-flex">
                                            <span class="d-flex align-items-center m-r-20">
                                                <span class="badge badge-dot product-color m-r-5"
                                                    style="background-color: #4c4e69"></span>
                                                <span>Dark Blue</span>
                                            </span>
                                            <span class="d-flex align-items-center m-r-20">
                                                <span class="badge badge-dot product-color m-r-5"
                                                    style="background-color: #868686"></span>
                                                <span>Gray</span>
                                            </span>
                                            <span class="d-flex align-items-center m-r-20">
                                                <span class="badge badge-dot product-color m-r-5"
                                                    style="background-color: #8498c7"></span>
                                                <span>Gray Blue</span>
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Fit:</td>
                                        <td>Skinny Fit</td>
                                    </tr>
                                    <tr>
                                        <td>Material:</td>
                                        <td>Polyester</td>
                                    </tr>
                                    <tr>
                                        <td>Ship From:</td>
                                        <td>Columbia</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product Description</h4>
                    </div>
                    <div class="card-body">
                        <p>Special cloth alert. The key to more success is to have a lot of pillows. Surround yourself
                            with angels, positive energy, beautiful people, beautiful souls, clean heart, angel. They
                            will try to close the door on you, just open it. A major key, never panic. Don’t panic, when
                            it gets crazy and rough, don’t panic, stay calm. They key is to have every key, the key to
                            open every door.</p>
                        <p>The other day the grass was brown, now it’s green because I ain’t give up. Never surrender.
                            Lion! I’m up to something. Always remember in the jungle there’s a lot of they in there,
                            after you overcome they, you will make it to paradise.</p>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="product-images">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <img class="img-fluid" src="assets/images/others/product-1.jpg" alt="">
                            </div>
                            <div class="col-md-3">
                                <img class="img-fluid" src="assets/images/others/product-2.jpg" alt="">
                            </div>
                            <div class="col-md-3">
                                <img class="img-fluid" src="assets/images/others/product-3.jpg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Content Wrapper END -->

@endsection

@extends('layouts.app')
@section('content')

<!-- Content Wrapper START -->
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between">
            <div class="media align-items-center m-b-15">
                <div class="avatar avatar-image rounded" style="height: 70px; width: 70px">
                    <img src="/img/shoping cart.jpg" alt="">
                </div>
                <div class="m-l-15">
                    <h4 class="m-b-0">{{$order->order_no}}</h4>
                    <p class="text-muted m-b-0">Status Order: <span class="badge badge-dark">{{$order->status}}</span></p>
                </div>
            </div>
            <div class="m-b-15">
                {{-- <button class="btn btn-primary">
                    <i class="anticon anticon-edit"></i>
                    <span>Edit</span>
                </button> --}}
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#product-overview">Overview</a>
            </li>
        </ul>
    </div>
    <div class="container-fluid">
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="product-overview">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Detail Order</h4>
                        <div class="table-responsive">
                            <table class="product-info-table m-t-20">
                                <tbody>
                                    <tr>
                                        <td>Customer Name:</td>
                                        <td class="text-dark font-weight-semibold">{{$order->customer->name ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Alamat:</td>
                                        <td> {{$order->address->address ?? '-'}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Tlpn:</td>
                                        <td>{{$order->customer->phone_number ?? '-'}}</td>
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
                                        <td>@currency($order->ongkir->value ?? 0)</td>
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

                                    <tr>
                                        <div class="card-deck">
                                            @foreach ($order->transaction_details as $key => $item)
                                            <div class="card">
                                                <center>
                                              <img class="card-img-top" src="{{$item->product->photo ?? asset('img/default.png')}}" width="120px" alt="Card image cap">

                                                </center>
                                              <div class="card-body">
                                                <h5 class="card-title">{{$item->product->name}}</h5>
                                                <p class="card-text">Nama Varian : {{$item->variant->name}}</p>
                                                <p class="card-text">Total Pembelian : {{$item->qty}}</p>
                                                <p class="card-text">Sub Total : @currency($item->sub_total)</p>
                                              </div>
                                              <div class="card-footer">
                                                <small class="text-muted">Tanggal Pembelian : {{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</small>
                                              </div>
                                            </div>
                                             @endforeach

                                          </div>
                                    </tr>

                                    <tr>
                                        <td>Total Harga:</td>
                                        <td class="d-flex">
                                            @currency($order->grand_total)
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tempat Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="product-info-table m-t-20">
                                <tbody>
                                    <tr>
                                        <td>

                                            <img src="{{$order->bank->photo ?? asset('img/default.png')}}" class="rounded float-left" width="40%" alt="" srcset="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nama Bank </strong>: {{$order->bank->name}}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Nomor Rekening </strong>: {{$order->bank->no_rek}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Bukti Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        {{-- {{$order->payments}}   --}}
                        <img src="{{$order->payments->image ?? asset('img/default.png')}}" class="rounded float-left" width="40%" alt="" srcset="">
                        <img src="{{ asset('img')}}/{{$order->payments->image ?? 'default.png'}}" class="rounded float-left" width="40%" alt="" srcset="">

                    </div>
                    <div class="card-footer">
                        <p class="text-success">Tanggal Pembayaran : {{\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')}}</p>
                      </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Catatan Pesanan</h4>
                    </div>
                    <div class="card-body">
                        <p>{{$order->remark}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Content Wrapper END -->

@endsection

@push('link_style')
    <style>
        .card-img-top{
            width: 40% !important;
        }
    </style>
@endpush

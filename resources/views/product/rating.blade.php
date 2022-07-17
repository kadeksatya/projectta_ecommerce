@extends('layouts.app')
@section('content')

<!-- Content Wrapper START -->
<div class="main-content">
    <div class="page-header no-gutters has-tab">
        <div class="d-md-flex m-b-15 align-items-center justify-content-between">
            <div class="media align-items-center m-b-15">
                <div class="avatar avatar-image rounded" style="height: 70px; width: auto">
                    <img src="{{asset('image/logo.png')}}" alt="">
                </div>
                <div class="m-l-15">
                    <h4 class="m-b-0">{{$product->name}}</h4>
                    <p class="text-muted m-b-0">Code: #{{$product->id}}</p>
                </div>
            </div>
            <div class="m-b-15">
                <a href="{{route('product.edit', $product->id)}}" class="btn btn-primary">
                    <i class="anticon anticon-edit"></i>
                    <span>Edit</span>
                </a>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#product-overview">Overview</a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#product-images">Product Images</a>
            </li> --}}
        </ul>
    </div>

    <div class="container-fluid">
        <div class="tab-content m-t-15">
            <div class="tab-pane fade show active" id="product-overview">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <i class="font-size-40 text-success anticon anticon-smile"></i>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-muted">Ratings</p>

                                        <div class="star-rating m-t-5">
                                            <span class="mt-1">{{$avg_rating}} / 5</span>
                                            <input type="radio" id="star3-5" name="rating-3" value="{{$avg_rating}}"
                                                checked disabled /><label for="star3-5"
                                                title="{{$avg_rating}} star"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <i class="font-size-40 text-primary anticon anticon-shopping-cart"></i>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-muted">Sales</p>
                                        <h3 class="m-b-0 ls-1">{{$product->checkout_time}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <i class="font-size-40 text-primary anticon anticon-message"></i>
                                    <div class="m-l-15">
                                        <p class="m-b-0 text-muted">Reviews</p>
                                        <h3 class="m-b-0 ls-1">{{$ratings->count()}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Basic Info</h4>
                        <div class="table-responsive">
                            <table class="product-info-table m-t-20">
                                <tbody>
                                    <tr>
                                        <td>Price:</td>
                                        <td class="text-dark font-weight-semibold">{{$product->sales_price}}</td>
                                    </tr>
                                    <tr>
                                        <td>Category:</td>
                                        <td>{{$product->category->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Viewer:</td>
                                        <td>{{$product->views}} Orang</td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <td>
                                            @if ($product->is_active == 1)
                                            <span class="badge badge-pill badge-cyan">Active</span>
                                            @else
                                            <span class="badge badge-pill badge-danger">In Active</span>

                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Review Customer</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="75%">Comment</th>
                                    <th width="20%">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 1
                                @endphp

                                @foreach ($ratings as $item)
                                <tr>
                                    <th scope="row">{{$no++}}</th>
                                    <td>{{$item->description}}</td>
                                    <td><span style="font-size:158%;color:yellow;">&starf;</span> {{$item->rating}} / 5
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
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
</div>
<!-- Content Wrapper END -->

@endsection

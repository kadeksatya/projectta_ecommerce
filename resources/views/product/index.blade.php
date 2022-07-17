@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Product</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Product</h4>
        <a href="/product/create" class="btn btn-primary">Tambah Product</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Unit</th>
                        <th>Sales Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @if ($product->count()==0)
                    <tr>
                        <td colspan="8" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($product as $p)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <img src="{{$p->photo}}" alt="" srcset="" class="rounded float-left" width="150px">
                        </td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->category->name ?? '-'}}</td>
                        <td>{{$p->unit->name ?? '-'}}</td>
                        <td>{{$p->sales_price}}</td>
                        <td>
                            <div class="dropdown dropdown-animated">

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <i class="anticon anticon-setting"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="product/{{$p->id}}/edit/" class="dropdown-item">Edit</a>
                                    <a href="product/{{$p->id}}/detail/" class="dropdown-item">Detail</a>
                                    <a href="product/{{$p->id}}/rating/" class="dropdown-item">Show Rating Product</a>
                                    <a href="#" data-url="{{route('product.destroy', $p->id)}}" data-label="product" class="dropdown-item delete">Delete</a>
                                </div>
                            </div>
                        </td>
                        <td class="">

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

@endpush

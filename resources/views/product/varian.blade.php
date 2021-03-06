@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Varian</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Varian</h4>
        <a href="javascript:void(0)" class="btn btn-primary add">Tambah Varian</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Total Stock</th>
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
                        <td class="">
                            <a href="product/{{$p->id}}/edit/" class="btn btn-primary">Edit</a>
                            <a href="#" data-url="{{route('product.destroy', $p->id)}}" data-label="product" class="btn btn-danger delete">Delete</a>
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

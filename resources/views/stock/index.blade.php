@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Stock</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Stock</h4>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Product</th>
                        <th>Jumlah Stok Masuk</th>
                        <th>Jumlah Stok Keluar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @if ($product->count()==0)
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($product as $p)
                    <tr>
                        <td>{{$i++}}</td>

                        <td>{{$p->name}}</td>
                        <td>{{$p->stock->stock_in ?? 0}}</td>
                        <td>{{$p->stock->stock_out ?? 0}}</td>
                        <td class="">
                            <a href="stock/{{$p->id}}/detail" class="btn btn-primary">Detail</a>
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

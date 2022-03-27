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
                        <th>Nama Variant</th>
                        <th>Jumlah Stok</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @if ($variant->count()==0)
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($variant as $p)
                    <tr>
                        <td>{{$i++}}</td>

                        <td>{{$p->name}}</td>
                        <td class="text-success">{{$p->stock_total ?? 0}}</td>
                        <td>
                            <a href="/stock/{{$p->id}}/create" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Stock</a>
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


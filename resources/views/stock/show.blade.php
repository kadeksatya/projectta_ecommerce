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
                        <th>Image</th>
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
                        <td>
                            <img src="{{$p->photo}}" alt="" srcset="" class="rounded float-left" width="150px">
                        </td>

                        <td>{{$p->name}}</td>
                        <td class="text-success">{{$p->stock_total ?? 0}}</td>
                        <td>
                            <div class="dropdown dropdown-animated">

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <i class="anticon anticon-setting"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="/stock/{{$p->id}}/create" class="dropdown-item">Tambah Stock</a>
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


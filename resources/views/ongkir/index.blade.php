@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Ongkir</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Ongkir</h4>
        <a href="/ongkir/create" class="btn btn-primary">Tambah Ongkir</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Ongkir</th>
                        <th>Biaya Ongkir</th>
                        <th>Keterangan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @if ($ongkir->count()==0)
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($ongkir as $p)
                    <tr>
                        <td>{{$i++}}</td>

                        <td>{{$p->name}}</td>
                        <td>@currency($p->value)</td>
                        <td>{{$p->remark}}</td>
                        <td class="">
                            <a href="ongkir/{{$p->id}}/edit/" class="btn btn-primary">Edit</a>
                            <a href="#" data-url="{{route('ongkir.destroy', $p->id)}}" data-label="ongkir" class="btn btn-danger delete">Delete</a>
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

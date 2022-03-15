@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">variant</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data variant</h4>
        <a href="/variant/create" class="btn btn-primary">Tambah variant</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @if ($variant->count()==0)
                    <tr>
                        <td colspan="3" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($variant as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c->name}}</td>
                        <td class="">
                            <a href="variant/{{$c->id}}/edit/" class="btn btn-primary">Edit</a>
                            <a href="#" data-url="{{route('variant.destroy', $c->id)}}" data-label="kategori" class="btn btn-danger delete">Delete</a>
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


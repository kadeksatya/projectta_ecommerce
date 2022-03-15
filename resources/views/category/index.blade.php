@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Category</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Category</h4>
        <a href="/category/create" class="btn btn-primary">Tambah Category</a>
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
                    @if ($category->count()==0)
                    <tr>
                        <td colspan="3" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($category as $c)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$c->name}}</td>
                        <td class="">
                            <a href="category/{{$c->id}}/edit/" class="btn btn-primary">Edit</a>
                            <a href="#" data-url="{{route('category.destroy', $c->id)}}" data-label="kategori" class="btn btn-danger delete">Delete</a>
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


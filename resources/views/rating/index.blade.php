@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">rating</h2>
</div>
<div class="card">

    <div class="card-body">
        <h4>Data rating</h4>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <td>Customer Name</td>
                        <th>Product Name</th>
                        <th>Commant</th>
                        <th>Rating Product</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($rating->count()==0)
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    {{$rating}}
                    @foreach($rating['detail_ratings'] as $c)
                    <tr>

                        <td>
                            {{$c->detail_ratings}}
                        </td>
                        <td>
                            {{$c->products_rating->name ?? '-'}}
                        </td>
                        <td>
                            {{$c->products_rating}}
                        </td>
                        <td>
                            {{$c->detail_ratings->rating ?? '0'}} / 5
                        </td>
                        <td class="">
                            <a href="rating/{{$c->id}}/edit/" class="btn btn-primary">Edit</a>
                            <a href="#" data-url="{{route('rating.destroy', $c->id)}}" data-label="kategori" class="btn btn-danger delete">Delete</a>
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


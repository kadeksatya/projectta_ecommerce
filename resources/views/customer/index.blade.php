@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Customer</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Customer</h4>
        <a href="{{route('customer.create')}}" class="btn btn-primary">Tambah Customer</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Telepon</th>
                        <th>Alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($customer->count()==0)
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($customer as $u)
                    <tr>
                        <td>{{$u->name}}</td>
                        <td>{{$u->phone_number}}</td>
                        <td>{{$u->address}}</td>
                        <td class="">
                            <a href="customer/{{$u->id}}/edit/" class="btn btn-primary">Edit</a>
                            <a href="#" class="btn btn-danger delete" data-label="customer" data-url="{{route('customer.destroy', $u->id)}}">Delete</a>
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

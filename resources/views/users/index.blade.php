@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Users</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Users</h4>
        <a href="{{route('user.create')}}" class="btn btn-primary">Tambah User</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($user->count()==0)
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($user as $u)
                    <tr>
                        <td>{{$u->name}}</td>
                        <td>{{$u->email}}</td>
                        <td>{{$u->role->name}}</td>
                        <td class="">
                            <a href="user/{{$u->id}}/edit/" class="btn btn-primary">Edit</a>
                            @if ($u->id != auth()->user()->id)
                            <a href="#" class="btn btn-danger delete" data-label="user" data-url="{{route('user.destroy', $u->id)}}">Delete</a>
                            @endif


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

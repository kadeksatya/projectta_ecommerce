@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Users</h2>
</div>

<div class="card">
    <div class="card-body">
        <h4>Tambah Data Users</h4>
        
        <form method="POST" action="{{route('admin.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-7">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label >Username</label>
                            <input type="text" class="form-control" name="username" placeholder="eg. budi">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="eg. ani">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="eg. ani@mail.com">
                    </div>
                        <div class="form-group">
                            <label >Role</label>
                            <select name="role_id" class="form-control">
                                <option selected>Pilih 1</option>
                                @foreach ($role as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                    
                                @endforeach
                            </select>
                        </div>
                </div>
                <div class="col-md-5">
                    <label for="">Photo</label>
                    <input type="file" name="photo" class="dropify" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Sign in</button>
        </form>
    </div>
</div>

@endsection
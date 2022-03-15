@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Customer</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Tambah Data Customer</h4>
        <form method="POST" action="{{route('customer.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="eg. ani">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="eg. ani@mail.com">
                    </div>
                    <div class="form-group">
                        <label>No Tlpn.</label>
                        <input type="tel" name="phone_number" class="form-control" placeholder="eg. ani@mail.com">
                    </div>
                    <div class="form-group">
                        <label>Address.</label>
                        <input type="tel" name="address" class="form-control" placeholder="eg. ani@mail.com">
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

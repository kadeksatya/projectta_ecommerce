@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Customer</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Edit Data Customer</h4>
        <form method="POST" action="{{route('customer.update', $customer->id)}}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <input type="hidden" class="form-control" value="{{$customer->photo}}" name="imagehidden" placeholder="eg. ani">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" value="{{$customer->name}}" name="name" placeholder="eg. ani">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{$customer->email}}" placeholder="eg. ani@mail.com">
                    </div>
                    <div class="form-group">
                        <label>No Tlpn.</label>
                        <input type="tel" name="phone_number" class="form-control" value="{{$customer->phone_number}}" placeholder="eg. 081xxx">
                    </div>
                    <div class="form-group">
                        <label>Address.</label>
                        <input type="tel" name="address" class="form-control" value="{{$customer->address}}" placeholder="eg. jln tukad batanghari">
                    </div>
                </div>
                <div class="col-md-5">
                    <label for="">Photo</label>
                    <input type="file" name="photo" class="dropify" data-default-file="/img/{{$customer->photo ?? ''}}" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection

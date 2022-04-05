@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Data variant</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Update Data variant</h4>
        <form method="POST" action="{{route('variant.update', $variant->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group mb-4">
                        <label for="">Photo</label>
                        <input type="file" name="photo" class="dropify" data-default-file="{{$variant->photo}}" />
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$variant->name}}" placeholder="eg. ani">
                        <input type="hidden" class="form-control" name="product_id" value="{{$variant->product_id}}" placeholder="eg. ani">
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection

@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Bank</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Edit Data Bank</h4>
        <form method="POST" action="{{route('bank.update',$bank->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$bank->name}}" placeholder="eg. ani">
                    </div>
                    <div class="form-group">
                        <label>Harga Beli.</label>
                        <input type="number" name="no_rek" value="{{$bank->no_rek}}" class="form-control">
                    </div>


                </div>
                <div class="col-md-5">
                    <label for="">Photo</label>
                    <input type="file" name="photo" class="dropify" data-default-file="{{$bank->photo}}" />
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('bank.index')}}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>

@endsection

@push('script')

@endpush

@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Data Category</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Tambah Data Category</h4>
        <form method="POST" action="{{route('category.update', $category->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group mb-4">
                        <label for="">Photo</label>
                        <input type="file" name="photo" class="dropify" data-default-file="{{$category->photo}}" />
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$category->name}}" placeholder="eg. ani">
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection

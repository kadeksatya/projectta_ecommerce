@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Data Category</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Tambah Data Category</h4>
        <form method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group mb-4">
                        <label for="">Photo</label>
                        <input type="file" name="photo" class="dropify" />
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="eg. ani">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection

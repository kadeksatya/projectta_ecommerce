@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Unit</h2>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <h4>Tambah Data Unit</h4>
            <form method="POST" action="{{route('unit.store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Unit</label>
                    <div class="col-sm-9">
                        <input type="input" class="form-control" id="nama" placeholder="Unit" name="name">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

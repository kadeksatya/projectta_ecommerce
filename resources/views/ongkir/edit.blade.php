@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Ongkir</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Tambah Data Ongkir</h4>
        <form method="POST" action="{{route('ongkir.update', $ongkir->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$ongkir->name}}" placeholder="eg. express">
                    </div>
                    <div class="form-group">
                        <label>Biaya.</label>
                        <input type="number" name="value" value="{{$ongkir->value}}" class="form-control">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('ongkir.index')}}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>

@endsection

@push('script')

@endpush

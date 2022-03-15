@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Variant</h2>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <h4>Ubah Data Variant</h4>
            <form method="POST" action="{{route('variant.update', $variant->id)}}" >
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">variant</label>
                    <div class="col-sm-9">
                        <input type="hidden" name="id" value="{{$variant->id}}">
                        <input type="input" class="form-control" id="nama" placeholder="variant" name="name" value="{{$variant->name}}">
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

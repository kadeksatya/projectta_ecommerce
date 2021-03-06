@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Ongkir</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Tambah Data Ongkir</h4>
        <form method="POST" action="{{route('ongkir.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="eg. express">
                    </div>
                    <div class="form-group">
                        <label>Biaya.</label>
                        <input type="number" name="value" class="form-control">
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection

@push('script')
    {{-- <script>
        $(document).ready(function () {
            if ($('input.isactive').is(':checked')) {
                alert("ngentot");
            }
        });
    </script> --}}
@endpush

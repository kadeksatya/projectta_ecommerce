@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Produk</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Tambah Data Produk</h4>
        <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="eg. ani">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" id="" class="form-control">
                            <option value="" selected disabled>Pilih 1</option>
                            @foreach ($category as $i)
                                <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit_id" id="" class="form-control">
                            <option value="" selected disabled>Pilih 1</option>
                            @foreach ($unit as $i)
                                <option value="{{$i->id}}">{{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Beli.</label>
                        <input type="number" name="cost_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga Jual.</label>
                        <input type="number" name="sales_price" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Remark.</label>
                        <textarea name="remark" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div>

                </div>
                <div class="col-md-5">
                    <label for="">Photo</label>
                    <input type="file" name="photo" class="dropify" />
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

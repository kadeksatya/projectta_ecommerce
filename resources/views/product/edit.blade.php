@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Produk</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Edit Data Produk</h4>
        <form method="POST" action="{{route('product.update', $product->id)}}" enctype="multipart/form-data">
            {{ csrf_field() }}
            @method('PUT')
            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{$product->name}}"
                            placeholder="eg. ani">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <select name="category_id" id="" class="form-control">
                            <option value="" selected disabled>Pilih 1</option>
                            @foreach ($category as $i)
                            <option value="{{$i->id}}" {{$product->category_id == $i->id ? 'selected' : ''}}>
                                {{$i->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Unit</label>
                        <select name="unit_id" id="" class="form-control">
                            <option value="" selected disabled>Pilih 1</option>
                            @foreach ($unit as $i)
                            <option value="{{$i->id}}" {{$product->unit_id == $i->id ? 'selected' : ''}}>{{$i->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Harga Beli.</label>
                        <input type="number" name="cost_price" value="{{$product->cost_price}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Harga Jual.</label>
                        <input type="number" name="sales_price" value="{{$product->sales_price}}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Remark.</label>
                        <textarea name="remark" id="" cols="30" rows="5"
                            class="form-control">{{$product->remark}}</textarea>
                    </div>

                </div>
                <div class="col-md-5">
                    <label for="">Photo</label>
                    <input type="file" name="photo" class="dropify" data-default-url="{{$product->photo}}" />

                    <div class="form-group mt-4">
                        <label for="">Product unggulan  ?</label>
                        <select name="is_featured" id="" class="form-control">
                            <option value="0" {{$product->is_feature == 0 ? 'selected':''}}>Tidak</option>
                            <option value="1" {{$product->is_feature == 1 ? 'selected':''}}>Iya</option>
                        </select>
                    </div>
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{route('product.index')}}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function () {

        // Add new element
        $(".add").click(function () {

            // Finding total number of elements added
            var total_element = $(".element").length;

            // last <div> with element class id
            var lastid = $(".element:last").attr("id");
            var split_id = lastid.split("_");
            var nextindex = Number(split_id[1]) + 1;

            var max = 5;
            // Check total number elements
            if (total_element < max) {
                // Adding new div container after last occurance of element class
                $(".element:last").after("<div class='element form-group col-md-7 m-2 p-2' id='div_" +
                    nextindex + "'></div>");

                // Adding element to <div>
                $("#div_" + nextindex).append(
                    "<input type='text' name='variant[]' class='form-control inputs' placeholder='Masukkan nama varian' id='txt_" +
                    nextindex + "'>&nbsp;<button id='remove_" + nextindex +
                    "' type='button' class='remove btn btn-danger'><i class='fa fa-trash'></i> Hapus Data</button>"
                    );

            }

        });

        // Remove element
        $('.boxer').on('click', '.remove', function () {

            var id = this.id;
            var split_id = id.split("_");
            var deleteindex = split_id[1];



            // Remove <div> with id
            var elements = $(".inputs*");

            const totals = elements.length - 1;

            if (totals === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
                return
            }

            $("#div_" + deleteindex).remove();
        });
    });
</script>
@endpush

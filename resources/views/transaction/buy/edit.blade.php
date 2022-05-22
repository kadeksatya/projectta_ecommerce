@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Edit Pembelian</h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('buyer.update', $transaction->id)}}" method="post">
                    
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="form-group col-md-6 d-none">
                            <label>Kode Transaksi</label>
                            <input type="text" name="order_no" class="form-control tgl"
                                value="{{$transaction->order_no}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal</label>
                            <input type="text" name="tgl" class="form-control tgl"
                                value="{{\Carbon\Carbon::parse($transaction->created_at)->format('Y-m-d')}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Supplier</label>
                            <select name="supplier_id" id="" class="form-control">
                                <option value="" selected>Pilih Customer</option>
                                @foreach ($supplier as $item)
                                <option value="{{$item->id}}" {{$transaction->supplier_id == $item->id ? 'selected' :''}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <table id="table-detail" class="table">
                        <thead>
                            <tr>
                                <th width="5%">Action</th>
                                <th width="40%">Product</th>
                                <th width="15%">Qty</th>
                                <th width="15%">Price</th>
                                <th width="20">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="tbody" id="tDatas">
                            @php
                            $total = 0;
                            @endphp
                            @foreach ($details as $key => $item)
                            <tr>
                                <td>
                                    <a href="javascript:void(0)" class="delDetail btn btn-danger" data-toggle="tooltip"
                                        title="Delete"><span class="fas fa-trash"></a>
                                </td>
                                <td>
                                    <select name="product_id[]" class="form-control select2 barang" style="width: 100%;"
                                        id="barang_{{ $key }}" data-key="{{ $key }}">
                                        <option value="">Pilih Barang</option>
                                        @foreach ($product as $value)
                                        <option value="{{ $value->id }}"
                                            data-harga="{{ $value->sales_price }}"
                                            {{ ($value->id == $item->product_id) ? 'selected' : ''  }}>
                                            {{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td><input type="number" min="1" required name="qty[]" class="form-control jml_pesanan"
                                        id="jml_pesanan_{{ $key }}" data-key="{{ $key }}" value="{{ $item->qty }}"></td>
                                <td><input type="text" name="sales_price[]" class="form-control sales_price"
                                        id="sales_price_{{ $key }}" value="{{$item->product_price}}"
                                        data-key="{{ $key }}" required readonly></td>
                                <td><input type="text" name="total[]" class="form-control total" id="total_{{ $key }}"
                                        value="{{$item->qty * $item->product_price}}" data-key="{{ $key }}" required
                                        readonly></td>
                            </tr>
                            @php
                            $total += $item->qty * $item->sales_price
                            @endphp
                            @endforeach
                        </tbody>
                    </table>

                    <div id="grid"></div>
                    <button type="button" class="btn btn-dark" id="addProduct"><i class="fa fa-plus"></i> Add
                        Product</button>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <div class="form-group">
                                <textarea name="remark" id="" cols="30" rows="5" class="form-control">{{$transaction->remark}}</textarea>
                            </div>
                            <div class="form-group">
                                <label> Status </label>
                                <select name="status" id="" class="form-control">
                                    <option value="" selected disabled>Pilih 1</option>
                                    <option value="1" {{$transaction->status == 1 ? 'selected' : ''}}>Pending</option>
                                    <option value="2" {{$transaction->status == 2 ? 'selected' : ''}}>Order</option>
                                    <option value="3" {{$transaction->status == 3 ? 'selected' : ''}}>Received</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Service Fee</td>
                                    <td><input type="number" value="{{$transaction->service_fee}}" name="service_fee" value="0" class="form-control"
                                            id="service_fee"></td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td><input type="number" name="grand_total" value="{{$transaction->grand_total}}" id="grand_total" readonly value="0"
                                            class="form-control grand_total"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Simpan </button>
            </div>
            </form>
        </div>
    </div>

</div>



@endsection

@push('script')
<script>
    var list_barang = JSON.parse('{!!$product!!}');



    $('#addProduct').on('click', function () {

        var option = ''
        $.each(list_barang, function (i, v) {
            option += '<option value="' + v.id + '" data-harga="' + v.sales_price + '" data-stok="' +
                0 + '">' + v
                .name + '</option>';

        });



        let number = $('.barang').length;
        $('#tDatas').append(
            '<tr>' +
            '<td>' +
            '<a href="javascript:void(0)" class="delDetail btn btn-danger" data-toggle="tooltip" title="Delete"><span class="fas fa-trash"></a>' +
            '</td>' +
            '<td>' +
            '<select name="product_id[]" class="form-control select2 barang" style="width: 100%;" id="barang_' +
            number + '" data-key="' + number + '">' +
            '<option value="">Pilih Barang</option>' +
            option +
            '</select>' +
            '</td>' +
            '<td><input type="number" min="1" required name="qty[]" value="0" class="form-control jml_pesanan" id="jml_pesanan_' +
            number + '" data-key="' + number + '"></td>' +
            '<td><input type="number" readonly min="1" required name="sales_price[]" value="" class="form-control sales_price" id="sales_price_' +
            number + '" data-key="' + number + '"></td>' +
            '<td><input type="text" name="sub_total[]" value="0" class="form-control total" id="total_' +
            number + '" data-key="' + number + '" required readonly></td>' +
            '</tr>'
        );

        $('.delDetail').click(function () {
            var toprow = $(this).closest("tr");
            toprow.remove();
            total_harga();
            sisa_pembayaran();
        });


    })


    $(document).on('keyup', '.barang, .jml_pesanan, #service_fee', function () {
        let key = $(this).data('key');
        let harga = $('#barang_' + key).find(':selected').data('harga');
        let jumlah = $('#jml_pesanan_' + key).val();
        let penjualan = $('#sales_price_' + key).val($('#barang_' + key).find(':selected').data('harga'))
        var total = harga * jumlah;
        $('#total_' + key).val(total);
        total_harga();
        sisa_pembayaran();
    });


    $(document).on('change', '.barang, .jml_pesanan,  #service_fee', function () {
        let key = $(this).data('key');
        let harga = $('#barang_' + key).find(':selected').data('harga');
        let jumlah = $('#jml_pesanan_' + key).val();
        let penjualan = $('#sales_price_' + key).val($('#barang_' + key).find(':selected').data('harga'))
        var total = harga * jumlah;
        $('#total_' + key).val(total);
        total_harga();
        sisa_pembayaran();
    });



    $('.delDetail').click(function () {
        var toprow = $(this).closest("tr");
        toprow.remove();
        sub_total();
        total_harga();
        sisa_pembayaran();
    });

    function total_harga() {
        let total = 0;
        $(".total").each(function () {
            total += parseInt($(this).val());
        });
        let service = $('#service_fee').val();
        let hasil = parseInt(total) + parseInt(service);
        $('#grand_total').val((isNaN(hasil) ? 0 : hasil));
    }

    function sisa_pembayaran() {
        let uang_muka = $('#uang_muka').val();
        let total_harga = $('#total_harga').val();

        let hasil = parseInt(total_harga) - parseInt(uang_muka);
        $('#sisa_pembayaran').val((isNaN(hasil) ? 0 : hasil));
    }
</script>
@endpush
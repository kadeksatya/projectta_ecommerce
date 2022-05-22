@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Penjualan</h2>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <form action="{{route('sales.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Kode Transaksi</label>
                            <input type="text" name="order_no" class="form-control"
                                value="{{$order_no}}"
                                readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal</label>
                            <input type="text" name="tgl" class="form-control tgl"
                                value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Customer Name</label>
                            <input name="customer" id="" class="form-control" >
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

                        </tbody>
                    </table>

                    <div id="grid"></div>
                    <button type="button" class="btn btn-dark" id="addProduct"><i class="fa fa-plus"></i> Add
                        Product</button>

                    <div class="row mt-3">
                        <div class="col-md-7">
                            <div class="form-group">
                                <textarea name="remark" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label> Status </label>
                                <select name="status" id="" class="form-control">
                                    <option value="" selected disabled>Pilih 1</option>
                                    <option value="1">Pending</option>
                                    <option value="2">Ordered</option>
                                    <option value="3">Completed</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <table class="table table-bordered">
                                <tr>
                                    <td>Service Fee</td>
                                    <td><input type="number" name="service_fee" value="0" class="form-control"
                                            id="service_fee"></td>
                                </tr>
                                <tr>
                                    <td>Grand Total</td>
                                    <td><input type="number" name="grand_total" id="grand_total" readonly value="0"
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
            sub_total();
            total_harga();
            sisa_pembayaran();
        });

    })

    $(document).on('keyup', '.barang, .jml_pesanan, #service_fee', function () {
            let key = $(this).data('key');
            let harga = $('#barang_' + key).find(':selected').data('harga');
            let jumlah = $('#jml_pesanan_' + key).val();
            let penjualan = $('#sales_price_' + key).val($('#barang_' + key).find(':selected').data(
                'harga'))

            var total = harga * jumlah;


            $('#total_' + key).val(total);
            total_harga();
            sisa_pembayaran();
        });

        $(document).on('change', '.barang, .jml_pesanan, .jml_warna', function () {
            let key = $(this).data('key');
            let harga = $('#barang_' + key).find(':selected').data('harga');
            let jumlah = $('#jml_pesanan_' + key).val();
            let penjualan = $('#sales_price_' + key).val($('#barang_' + key).find(':selected').data(
                'harga'))
            console.log(harga);
            console.log(jumlah);
            var total = harga * jumlah;

            $('#total_' + key).val(total);
            total_harga();
            sisa_pembayaran();
        });

        $('.delDetail').click(function () {
            var toprow = $(this).closest("tr");
            toprow.remove();
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
        $('#grand_total').val(hasil);
    }

</script>
@endpush
@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Transaksi Penjualan</h2>
</div>
<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="media align-items-center">
                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                        <i class="anticon anticon-dollar"></i>
                    </div>
                    <div class="m-l-15">
                        <h2 class="m-b-0">@currency($totals)</h2>
                        <p class="m-b-0 text-muted">Total Penjualan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="card">
    <div class="card-body">
        <h4>Data Penjualan</h4>
        {{$transaction}}
        {{-- <a href="{{route('sales.create')}}" class="btn btn-primary">Tambah Penjualan</a> --}}
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Customer Name</th>
                        <th>Status Order</th>
                        <th>Order Date</th>
                        <th>Grand Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @if ($transaction->count()==0)
                    <tr>
                        <td colspan="8" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($transaction as $t)
                    <tr>
                        <td>{{$t->order_no}}</td>
                        <td>{{$t->customer->name}}</td>
                        <td>
                            {{$t->status}}
                        </td>
                        <td>{{\Carbon\Carbon::parse($t->created_at)->diffForHumans()}}</td>
                        <td>@currency($t->grand_total)</td>
                        <td class="">

                            <div class="dropdown dropdown-animated">

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    <i class="anticon anticon-setting"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a href="{{route('sales.show', $t->id)}}" class="dropdown-item">Detail Order</a>
                                    @if ($t->status == 'PAID')
                                    <a href="javascript:void(0)" data-url="/order/process/{{$t->id}}"
                                        data-id="{{$t->id}}" class="dropdown-item updateStatus">Process Order</a>
                                    @endif
                                    @if ($t->status == 'PROCESSING')
                                    <a href="javascript:void(0)" data-status="SENDING" data-id="{{$t->id}}"
                                        data-url="/order/send/{{$t->id}}" class="dropdown-item updateStatus">Send
                                        Order</a>
                                    @endif
                                    @if ($t->status == 'SENDING')
                                    <a href="javascript:void(0)" data-url="/order/complete/{{$t->id}}"
                                        data-id="{{$t->id}}" class="dropdown-item updateStatus">Complete Order</a>
                                    @endif
                                    <a href="#" data-url="{{route('sales.destroy', $t->id)}}" data-label="penjualan"
                                        class=" dropdown-item delete">Delete</a>
                                </div>
                            </div>

                        </td>
                    </tr>

                    @endforeach
                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@push('script')
<!-- Modal -->
<div class="modal fade" id="modalStatusChange" tabindex="-1" role="dialog" aria-labelledby="modalStatusChange"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalStatusChange">Update Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="updateResi d-none">
                    <div class="form-group">
                        <label for="">Masukkan No Resi</label>
                        <input type="text" name="no_resi" id="no_resi" class="form-control resi_no">
                    </div>
                    <button type="button" class="btn btn-primary submitStatus" value="sendOrders">Send Order</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
                <div class="textDefault">
                    <p>Apa anda yakin untuk mengubah status ini ?</p>
                    <hr>
                    <button type="button" class="btn btn-primary submitStatus" value="setStatusOrders">Ya,
                        Proses</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.updateStatus').click(function () {
        $('#no_resi').val('');
        console.log('klik cang')
        var label = $(this).data('label');
        var url = $('.updateStatus').data('url');
        var resi = $(this).data('status');
        var id = $(this).data('id');
        $('#modalStatusChange').modal('show')
        console.log(url);
        if (resi === 'SENDING') {
            $('.updateResi').removeClass('d-none');
            $('.textDefault').addClass('d-none');
        } else {
            $('.updateResi').addClass('d-none');
            $('.textDefault').removeClass('d-none');


        }

        $(document).on('click', '.submitStatus', function () {
            var token = $("meta[name='csrf-token']").attr("content");
            console.log('click cang')
            var val = $(this).val()
            var resi_no = $('.resi_no').val()
            console.log(val);
            if (val === 'sendOrders') {

                Swal.fire({
                    title: 'Perhatian',
                    text: "Apakah yakin melakukan pengiriman ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Kirim!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'PUT',
                            data: {
                                "id": id,
                                "_token": token,
                                "resi_no": resi_no
                            },
                            success: function (data) {
                                Swal.fire(
                                    'Sukses!',
                                    data.message,
                                    'success'
                                )
                                window.location.reload().time(3)
                            }
                        });
                    }
                })
            }
            if (val === 'setStatusOrders') {
                $.ajax({
                    url: url,
                    type: 'PUT',
                    data: {
                        "id": id,
                        "_token": token,
                    },
                    success: function (data) {
                        Swal.fire(
                            'Sukses!',
                            data.message,
                            'success'
                        )
                        window.location.reload().time(3)
                    }
                });
            }
        })

        //     Swal.fire({
        //     title: 'Perhatian',
        //     text: "Apakah yakin menghapus data "+label+" ?",
        //     icon: 'warning',
        //     showCancelButton: true,
        //     confirmButtonColor: '#3085d6',
        //     cancelButtonColor: '#d33',
        //     confirmButtonText: 'Ya, Hapus!'
        //   }).then((result) => {
        //     if (result.isConfirmed) {
        //       var id = $(this).data("id");
        //       var token = $("meta[name='csrf-token']").attr("content");
        //           $.ajax(
        //             {
        //                 url: url,
        //                 type: 'DELETE',
        //                 data: {
        //                     "id": id,
        //                     "_token": token,
        //                 },
        //                 success: function (data){
        //                   Swal.fire(
        //                     'Deleted!',
        //                     data.message,
        //                     'success'
        //                   )
        //                   window.location.reload().time(3)
        //                 }
        //             });
        //     }
        //   })
    })
</script>
@endpush

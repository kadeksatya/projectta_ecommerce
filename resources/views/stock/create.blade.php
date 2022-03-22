@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Stock</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Stock</h4>
        <a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$variant->id}}"
            class="btn btn-primary">Tambah Stock</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Keterangan</th>
                        <th>Jumlah Stok Masuk</th>
                        <th>Jumlah Stok Keluar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @if ($stock->count()==0)
                    <tr>
                        <td colspan="4" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($stock as $p)
                    <tr>
                        <td>{{$i++}}</td>

                        <td>{{$p->remark}}</td>
                        <td class="text-success">{{$p->stock_in ?? 0}}</td>
                        <td class="text-danger">{{$p->stock_out ?? 0}}</td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('stock.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Nama Product</label>
                        <select name="variant_id" id="" class="form-control" readonly>
                            <option value="{{$variant->id}}">{{$variant->name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Type Stock</label>
                        <select name="stock_type" id="" class="form-control">
                            <option value="" disabled selected>Pilih Type Stock</option>
                            <option value="IN">Masuk</option>
                            <option value="OUT">Keluar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Stock</label>
                        <input type="text" name="value" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="">Catatan *</label>
                        <textarea name="remark" id="" cols="20" rows="2" class="form-control"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endpush

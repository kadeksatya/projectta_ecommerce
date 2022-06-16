@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Laporan Penjualan</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Laporan Penjualan</h4>
        <form action="{{route('sales.print')}}" method="get">
        @csrf
        <!-- Range Datepicker-->
        <div class="form-group">
            <label>Cari Data</label>
            <div class="d-flex align-items-center">
                <select class="form-control" name="status" id="">
                    <option value="" selected disabled>---- Pilih Status -----</option>
                    <option value="PENDING">PENDING</option>
                    <option value="PAID">PAID</option>
                    <option value="SENDING">SENDING</option>
                    <option value="COMPLETED">COMPLETED</option>
                    <option value="CANCEL">CANCEL</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label>Cari Data</label>
            <div class="d-flex align-items-center">
                <input type="text" class="form-control datepicker-input" name="from" placeholder="From" autocomplete="off">
                <span class="p-h-10">to</span>
                <input type="text" class="form-control datepicker-input" name="to" placeholder="To" autocomplete="off">
            </div>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Cari Data</button>
        </div>
        </form>

        <div class="m-t-25">
        </div>
    </div>
</div>

@endsection

@push('script')
@endpush

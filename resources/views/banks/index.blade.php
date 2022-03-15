@extends('layouts.app')
@section('content')

<div class="page-header">
    <h2 class="header-title">Bank</h2>
</div>
<div class="card">
    <div class="card-body">
        <h4>Data Bank</h4>
        <a href="/bank/create" class="btn btn-primary">Tambah Bank</a>
        <div class="m-t-25">

            <table id="data-table" class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Logo</th>
                        <th>Nama</th>
                        <th>No. Rekeking</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1
                    @endphp
                    @if ($bank->count()==0)
                    <tr>
                        <td colspan="5" class="text-center">Tidak Ada Data!</td>
                        </td>
                    </tr>
                    @else
                    @foreach($bank as $p)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <img src="{{asset('img')}}/{{$p->photo ?? 'default.png'}}" alt="" srcset="">
                        </td>
                        <td>{{$p->name}}</td>
                        <td>{{$p->no_rek}}</td>
                        <td class="">
                            <a href="bank/{{$p->id}}/edit/" class="btn btn-primary">Edit</a>
                            <a href="#" data-url="{{route('bank.destroy', $p->id)}}" data-label="bank" class="btn btn-danger delete">Delete</a>
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

@endpush

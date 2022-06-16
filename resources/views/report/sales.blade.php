<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>Laporan Penjualan</title>

    <style>
        body {
            font-size:12px
        }
    </style>
  </head>
  <body>
      <div class="text-center">
        <h2>Laporan Penjualan</h2>
        <h4>BLOOMINGFIELDS BALI</h4>
        <p>Dari {{ \Carbon\Carbon::parse(request('from'))->format('d F Y') }} S/D {{ \Carbon\Carbon::parse(request('to'))->format('d F Y') }}</p>
      </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Customer Name</th>
                    <th>Status Order</th>
                    <th>Order Date</th>
                    <th>Grand Total</th>
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
                </tr>

                @endforeach
                @endif

            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

  </body>
</html>

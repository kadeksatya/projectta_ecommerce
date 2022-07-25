<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\GeneralLedger;
use App\GeneralLedgerDetail;
use App\Transaction;
use App\Http\Controllers\Controller;
use App\Product;
use App\Stock;
use App\TransactionDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['totals'] = Transaction::where('status', 'COMPLETED')->sum('grand_total');
        $data['transaction'] = Transaction::with(['customer'])->orderby('created_at', 'DESC')->paginate(5);
        // dd($data['totals']);
        return view('transaction.sales.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $totalP = Transaction::where('transaction_type', 'SALES')->count();
        $totalP++;
        $data['order_no'] = str_pad($totalP, 2, '0', STR_PAD_LEFT);
        // dd($data['order_no']);

        $data['product']= Product::all();
        return view('transaction.sales.add', $data);
    }

            /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDataProduct()
    {
        $data = Product::all();

        return response()->json([
            'message' => 'Data Found',
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['order'] = Transaction::whereId($id)->with(['customer','address','ongkir','bank', 'transaction_details.product','transaction_details.variant'])->first();
        $data['payments'] = Transaction::where('transaction_id', $id)->first();
        return view('transaction.sales.show', $data);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printInvoice($id)
    {
        $data = Transaction::find($id);

        $data['sales'] = Transaction::find($id);
        $data['detail']= TransactionDetail::with('product')->where('trx_id', $data->id)
        ->get();
        $pdf = PDF::loadview('report.nota.index', $data);
    	return $pdf->stream();

        // return view('report.nota.index', $data);
        // dd($data['sales']);
    }

    public function procces($id)
    {
        Transaction::whereId($id)->update([
            'status' => 'PROCESSING'
        ]);
        return response()->json([
            'message' => 'Order berhasil diprocess'
        ]);

    }

    public function pending($id)
    {
        Transaction::whereId($id)->update([
            'status' => 'PAID'
        ]);
        return response()->json([
            'message' => 'Pembayaran berhasil diprocess'
        ]);

    }

    public function send(Request $request, $id)
    {
        Transaction::whereId($id)->update([
            'status' => 'SENDING',
            'resi_no' => $request->resi_no
        ]);
        return response()->json([
            'message' => 'Order berhasil dikirim'
        ]);

    }

    public function updateResi(Request $request, $id)
    {
        Transaction::whereId($id)->update([
            'status' => 'SENDING',
            'resi_no' => $request->resi_no
        ]);
        return response()->json([
            'message' => 'Order berhasil dikirim'
        ]);

    }

    public function complete($id)
    {
        Transaction::whereId($id)->update([
            'status' => 'COMPLETED'
        ]);

        $data = TransactionDetail::where('trx_id', $id)->get();

        foreach ($data as $key => $value) {

            $product =  Product::whereId($value['product_id'])->first();
            $checkouted = $product->checkout_time + $value['qty'];
            Product::whereId($value['product_id'])->update(['checkout_time'=> $checkouted]);
        }

        return response()->json([
            'message' => 'Order berhasil diselesaikan'
        ]);

    }

    public function cencel($id)
    {
        Transaction::whereId($id)->update([
            'status' => 'CENCEL'
        ]);

        $datas = Transaction::whereId($id)->first();

        $data = TransactionDetail::where('trx_id', $id)->get();



        foreach ($data as $key => $value) {
            $stock = [
                'variant_id' => $value['variant_id'],
                'stock_in' => $value['qty'],
                'remark' => 'Stock bertambah sebesar '.' '.$value['qty'].' '.'karena pesanan dibatalkan dengan kode'.' '.$datas->order_no
            ];
            Stock::create($stock);
        }

        return response()->json([
            'message' => 'Order berhasil dibatalkan'
        ]);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['transaction']= Transaction::where('id',$id)->first();
        $data['details']= TransactionDetail::where('trx_id',$id)->get();
        $data['product']= Product::all();
        return view('transaction.sales.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();


        // dd($request->all());

        $this->validate($request, [
            'customer_id' => 'required',
            'order_no' => 'required',
            'status' => 'required',
            'product_id' => 'required',


        ]);

        try {

            Transaction::where('id', $id)->update([
                'customer_id' => $request->customer,
                'order_no' => $request->order_no,
                'status' => "ON_PROGRESS",
                'payment_status' => "PENDING",
                'ongkir_id'=> $request->ongkir_id,
                'bank_id'=> $request->bank_id,
                'payment_value'=> $request->payment_value,
                'transfer_value'=> $request->transfer_value,
                'address_id' => $request->address_id,
                'remark' => $request->remark


            ]);

            TransactionDetail::where('trx_id', $id)->delete();

            $product_ids = $request->product_id;

            for ($count = 0; $count < count($product_ids); $count++) {
                $product = [
                    'trx_id' => $id,
                    'product_id' => $request->product_id[$count],
                    'qty' => $request->qty[$count] ?? 0,
                    'product_price' => $request->sales_price[$count] ?? 0,
                    'sub_total' => $request->sub_total[$count] ?? 0,
                ];


                TransactionDetail::create($product);
            }


            DB::commit();

            return redirect()->route('sales.index')
                             ->with('success', 'Transaction Penjualan berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transaction::where('id', $id)->delete();
        TransactionDetail::where('trx_id', $id)->delete();

        return response()->json([
            "message" => "Transaction berhasil dihapus."
        ]);
    }
}

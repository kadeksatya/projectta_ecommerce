<?php

namespace App\Http\Controllers\Admin;

use App\Customer;
use App\GeneralLedger;
use App\GeneralLedgerDetail;
use App\Transaction;
use App\Http\Controllers\Controller;
use App\Product;
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
        $data['totals'] = Transaction::where('status', 3)->sum('grand_total');
        $data['transaction'] = DB::table('transaction')
        ->where('transaction_type', 'SALES')
        ->where('deleted_at', '=', null)->get();
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

        $this->validate($request, [
            'customer' => 'required',
            'order_no' => 'required',
            'status' => 'required',
            'grand_total' => 'required',
            'product_id' => 'required',


        ]);


        try {

            $ids = Transaction::insertGetId([
                'customer' => $request->customer,
                'order_no' => $request->order_no,
                'user_id' => Auth::user()->id,
                'status' => $request->status,
                'transaction_type' => 'SALES',
                'service_fee' => $request->service_fee,
                'grand_total'=> $request->grand_total,
                'remark' => $request->remark


            ]);


            $product_ids = $request->product_id;

            for ($count = 0; $count < count($product_ids); $count++) {
                $product = [
                    'trx_id' => $ids,
                    'product_id' => $request->product_id[$count],
                    'qty' => $request->qty[$count] ?? 0,
                    'product_price' => $request->sales_price[$count] ?? 0,
                    'sub_total' => $request->sub_total[$count] ?? 0,
                ];


                TransactionDetail::create($product);
            }

            if($request->status == 3){
                $totals_income = (int)$request->grand_total - (int)$request->service_fee;
                $data = new GeneralLedger();
                $data->account_master_id = 4;
                $data->transaction_date = Carbon::now()->format('Y-m-d');
                $data->save();

                $service = new GeneralLedger();
                $service->account_master_id = 4;
                $service->transaction_date = Carbon::now()->format('Y-m-d');
                $service->save();

                $dataArray = array(
                    'general_ledger_id' => $data->id,
                    'account_id' => 24,
                    'type' => 'DB',
                    'value' => $totals_income
                );


                $dataArrayService = array(
                        'general_ledger_id' => $service->id,
                        'account_id' => 4,
                        'type' => 'DB',
                        'value' => $request->service_fee
                    );

                GeneralLedgerDetail::create($dataArray);
                GeneralLedgerDetail::create($dataArrayService);
            }

            DB::commit();

            return redirect()->route('sales.index')
                             ->with('success', 'Transaction Penjualan berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['transaction'] = Transaction::find($id);
        return view('admin.transaction.show', $data);
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
            'customer' => 'required',
            'order_no' => 'required',
            'status' => 'required',
            'grand_total' => 'required',
            'product_id' => 'required',


        ]);

        try {

            Transaction::where('id', $id)->update([
                'customer' => $request->customer,
                'order_no' => $request->order_no,
                'user_id' => Auth::user()->id,
                'status' => $request->status,
                'transaction_type' => 'SALES',
                'service_fee' => $request->service_fee,
                'grand_total'=> $request->grand_total,
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


            if($request->status == 3){
                $totals_income = (int)$request->grand_total - (int)$request->service_fee;
                $data = new GeneralLedger();
                $data->account_master_id = 4;
                $data->transaction_date = Carbon::now()->format('Y-m-d');
                $data->save();


                $dataArray = array(
                    'general_ledger_id' => $data->id,
                    'account_id' => 24,
                    'type' => 'DB',
                    'value' => $totals_income
                );


                $dataArrayService = array(
                        'general_ledger_id' => $data->id,
                        'account_id' => 4,
                        'type' => 'DB',
                        'value' => $request->service_fee
                    );

                $dataArrayService = array(
                        'general_ledger_id' => $data->id,
                        'account_id' => 4,
                        'type' => 'DB',
                        'value' => $request->cost_price
                    );


                GeneralLedgerDetail::create($dataArray);
                GeneralLedgerDetail::create($dataArrayService);
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

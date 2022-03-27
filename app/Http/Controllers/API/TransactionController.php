<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionDetail;
use App\UserCustomers;
use Illuminate\Http\Request;
use DB;
use Carbon;


class TransactionController extends Controller
{
    public function store(Request $request)
    {
        DB::beginTransaction();

        $mytime = Carbon\Carbon::now();
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $count = Transaction::whereDate('created_at', date('Y-m-d'))->count();
        $increment = str_pad($count + 1, 8, "0", STR_PAD_LEFT);
        $order_no = "INV/{$year}/{$month}/{$day}/{$increment}";

        try {


            if($request->grand_total == $request->transfer_value){
                $ids = Transaction::insertGetId([
                    'order_no' => $order_no,
                    'customer_id' => $request->customer_id,
                    'status' => "PAID",
                    'payment_status' => null,
                    'ongkir_id'=> $request->ongkir_id,
                    'bank_id'=> $request->bank_id,
                    'grand_total'=> $request->grand_total,
                    'transfer_value'=> $request->transfer_value,
                    'address_id' => $request->address_id,
                    'remark' => $request->remark,
                    'created_at' => $mytime
                ]);


            }
            else {
                $ids = Transaction::create([
                    'order_no' => $order_no,
                    'customer_id' => $request->customer_id,
                    'status' => "PENDING",
                    'payment_status' => null,
                    'ongkir_id'=> $request->ongkir_id,
                    'bank_id'=> $request->bank_id,
                    'grand_total'=> $request->grand_total,
                    'transfer_value'=> $request->transfer_value,
                    'address_id' => $request->address_id,
                    'remark' => $request->remark,
                    'created_at' => $mytime

                ]);


            }



            $product_ids = $request->transaction_detail;

            // dd($product_ids);
            foreach ($product_ids as $key => $value) {
                $product = [
                    'trx_id' => $ids,
                    'product_id' => $value['product_id'],
                    'variant_id' => $value['variant_id'],
                    'qty' => $value['qty'] ?? 0,
                    'product_price' => $value['sales_price'] ?? 0,
                    'sub_total' => $value['sub_total'] ?? 0,
                ];



                TransactionDetail::create($product);
            }


            $datas = Transaction::where('id', $ids)->get();

            DB::commit();

            return response()->json([
                'message' => 'Data successfully created !',
                'data' => $datas
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([$e->getMessage() . " at line " . $e->getLine()], 500);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([$e->getMessage() . " at line " . $e->getLine()], 500);
        }
    }

    public function detail($id)
    {
        try {

            $datas = Transaction::with(['bank','ongkir','address','transaction_details.product','transaction_details.variant'])
            ->get();

            return response()->json([
                'message' => 'Data successfully created !',
                'data' => $datas
            ], 200);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([$e->getMessage() . " at line " . $e->getLine()], 500);
        } catch (\Throwable $e) {
            DB::rollback();
            return response()->json([$e->getMessage() . " at line " . $e->getLine()], 500);
        }
    }




}
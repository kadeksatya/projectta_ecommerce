<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Product;
use App\Stock;
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

            $datas = Transaction::where('id', $ids)->first();
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

                $stock = [
                    'variant_id' => $value['variant_id'],
                    'stock_out' => $value['qty'],
                    'remark' => 'Stock sudah terjual sebesar '.' '.$value['qty'].' '.'di order id'.' '.$datas['order_no']
                ];

                TransactionDetail::create($product);
                Stock::create($stock);
            }

            Cart::where('customer_id', $request->customer_id)->delete();



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
            ->where('id', $id)
            ->get();

            return response()->json([
                'message' => 'Data found !',
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

    public function list($id)
    {
        try {

            $datas = Transaction::with(['bank','ongkir','address','transaction_details.product','transaction_details.variant'])
            ->where('customer_id', $id)
            ->orderBy('created_at', 'DESC')
            ->get();

            return response()->json([
                'message' => 'Data found !',
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

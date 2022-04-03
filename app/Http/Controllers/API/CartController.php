<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{

    public function index($customer_id)
    {
        $datas = Cart::where('customer_id', $customer_id)->with(['variant','product'])->get();

        DB::commit();

        return response()->json([
            'message' => 'Data found !',
            'data' => $datas
        ], 200);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try{
        $data = array (
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'variant_id' => $request->variant_id,
            'qty' => $request->qty,
            'sub_total' => $request->sub_total,
            'sales_price' => $request->sales_price,
        );

        $variant = Cart::where('variant_id', $request->variant_id)
        ->where('customer_id', $request->customer_id)
        ->first();

        if($variant === null){
            $datas = Cart::create($data);
        }
        else {
            Cart::where('variant_id', $request->variant_id)
            ->where('customer_id', $request->customer_id)
            ->update($data);

            $datas = Cart::where('variant_id', $request->variant_id)
            ->where('customer_id', $request->customer_id)
            ->first();
        }



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

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try{
        $data = array (
            'customer_id' => $request->customer_id,
            'product_id' => $request->product_id,
            'variant_id' => $request->variant_id,
            'qty' => $request->qty,
            'sub_total' => $request->sub_total,
            'sales_price' => $request->sales_price,
        );

        $data = Cart::whereId($id)->update($data);

        $datas = Cart::whereId($id)->get();
        DB::commit();

        return response()->json([
            'message' => 'Data successfully updated !',
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


    public function destroy($id)
    {
        $datas = Cart::whereId($id)->delete();
        return response()->json([
            'message' => 'Data successfully deleted !',
        ], 200);
    }
}

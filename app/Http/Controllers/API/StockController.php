<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Variant;
use Illuminate\Http\Request;

class StockController extends Controller
{

    public function getListStock(Request $request)
    {
        try{

        $data = array(
            'id' => $request->variant_id,
            'stock_out' => $request->stock_out
        );

        $stock = Variant::find($request->variant_id);

        $totals = $stock->stock_total - $request->stock_out;

        if($totals < 0){
            return response()->json([
                'message' => 'unavaliable stock !',
            ], 400);
        }

        if($data == null){

            return response()->json([
                'message' => 'stock avaliable !',
            ]);
        }

        return response()->json([
            'message' => 'data found',
        ], 200);

        } catch (\Exception $e) {

            return response([
                'message' => [$e->getMessage() . " at line " . $e->getLine()]
            ], 500);
        } catch (\Throwable $e) {

            return response([
                'message' => [$e->getMessage() . " at line " . $e->getLine()]
            ], 500);
        }

    }

    public function getProductWithCategory(Request $request , $id)
    {
        try{

        $data = Product::where('category_id', $id)->paginate(($request->all()));

        if(!$data){

            return response()->json([
                'message' => 'data not found',
                'data' => $data
            ]);
        }

        return response()->json([
            'message' => 'data found',
            'data' => $data
        ]);

        } catch (\Exception $e) {

            return response([
                'message' => [$e->getMessage() . " at line " . $e->getLine()]
            ], 500);
        } catch (\Throwable $e) {

            return response([
                'message' => [$e->getMessage() . " at line " . $e->getLine()]
            ], 500);
        }

    }

}

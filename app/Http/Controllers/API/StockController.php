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
        $stocks = $request->stock;
        $collection = collect($stocks);
        $datas = $collection->implode('variant_id',',');
        $stock = Variant::with('product')->whereIn('id', explode(',',$datas))->get();


        return response()->json([
            'message' => 'data found',
            'data' => $stock
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

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function getList(Request $request)
    {
        if($request->product != null){
            $data = Product::where('name', 'LIKE', '%'.$request->product.'%')
            ->get();
        }
        else{
            $data = Product::all();

        }
        return response()->json([
            'message' => 'data found',
            'data' => $data
        ], 200);
    }


    public function getDetailProduct(Request $request , $id)
    {
        try{

        Product::whereId($id)->increment('views');

        $data = Product::whereId($id)->with('variant')->first();

        if(!$data){

            return response()->json([
                'message' => 'data not found',
                'data' => $data
            ], 404);
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

    public function getRecommendationProduct(Request $request)
    {
        try{

            $data = Product::orderBy('checkout_time','DESC')
            ->get();



        return response()->json([
            'message' => 'data found',
            'data' => $data
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

    public function getPopularProduct(Request $request)
    {
        try{

            $data = Product::orderBy('views','DESC')
            ->get();

        return response()->json([
            'message' => 'data found',
            'data' => $data
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
    public function getIsFeaturedProduct(Request $request)
    {
        try{

            $data = Product::where('is_feature', 1)
            ->get();

        return response()->json([
            'message' => 'data found',
            'data' => $data
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
}

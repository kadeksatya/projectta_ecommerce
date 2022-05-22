<?php

namespace App\Http\Controllers\API;

use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function getListCategory()
    {
        try{

        $data = Category::all();

        if($data == null){

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

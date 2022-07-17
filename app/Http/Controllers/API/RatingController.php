<?php

namespace App\Http\Controllers\API;

use App\HasRatings;
use App\Http\Controllers\Controller;
use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $id = new Rating;
            $id->product_id = $request->product_id;
            $id->description = $request->description;
            $id->rating = $request->rating;
            $id->save();

            HasRatings::create([
                'product_id' => $request->product_id,
                'customer_id' => auth('api')->user()->id,
                'rating_id' => $id->id,
                'is_reviewed' => 1
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Review Product Submited !'
            ], 200);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $th->getMessage()
            ], 500);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}

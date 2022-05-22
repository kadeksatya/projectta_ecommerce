<?php

namespace App\Http\Controllers\API;

use App\Banks;
use App\Http\Controllers\Controller;
use App\Variant;
use Illuminate\Http\Request;

class BankController extends Controller
{

    public function getListBank(Request $request)
    {
        try{


        $data = Banks::all();

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

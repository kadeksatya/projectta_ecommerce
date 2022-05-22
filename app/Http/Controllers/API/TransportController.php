<?php

namespace App\Http\Controllers\API;

use App\Ongkir;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransportController extends Controller
{

    public function getListTransport(Request $request)
    {
        try{


        $data = Ongkir::all();

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

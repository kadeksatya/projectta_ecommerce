<?php

namespace App\Http\Controllers\API;

use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddressController extends Controller
{
    public function index($customer_id)
    {


        try{

            $data = Address::where('customer_id', $customer_id)->get();

            if(!$data){

                return response()->json([
                    'message' => 'data not found',
                    'data' => $data
                ], 200);
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

    public function store(Request $request)
    {

        DB::beginTransaction();
        try{


            Address::create([
                'name' => $request->name,
                'customer_id' => $request->customer_id,
                'address' => $request->address,
                'remark' => $request->remark,
            ]);

            $data = Address::where('customer_id', $request->customer_id)->first();

            DB::commit();
            return response()->json([
                'message' => 'address successully created !',
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
    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        try{


            Address::whereId($id)->update([
                'name' => $request->name,
                'customer_id' => $request->customer_id,
                'address' => $request->address,
                'remark' => $request->remark,
            ]);

            DB::commit();

            $data = Address::where('customer_id', $request->customer_id)->first();
            return response()->json([
                'message' => 'address successully updated !',
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

    public function destroy($id)
    {
        try{

            Address::whereId($id)->delete();

            return response()->json([
                'message' => 'address successully deleted !',
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

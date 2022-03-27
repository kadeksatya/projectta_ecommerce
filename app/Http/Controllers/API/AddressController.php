<?php

namespace App\Http\Controllers\API;

use App\Address;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function getAddress($customer_id)
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

    public function createDataAddress(Request $request)
    {
       $datas =  $request->validate([
            'name' => 'required',
            'customer_id' => 'required',
            'address' => 'required',
            'remark' => 'required',
        ]);

        try{

            $data = Address::create($datas);

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
    public function updateDataAddress(Request $request, $id)
    {
       $datas =  $request->validate([
            'name' => 'required',
            'customer_id' => 'required',
            'address' => 'required',
            'remark' => 'required',
        ]);

        try{

            $data = Address::whereId($id)->update($datas);

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

    public function deleteDataAddress($id)
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

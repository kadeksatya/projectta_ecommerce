<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;


class PaymentController extends Controller
{
    public function upload(Request $request)
    {
        DB::beginTransaction();
        try {


            $name = rand(1, 99999) . now()->format('Y-m-d-H-i-s');

            $image = $request->file('image');
            $new_name =$name . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('img');
            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$new_name);

            $datas = Payment::where('transaction_id', $request->transaction_id)->first();


            if($datas == null){
                $data = array (
                    'transaction_id' => $request->transaction_id,
                    'image' => asset('img', true).'/'.$new_name,
                );
                Payment::create($data);
            }
            else {
                $data = array (
                    'transaction_id' => $request->transaction_id,
                    'image' => asset('img', true).'/'.$new_name,
                );
                Payment::where('transaction_id', $request->transaction_id)->update($data);
            }




            DB::commit();
            return response()->json([
                'message' => 'successfully uploaded !'
            ]);
            //code...
        } catch (\Exception $e) {
            DB::rollBack();

            return response([
                'message' => [$e->getMessage() . " at line " . $e->getLine()]
            ], 500);

        } catch (\Throwable $e) {
            DB::rollBack();

            return response([
                'message' => [$e->getMessage() . " at line " . $e->getLine()]
            ], 500);
        }
    }
}

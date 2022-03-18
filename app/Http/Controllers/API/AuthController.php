<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        DB::beginTransaction();

            try{



                $datas = array(
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone_number' => $request->input('phone_number'),
                    'address' => $request->input('address'),
                    'photo' => $request->input('photo'),
                    'username' => $request->input('username'),
                    'password' => Hash::make($request->input('password')),
                    'role_id' => 3
                );

            if(User::where('username',$request->input('username'))->exists()){
                return response()->json([
                    'message' => 'Username already taken !'
                ], 500);
            }

            $data = User::create($datas);

            DB::commit();

            return response()->json([
                'message' => 'Registered!',
                'data' => $data
            ], 200);

    }catch (\Exception $e) {
        DB::rollback();
        return response()->json([
           'message' => $e->getMessage() . " at line " . $e->getLine()
        ], 500);
    } catch (\Throwable $e) {
        DB::rollback();
        return response()->json([
            'message' => $e->getMessage() . " at line " . $e->getLine()
         ], 500);
    }

    }


    public function user()
    {
        return 'LOGIN SUKSES';
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\User;
use App\Http\Controllers\Controller;
use App\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['user'] = User::all();
        return view('users.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['role'] = Roles::all();
        return view('users.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        try {

            $name = rand(1, 99999) . now()->format('Y-m-d-H-i-s');
            $new_name = "";

            if($request->hasFile('photo')){

                $image = $request->file('photo');
                $new_name =$name . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/');
                $img = Image::make($image->getRealPath());
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$new_name);

            }

            if (User::where('username', $request->username)->exists()) {
                return redirect()->back()
                             ->with('error', 'Username sudah digunakan.');
            }
            else{
                $data = [
                    'name' => $request->name,
                    'photo' => $new_name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'role_id' => $request->role_id,
                ];

                User::create($data);
            }



            DB::commit();

            return redirect()->route('admin.index')
                             ->with('success', 'User berhasil dibuat.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['user']= User::find($id);
        return view('users.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['user'] = User::find($id);
        $data['role'] = Roles::all();
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
            'username' => 'required',
            'role_id' => 'required',
        ]);

        try {

            $image_hidden = $request->imagehidden;
            $image = $request->file('photo');
            if($image != '')
            {
                $name = rand(1, 99999) . now()->format('Y-m-d-H-i-s');
                $image_hidden = $name . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/');
                $img = Image::make($image->getRealPath());
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$image_hidden);
                // File::delete(public_path("assets/backend/img/post/$data->Image"));

            }

            /*if (Admin::where('username', $request->username)->exists()) {
                return redirect()->back()
                             ->with('error', 'Username sudah digunakan.');
            }*/

            $data = [
                'name' => $request->name,
                'photo' => $image_hidden,
                'email' => $request->email,
                //'username' => $request->username,
                'role_id' => $request->role_id,
            ];

            if($request->password != null || $request->password != ''){
                $data['password'] = Hash::make($request->password);
            }

            User::where('id', $id)->update($data);

            DB::commit();

            return redirect()->route('user.index')
                             ->with('success', 'User berhasil diubah.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        } catch (\Throwable $e) {
            DB::rollback();
            return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return response()->json([
            "message" => "User berhasil dihapus."
        ]);
    }
}

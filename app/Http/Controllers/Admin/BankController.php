<?php

namespace App\Http\Controllers\Admin;

use App\Banks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['bank'] = Banks::all();
        return view('banks.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.add');
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
            'no_rek' => 'required',
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

            if (Banks::where('name', $request->bankname)->exists()) {
                return redirect()->back()
                             ->with('error', 'bank name sudah digunakan.');
            }
            else{
                $data = [
                    'name' => $request->name,
                    'photo' => asset('img').'/'.$new_name,
                    'no_rek' => $request->no_rek,
                ];

                Banks::create($data);
            }



            DB::commit();

            return redirect()->route('bank.index')
                             ->with('success', 'akun bank berhasil dibuat.');
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
        $data['bank']= Banks::find($id);
        return view('banks.index', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['bank'] = Banks::find($id);
        return view('banks.edit', $data);

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
            'no_rek' => 'required',
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

            /*if (Admin::where('bankname', $request->bankname)->exists()) {
                return redirect()->back()
                             ->with('error', 'bankname sudah digunakan.');
            }*/

            $data = [
                'name' => $request->name,
                'photo' => $image_hidden,
                'no_rek' => $request->email,
                //'bankname' => $request->bankname,

            ];

            Banks::where('id', $id)->update($data);

            DB::commit();

            return redirect()->route('bank.index')
                             ->with('success', 'bank berhasil diubah.');
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
        Banks::destroy($id);

        return response()->json([
            "message" => "bank berhasil dihapus."
        ]);
    }
}

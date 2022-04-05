<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['variant'] = Variant::all();
        return view('variant.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['product'] = Product::whereId($id)->first();
        return view('variant.add', $data);
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

        ]);

        try {

            if (Variant::where('name', $request->name)->exists()) {
                return redirect()->back()
                             ->with('error', 'Nama varian sudah digunakan.');
            }

            $name = rand(1, 99999) . now()->format('Y-m-d-H-i-s');

            if($request->file('photo')){

                $image = $request->file('photo');
                $new_name =$name . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img');
                $img = Image::make($image->getRealPath());
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$new_name);

                $data = [
                    'product_id' => $request->product_id,
                    'name' => $request->name,
                    'photo' => asset('img').'/'.$new_name
                ];

                Variant::create($data);
            }
            else{
                $data = [
                    'product_id' => $request->product_id,
                    'name' => $request->name,
                    'photo' => asset('img/default.png')
                ];

                Variant::create($data);
            }


            DB::commit();

            return redirect('product/'. $request->product_id .'/detail')
                             ->with('success', 'Varian berhasil dibuat.');
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
        $data['variant'] = Variant::find($id);
        return view('admin.variant.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['variant'] = Variant::find($id);
        return view('variant.edit', $data);
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

        ]);

        try {

            $name = rand(1, 99999) . now()->format('Y-m-d-H-i-s');
            $image = $request->file('photo');

            if($image != ''){

                $new_name =$name . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img');
                $img = Image::make($image->getRealPath());
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$new_name);

                $data = [
                    'name' => $request->name,
                    'photo' => asset('img').'/'.$new_name
                ];

                Variant::where('id', $id)->update($data);
            }
            else{
                $data = [
                    'name' => $request->name,
                ];

                Variant::where('id', $id)->update($data);
            }



            DB::commit();

            return redirect('product/'. $request->product_id .'/detail')
                             ->with('success', 'Varian berhasil diubah.');
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
        Variant::destroy($id);

        return response()->json([
            "message" => "Variant berhasil dihapus."
        ]);
    }
}

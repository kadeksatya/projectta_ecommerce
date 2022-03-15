<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use App\Http\Controllers\Controller;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['product'] = product::with(['category','unit'])->get();
        return view('product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        return view('product.add', $data);
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
            'category_id' => 'required',
            'unit_id' => 'required',
            'cost_price' => 'required',
            'sales_price' => 'required',
            'remark' => 'required',

        ]);

        try { 

            $name = rand(1, 99999) . now()->format('Y-m-d-H-i-s');

            if($request->file('photo')){

                $image = $request->file('photo');
                $new_name =$name . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('img/');
                $img = Image::make($image->getRealPath());
                $img->resize(400, 400, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$new_name);

            }

            if (Product::where('name', $request->name)->exists()) {
                return redirect()->back()
                             ->with('error', 'Nama product sudah digunakan.');
            }

            $data = [
                'name' => $request->name,
                'photo' => $new_name ?? null,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'cost_price' => $request->cost_price,
                'sales_price' => $request->sales_price,
                'is_active' => $request->is_active ?? 1,
                'remark' => $request->remark,
            ];

            Product::create($data);

            DB::commit();

            return redirect()->route('product.index')
                             ->with('success', 'product berhasil dibuat.');
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
        $data['product'] = Product::with(['category','unit'])->find($id);
        return view('admin.product.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = Category::all();
        $data['unit'] = Unit::all();
        $data['product'] = Product::with(['category','unit'])->find($id);
        return view('product.edit', $data);
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
            'category_id' => 'required',
            'unit_id' => 'required',
            'cost_price' => 'required',
            'sales_price' => 'required',
            'remark' => 'required',

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

            $data = [
                'name' => $request->name,
                'photo' => $image_hidden,
                'category_id' => $request->category_id,
                'unit_id' => $request->unit_id,
                'cost_price' => $request->cost_price,
                'sales_price' => $request->sales_price,
                'is_active' => $request->is_active ?? 1,
                'remark' => $request->remark,
            ];

            Product::where('id', $id)->update($data);

            DB::commit();

            return redirect()->route('product.index')
                             ->with('success', 'Product berhasil diubah.');
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
        Product::destroy($id);

        return response()->json([
            "message" => "Product berhasil dihapus."
        ]);
    }
}

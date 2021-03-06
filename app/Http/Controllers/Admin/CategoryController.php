<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['category'] = Category::all();
        return view('category.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.add');
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

            if (Category::where('name', $request->name)->exists()) {
                return redirect()->back()
                             ->with('error', 'Nama kategori sudah digunakan.');
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
                    'name' => $request->name,
                    'photo' => asset('img').'/'.$new_name,
                ];

            }
            else
            {
                $data = [
                    'name' => $request->name,
                    'photo' => asset('img/default.png'),
                ];

            }

            // dd($data);

            Category::create($data);

            DB::commit();

            return redirect()->route('category.index')
                             ->with('success', 'Kategori berhasil dibuat.');
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
        $data['category'] = Category::find($id);
        return view('admin.category.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['category'] = Category::find($id);
        return view('category.edit', $data);
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

                $data = [
                    'name' => $request->name,
                    'photo' => asset('img').'/'.$image_hidden,
                ];
            }
            else{
                $data = [
                    'name' => $request->name,
                ];
            }

            Category::where('id', $id)->update($data);

            DB::commit();

            return redirect()->route('category.index')
                             ->with('success', 'Kategori berhasil diubah.');
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
        Category::destroy($id);

        return response()->json([
            "message" => "Kategori berhasil dihapus."
        ]);
    }
}

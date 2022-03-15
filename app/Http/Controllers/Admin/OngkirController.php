<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Ongkir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OngkirController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['ongkir'] = Ongkir::all();
        return view('ongkir.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ongkir.add');
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
            'value' => 'required',

        ]);

        try {

            if (Ongkir::where('name', $request->name)->exists()) {
                return redirect()->back()
                             ->with('error', 'Nama Ongkir sudah digunakan.');
            }

            $data = [
                'name' => $request->name,
                'value' => $request->value,
            ];

            Ongkir::create($data);

            DB::commit();

            return redirect()->route('ongkir.index')
                             ->with('success', 'Ongkir berhasil dibuat.');
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
        $data['ongkir'] = Ongkir::find($id);
        return view('admin.ongkir.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['ongkir'] = Ongkir::find($id);
        return view('ongkir.edit', $data);
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
            'value' => 'required',

        ]);

        try {

            $data = [
                'name' => $request->name,
                'value' => $request->value,
            ];

            Ongkir::where('id', $id)->update($data);

            DB::commit();

            return redirect()->route('ongkir.index')
                             ->with('success', 'Ongkir berhasil diubah.');
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
        Ongkir::destroy($id);

        return response()->json([
            "message" => "Kategori berhasil dihapus."
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\Stock;
use App\Variant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['product'] = Product::with('stock')->get();
        return view('stock.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['variant'] = Variant::find($id);
        $data['stock'] = Stock::where('variant_id', $id)->get();
        return view('stock.create', $data);
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
            'variant_id' => 'required',

        ]);

        try {

            if($request->stock_type === 'IN'){
                $data = [
                    'variant_id' => $request->variant_id,
                    'stock_in' => $request->value,
                    'stock_out' => 0,
                    'remark' => $request->remark,
                ];
            }
            if($request->stock_type === 'OUT'){
                $data = [
                    'variant_id' => $request->variant_id,
                    'stock_in' => 0,
                    'stock_out' => $request->value,
                    'remark' => $request->remark,
                ];
                $datasStock = Stock::where('variant_id', $request->variant_id)->sum('stock_in');

                // dd($datasStock);

                    $total = $datasStock - $request->value;
                    if($total < 0) {

                        return redirect()->back()->withErrors('Stock kurang dari 0');
                }
            }

            Stock::create($data);

            DB::commit();

            return redirect()->back()->with('message','Data stock berhasil dibuat!');
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
        $data['variant'] = Variant::with('stocks')->where('product_id', $id)->get();
        return view('stock.show', $data);
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function details($id)
    {
        $data['variant'] = Variant::find($id);
        $data['stock'] = Stock::where('variant_id', $id)->get();
        return view('stock.detail', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $data['stock'] = Stock::find($id);
        // return view('stock.edit', $data);
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
        // DB::beginTransaction();

        // $this->validate($request, [
        //     'variant_id' => 'required',

        // ]);

        // try {

        //     $data = [
        //         'variant_id' => $request->variant_id,
        //         'stock_in' => $request->stock_in,
        //         'stock_out' => $request->stock_out,
        //     ];

        //     Stock::where('id', $id)->update($data);

        //     DB::commit();

        //     return redirect()->route('stock.index')
        //                      ->with('success', 'stock berhasil diubah.');
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        // } catch (\Throwable $e) {
        //     DB::rollback();
        //     return redirect()->back()->withErrors([$e->getMessage() . " at line " . $e->getLine()]);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}

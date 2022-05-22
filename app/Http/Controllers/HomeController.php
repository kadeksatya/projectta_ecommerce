<?php

namespace App\Http\Controllers;

use App\Product;
use App\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['sales'] = Transaction::where('status', 'COMPLETED')->sum('grand_total');
        $data['best'] = Product::where('checkout_time', '>', 1)->count();
        $data['product'] = Product::all()->count();
        $data['products'] = Product::orderBy('checkout_time', 'DESC')->with('category')->limit(10)->get();
        return view('dashboard.index', $data);
    }
}

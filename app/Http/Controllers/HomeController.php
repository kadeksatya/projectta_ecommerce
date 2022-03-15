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
        $data['sales'] = Transaction::where('transaction_type', 'SALES')->where('status', 3)->sum('grand_total');
        $data['buyer'] = Transaction::where('transaction_type', 'BUYER')->where('status', 3)->sum('grand_total');
        $data['product'] = Product::all()->count();
        return view('dashboard.index', $data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Account;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $customer_id = Auth::user()->id;

      $customer_name = Auth::user()->name;

      $account_number = Account::where('customer_id', $customer_id)
                                ->first()
                                ->account_number;

      $data = [
        'customer_name' => $customer_name,
        'account_number' => $account_number
      ];

      return view('home')->with($data);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

use Validator;
use Auth;
use App\User;
use App\Account;
use App\Transaction;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getNewAccount()
    {
      $customer_id = Auth::user()->id;

      $existingAccount = Account::where('customer_id', $customer_id)
                          ->first();

      if (Auth::check() && $existingAccount  == null) {
        return view('new-account');
      }
      else {
        return redirect('/home');
      }
    }

    public function postNewAccount(Request $req)
    {
      $customer_id = Auth::user()->id;

      $account_number = '';

      $account_numbers = [];

      $accounts = Account::all();

      foreach ($accounts as $key => $value) {
        $account_numbers[] = $value->account_number;
      }

      do {
        for ($i=0; $i < 15; $i++) {
          $randnum = rand(0, 9);
          $account_number = $account_number.$randnum;
        }
      } while (in_array($account_number, $account_numbers));

      $newAccount = new Account;
      $newAccount->customer_id = $customer_id;
      $newAccount->account_number = $account_number;
      $newAccount->type = $req->type;
      $newAccount->description = $req->description;
      $newAccount->save();

      if ($req->address != null) {
        $user = User::findOrFail($customer_id);
        $user->address = $req->address;
        $user->save();
      }

      return redirect('/home');
    }

    public function getDeposit(Request $req)
    {
      $customer_id = Auth::user()->id;

      $account_number = Account::where('customer_id', $customer_id)
                                ->first()
                                ->account_number;

      $data = [
        'account_number' => $account_number,
        'msg' => false
      ];

      return view('/deposit')->with($data);
    }

    public function postDeposit(Request $req)
    {
      $validator = Validator::make($req->all(), [
            'amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/deposit')
                        ->withErrors($validator)
                        ->withInput();
        }

      $newTransaction = new Transaction;
      $newTransaction->type = 1;
      $newTransaction->name = 'deposit';
      $newTransaction->customer_id = Auth::user()->id;
      $newTransaction->amount = $req->amount;
      $newTransaction->save();

      return redirect()->back()->withSuccess('Transaction success.');
    }

    public function getWithdraw(Request $req)
    {
      $customer_id = Auth::user()->id;

      $account_number = Account::where('customer_id', $customer_id)
                                ->first()
                                ->account_number;

      $data = [
        'account_number' => $account_number,
        'msg' => false
      ];

      return view('/withdraw')->with($data);
    }

    public function postWithdraw(Request $req)
    {
      $validator = Validator::make($req->all(), [
            'amount' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return redirect('/withdraw')
                        ->withErrors($validator)
                        ->withInput();
        }

      $newTransaction = new Transaction;
      $newTransaction->type = 2;
      $newTransaction->name = 'withdraw';
      $newTransaction->customer_id = Auth::user()->id;
      $newTransaction->amount = $req->amount;
      $newTransaction->save();

      return redirect()->back()->withSuccess('Transaction success.');
    }

    public function getTransfer(Request $req)
    {
      $customer_id = Auth::user()->id;

      $account_number = Account::where('customer_id', $customer_id)
                                ->first()
                                ->account_number;

      $data = [
        'account_number' => $account_number,
        'msg' => false
      ];

      return view('/transfer')->with($data);
    }

    public function postTransfer(Request $req)
    {
      $validator = Validator::make($req->all(), [
            'amount' => 'required|numeric',
            'receiver_account_number' => 'required|digits:15',
        ]);

        if ($validator->fails()) {
            return redirect('/transfer')
                        ->withErrors($validator)
                        ->withInput();
        }

      $newTransaction = new Transaction;
      $newTransaction->type = 2;
      $newTransaction->name = 'transfer';
      $newTransaction->customer_id = Auth::user()->id;
      $newTransaction->amount = $req->amount;
      $newTransaction->receiver_account_number = $req->receiver_account_number;
      $newTransaction->save();

      return redirect()->back()->withSuccess('Transaction success.');
    }

    public function getMutation(Request $req)
    {
      $customer_id = Auth::user()->id;

      $account_number = Account::where('customer_id', $customer_id)
                                ->first()
                                ->account_number;

      $transactions = Transaction::where('customer_id', $customer_id)
                                  ->orderBy('created_at', 'desc')
                                  ->take(Transaction::count())
                                  ->get();

      $data = [
        'account_number' => $account_number,
        'transactions' => $transactions
      ];

      return view('mutation')->with($data);
    }
}

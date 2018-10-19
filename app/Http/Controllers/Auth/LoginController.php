<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'phone' => 'required|digits_between:6,15',
            'password' => 'required|min:6'
        ]);

        $user = User::where('phone', $request->get('phone'))
                      ->first();

        if(!$user || !Hash::check($request->get('password'), $user->password)) {
          return redirect('/login')
                ->withErrors(['msg'=>'Phone number or password is not correct.']);
        }

        // Set Auth Details
        Auth::login($user);

        // Redirect home page
        return redirect('/home');
    }
}

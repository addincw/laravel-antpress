<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/backsite';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index () {
        return view('backsite.login');
    }

    public function username()
    {
        return 'username';
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $request->session()->flash('status', [
                'code' => 'success',
                'message' => 'Selamat datang ' . Auth::user()->name,
            ]);

            return redirect($this->redirectTo);
        }

        $request->session()->flash('status', [
          'code' => 'danger',
          'message' => 'username / password tidak sesuai',
        ]);

        return redirect()->back();
    }

    public function logout ()
    {
        try {
            Auth::logout();
            return redirect($this->redirectTo);
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm($role)
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        } 


        return view('pengguna.auth.login',compact('role'));
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

          $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        $role = $request->role;


        if($role == "users") {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

        }elseif ($role == "waspang") {

            $credentials = [
                'username' => $request->email,
                'password' =>  $request->password
            ];

        }elseif ($role == "mitra") {

            $credentials = [
                'username' => $request->email,
                'password' =>  $request->password
            ];

        }else{
             $credentials = [];
        }

        if (Auth::guard($role)->attempt($credentials, $request->get('remember') )) {
            // return $this->sendLoginResponse($request);
            return redirect()->intended('/dashboard');

        }

        return $this->sendFailedLoginResponse($request);
    }

    public function logout(Request $request)
    {
        $this->guard(activeGuard())->logout();
        $request->session()->invalidate();

        return redirect('/');
    }

    protected function guard()
    {
        return Auth::guard(activeGuard());
    }
}


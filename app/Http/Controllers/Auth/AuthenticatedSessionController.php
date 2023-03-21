<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class AuthenticatedSessionController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/home';


    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */


      public function __construct()
        {
            $this->middleware('guest')->except('logout');
            $this->middleware('guest:sekolah')->except('logout');
            // $this->middleware('guest:guru')->except('logout');
        }


    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     * 69762749 teknik1212
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // $request->authenticate($request->role,$request);


        $this->validate($request, [
            'email'   => 'required',
            'password' => 'required'
        ]);

        $role = $request->role;


        if($role == "web") {
            $credentials = [
                        'email' => $request->email,
                        'password' => $request->password
                    ];

        }elseif ($role == "mitra") {

            $credentials = [
                'username' => $request->email,
                'password' => $request->password
            ];

        }elseif ($role == "guru") {

            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ];

        }else{
             $credentials = [];
        }



        if (Auth::guard($role)->attempt($credentials)) {

            return $this->sendLoginResponse($request);

                // $request->session()->regenerate();
                // return redirect()->intended(RouteServiceProvider::HOME);
        } else {

            // return redirect()->back();
            // return redirect()->intended(RouteServiceProvider::HOME);
            return redirect()->route('login')->with('error', 'Email & Password are incorrect.');

        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        Auth::guard('sekolah')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}

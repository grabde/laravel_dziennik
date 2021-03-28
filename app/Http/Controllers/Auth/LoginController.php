<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    private function redirectTo(){
        session(['who' => auth()->user()->who]);
        session(['name' => auth()->user()->name]);
        session(['surname' => auth()->user()->surname]);
        session(['id' => auth()->user()->id]);
        switch (session('who')){
            case 'A':
                session(['suffix' => '_A']);
                break;
            case 'N':
                session(['suffix' => '_N']);
                break;
            case 'U':
                return session(['suffix' => '_UR']);
                break;
            case 'R':
                session(['id' => auth()->user()->id_child]);
                session(['suffix' => '_UR']);
                break;
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

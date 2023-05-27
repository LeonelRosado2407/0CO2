<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;



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
/*    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }*/

    function showLoginForm (){
      return view('auth.login');
    }

    protected function redirectTo()
    {

        switch(auth()->user()->id_rol){
            case 1:
            return '/Bienvenida/Inicio'; 
            break;

            case 2:
            return '/Bienvenido/Chofer';
            break;

            case 3:
            return'/Bienvenido/Cliente';
            break; 

            default:
            return '/home';
            break;
        }
    }
    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => 'Login Incorrecto'];
        return redirect()->back()
            ->withInput($request->only($this->username(),'remember'))
            ->withErrors($errors);
    }


    


}

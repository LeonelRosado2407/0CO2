<?php

namespace App\Http\Controllers\Auth;

use App\Model\Usuario;
use App\Model\Cliente;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
// use Illuminate\Support\Facades\DB;

// use App\Http\Controllers\Auth\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/usuarios/registro';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            'id_rol' => 'required|int',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return Usuario::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'id_rol' => $data['id_rol'],
        ]);
    }

    function formulario_usuarios(){
      return view('auth.register');

    }

    public function register(Request $request)
    {
        if($request->exists('escliente')){
            //con esto damos de alta a un cliente
            $request->request->add(['id_rol'=>3]);
        }

        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if($request->exists('escliente')){
            $context = $request->all();
            $cliente = new CLiente();
            $cliente ->Nombre = $context['Nombre'];
            $cliente ->id_Usuarios = $user->id_Usuarios;
            $cliente -> save();
            //con esta linea de código mantrenemos la secion iniciada.
            $this->guard()->login($user);
            $this->redirectTo='/Bienvenido/Cliente';
            
        }

        return $this->registered($request, $user)
        ?: redirect($this->redirectPath());
    }

    function autoregistro(){
        return view('auth.autoregistro');
    }

}

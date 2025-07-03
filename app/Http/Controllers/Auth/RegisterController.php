<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

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
        $messages = [
        'celular.unique' => 'Este número de celular ya está registrado.',
        'email.unique' => 'Este correo ya está en uso.',
        // Puedes añadir más mensajes si quieres
    ];

    return \Validator::make($data, [
        'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\s\-]+$/u'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'celular' => ['required', 'digits_between:7,15', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ], $messages);
    }
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function register(Request $request)
{
    $this->validator($request->all())->validate();

    $user = $this->create($request->all());

    Auth::login($user);

    return redirect()->route('felicidades'); // 👈 esto es lo que muestra el mensaje de bienvenida
}
}

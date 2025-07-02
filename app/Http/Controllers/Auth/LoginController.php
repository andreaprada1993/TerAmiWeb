<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => ['El correo no está registrado.'],
            ]);
        }

        throw ValidationException::withMessages([
            'password' => ['La contraseña es incorrecta.'],
        ]);
    }

    protected function authenticated(Request $request, $user)
{
    if ($user->first_login) {
        $user->first_login = false;
        $user->save();

        return redirect()->route('felicidades');
    }

    return redirect()->intended($this->redirectPath());
}
}

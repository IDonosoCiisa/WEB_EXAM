<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class LoginController extends Controller
{
    public function formLogin()
    {
        if (Auth::check()){
            return redirect()->route('backoffice.dashboard');
        }
        return view('login.login');
    }

    public function validateLogin(Request $request)
    {
        $mensajes = [
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email no es válido',
            'password.required' => 'La contraseña es obligatoria'
        ];

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], $mensajes);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('backoffice.dashboard');
        }

        return redirect()->back()->withErrors([
            'email' => 'Las credenciales no coinciden'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('raiz');
    }

    public function newUser()
    {
        if(Auth::check()){
            return redirect()->route('backoffice.dashboard');
        }
        return view('login.register');
    }
    public function register(Request $request)
    {
        $mensajes = [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener al menos 2 caracteres',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'apellido.required' => 'El apellido es obligatorio',
            'apellido.min' => 'El apellido debe tener al menos 2 caracteres',
            'apellido.max' => 'El apellido no puede tener más de 255 caracteres',
            'rut.required' => 'El rut es obligatorio',
            'rut.min' => 'El rut debe tener al menos 7 caracteres',
            'rut.max' => 'El rut no puede tener más de 10 caracteres',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'La contraseña es obligatoria',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
        ];
        $request->validate([
            'nombre' => 'required|min:2|max:255',
            'apellido' => 'required|min:2|max:255',
            'rut' => 'required|min:7|max:10',
            'email' => 'required',
            'password' => 'required|min:4',
        ], $mensajes);
        $data = $request->only('nombre', 'apellido', 'rut', 'email', 'password', 'checkPassword');
        if ($data['password'] != $data['checkPassword']) {
            return redirect()->back()->withErrors([
                'password' => 'Las contraseñas no coinciden'
            ]);

        }
        try {
            $password = Hash::make($data['password']);
            User::create([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'rut' => $data['rut'],
                'email' => $data['email'] . '@ventafix.com',
                'password' => $password,
            ]);
            return redirect()->route('formLogin')->with('success', 'Usuario registrado correctamente');
        } catch (\Exception $ex) {
            if ($ex->getCode() == 23000) {
                return back()->withErrors([
                    'email' => 'El email ya está en uso'
                ]);
            }
            return redirect()->back()->with('error', 'Error al registrar el usuario');
        }
    }

}

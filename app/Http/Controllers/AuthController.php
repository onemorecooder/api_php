<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Firebase\JWT\JWT;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function login(Request $request)
    {
        try {
            // autenticar al usuario con las credenciales proporcionadas
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                // generar token JWT
                $user = Auth::user();
                $payload = [
                    'sub' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'iat' => time(),
                    'exp' => time() + (60 * 60 * 24) // expira en 24 horas
                ];
                $jwt = JWT::encode($payload, env('JWT_SECRET'), 'HS256');

                // en el caso de buscar emitir token JWT al usuario pondria este return
                // return response()->json([
                //     'token' => $jwt
                // ]);

                /* return redirect()->route('boards.show'); */
                return redirect()->route('selectApi');
            }
        } catch (\PDOException $e) {
            // error de conexión a la base de datos
            throw ValidationException::withMessages([
                'email' => 'Error: No se puede establecer una conexión con la base de datos. Revisa tu conexión.',
            ]);
        }

        // error de validación
        throw ValidationException::withMessages([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ]);
    }



    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        Auth::login($user);

        return redirect()->route('selectApi');
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if (!$token) {
            // Token no presente por inicio con Google
            Auth::logout();

            return redirect('/');
        }

        // Decodificar token JWT y validar firma
        try {
            $payload = JWT::decode($token, config('jwt.secret'), ['HS256']);
        } catch (Exception $e) {
            return response()->json(['error' => 'Token inválido'], 401);
        }

        Auth::logout();

        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        // Verificar si el usuario ya existe en la base de datos
        $existingUser = User::where('email', $user->getEmail())->first();

        if ($existingUser) {
            // El usuario ya existe, inicia sesión con Laravel
            Auth::login($existingUser);
        } else {
            // El usuario no existe, crear una nueva cuenta
            $newUser = new User();
            $newUser->name = $user->getName();
            $newUser->email = $user->getEmail();
            $newUser->password = Hash::make(Str::random(20));
            $newUser->save();

            Auth::login($newUser);
        }

        return redirect()->route('selectApi');
    }
}

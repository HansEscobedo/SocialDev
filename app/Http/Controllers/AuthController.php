<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{

    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'birth_date' => $request->birth_date,
            'password' => $request->password,
            'last_name' => $request->last_name,
            'user_name' => $request->user_name,
            'pdf_path' => $request->pdf_path,
            'role' => $request->role,
            'publications' => $request->publications
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try
        {
            if(!$tokenCheck = JWTAuth::attempt($credentials))
            {
                return response()->json([
                    'message' => 'las credenciales ingresadas son incorrectas.'
                ], 400);
            }
            $token = $tokenCheck;

            $user = auth()->user();
        } catch (JWTException $e){
            return response()->json([
                'error' => 'token no creado'
            ], 500);
        }

        return response()->json(compact('token'));
    }

    public function verifyToken()
    {
        try {
            $token = JWTAuth::getToken();

            if(!$token) {
                return response()->json([
                    'error', 'Token no proporcionado.'
                ], 400);
            }

            // Verificar si el token es valido
            $user = JWTAuth::parseToken()->authenticate();

            // si el token es válido retornamos una respuesta exitosa
            return response()->json([
                'message' => 'Token válido',
                'user' => $user
            ]);


        } catch (JWTException $e) {
            // Manejo de excepciones
            return response()->json(['error' => 'Token inválido'], 401);
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

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
        /*$userID = $user->id;
        $areaSkills = $request->area_skills_id;
        $softSkills = $request->soft_skills_id;
        $programmingLanguages = $request->programming_languages_id;

        foreach ($areaSkills as $areaSkill) {
            DB::table('user_area_skills')->insert([
                'user_id' => $userID,
                'area_skills_id' => $areaSkill
            ]);
        }
        foreach ($softSkills as $softSkill) {
            DB::table('user_soft_skills')->insert([
                'user_id' => $userID,
                'soft_skills_id' => $softSkill
            ]);
        }
        foreach ($programmingLanguages as $programmingLanguage) {
            DB::table('user_programming_languages')->insert([
                'user_id' => $userID,
                'programming_languages_id' => $programmingLanguage
            ]);
        }*/

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

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
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

            $validateToken = JWTAuth::fromUser($user);
            // si el token es válido retornamos una respuesta exitosa
            return response()->json([
                'message' => 'Token válido',
                'user' => $user,
                'token' => $validateToken
            ],200);


        } catch (JWTException $e) {
            // Manejo de excepciones
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                // Se intenta refrescar el token
                try {
                    $refreshedToken = JWTAuth::refresh($token);
                    return response()->json([
                        'message' => 'Token refrescado',
                        'token' => $refreshedToken
                    ],200);
                } catch (\Throwable $th) {
                    return response()->json([
                        'error' => 'No se pudo refresar el token'
                    ], 401);
                }   
            }
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

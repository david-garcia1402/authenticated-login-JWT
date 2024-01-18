<?php

namespace App\Http\Controllers;

use App\Http\Exception\CustomApiException;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Laravel\Sanctum\NewAccessToken;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = \App\Models\User::all();

        if (auth()->check())
        {
            return $users->toJson();
        } else {
            $api = new CustomApiException(401, 'Logue na sua conta primeiramente');
            $api->ApiResponse();
        }
    }

    public function register(RegisterUserRequest $request)
    {
        return User::create(['email' => $request->validated('email'),
                            'password' => Hash::make($request->validated('password')),
                            'name' => $request->user]);

    }

    public function login(Request $request)
    {

        if (Auth::attempt($request->only('email', 'password')))
        {
            $user = Auth::user();
            Auth::login($user);
            $token = $user->createToken('apitoken')->plainTextToken;

            $cookie = cookie('jwt', $token, 60 * 24); //1 dia

            $name = \App\Models\User::query()
            ->select('name')
            ->where('email', $request->email)
            ->first();
            
            return response()->json([
                'status' => 200,
                'message' => "Usuário " . $name->name . " logado com sucesso",
                'token' => $token
            ])->withCookie($cookie);
        } else {
            $api = new CustomApiException(500, 'Não existe este usuário, registre-se');
            $api->ApiResponse();
        }
    }

    public function logout()
    {
        $cookie = Cookie::forget('jwt');
        Auth::user()->logout;

        return response()
        ->json([
            'message' => 'Logout feito com sucesso'
        ])->withCookie($cookie);
    }
}

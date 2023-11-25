<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginUserrequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserrequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only("email", "password"))) {
            return $this->Err('', "You Are A Liar", 401);
        }
        $user = User::where('email',$request->email)->first();
        return $this->Ok([
            'user' => $user,
            'token' => $user->createToken('Token' . $user->name)->plainTextToken,
        ]);

    }
    public function register(StoreUserRequest $request)
    {
        $request->validated($request->all());
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return $this->Ok([
            'user' => $user,
            'token' => $user->createToken($user->name . 'Token')->plainTextToken,
        ]);
    }
    public function logout()
    {
        return response()->json([
            'hehe' => 'bye bye'
        ], 200);
    }
}

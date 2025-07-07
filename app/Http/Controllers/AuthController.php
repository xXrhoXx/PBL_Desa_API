<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Validator;
class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('nik', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'NIK atau Password salah'], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => auth()->user()
        ]);
    }

    public function test(Request $request)
    {
       //dd('test');
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Berhasil logout']);
    }

    public function me()
    {
        return response()->json(auth()->user());
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' => 'required|string|unique:users,nik',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'password' => 'required|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::create([
            'nik' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => bcrypt($request->password)
        ]);

        $token = JWTAuth::fromUser($user);


        return response()->json([
            'message' => 'Registrasi berhasil',
            'user' => $user,
            'token' => $token
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function login()
    {
        $username = request('email');
        $password = request('password');
        if (filter_var($username, FILTER_VALIDATE_EMAIL)){
            if (! $token = auth('api')->attempt(['email' => $username, 'password' => $password])) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }else {
            if (! $token = auth('api')->attempt(['cin' => $username, 'password' => $password])) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        }

        if (auth('api')->user()->role == 'ROLE_ADMIN'
            || auth('api')->user()->role == 'ROLE_EMPLOYE')
        {

            auth('api')->logout();
            return response()->json(['error' => 'Log in through admin interface'], 200);

        }
        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60
        ]);
    }


}

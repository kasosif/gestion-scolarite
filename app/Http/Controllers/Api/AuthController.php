<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

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
        $role = auth('api')->user()->role;
        return $this->respondWithToken($token, $role);
    }

    public function logout()
    {
        auth('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function lastnotifs() {
        if (!auth('api')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $user = auth('api')->user();

        if ($user->role == 'ROLE_ETUDIANT' || $user->role == 'ROLE_PROFESSEUR') {
            $notifsUnread = $user->unreadNotifications->count();
            $notifs = $user->notifications()->take(4)->get();
            return response()->json([
                'unread' => $notifsUnread,
                'notifs' => $notifs
            ]);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    protected function respondWithToken($token, $role)
    {
        return response()->json([
            'role' => $role,
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => auth('api')->factory()->getTTL() * 60
        ]);
    }


}

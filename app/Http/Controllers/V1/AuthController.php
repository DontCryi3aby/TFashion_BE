<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        
        $refreshToken = $this->createRefreshToken();

        return $this->respondWithToken($token, $refreshToken);
    }

    public function profile()
    {
        try {
            return response()->json(auth()->user());
        } catch(JWTException $exception) {
            return response()->json(['error' => "Unauthorized"], 404);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        $refreshToken = request()->refresh_token;
        
        try {
            $decoded = JWTAuth::getJWTProvider()->decode($refreshToken);

            $user = User::find($decoded['user_id']);
            if(!$user) {
                return response()->json(['error' => "User not found"], 404);
            }
            
            // Delete old accessToken & create new accessToken
            $token = auth()->refresh();
            
            $refreshToken = $this->createRefreshToken();
            return $this->respondWithToken($token, $refreshToken);
        } catch(JWTException $exception) {
            return response()->json(['error' => "Invalid Refresh Token"], 500);
        }
    }

    protected function respondWithToken($token, $refreshToken)
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    private function createRefreshToken () {
        $data = [
            'user_id' => auth()->user()->id,
            'random' => rand().time(),
            'exp' => time() + config('jwt.refresh_ttl')
        ];
        $refreshToken = JWTAuth::getJWTProvider()->encode($data);

        return $refreshToken;
    }
}
<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh', 'register']]);
    }
    public function register()
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => request()->email,
                'fullname' => request()->fullname,
                'password' => request()->password,
                'phone_number' => request()->phone_number,
                'address' => request()->address,
                'role_id' => 3,
            ]);

            if(request()->hasFile('avatar')){
                $avatar = request()->file('avatar');
                $user->avatar = $avatar->store('avatars', "public");
                $user->save();
            }
            DB::commit();
            
            return new UserResource($user);
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }
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
            // Add old access token to blacklist
            $oldToken = request()->bearerToken();
            if($oldToken) {
                $tokenExp = Carbon::createFromTimestamp(JWTAuth::getJWTProvider()->decode($oldToken)["exp"]);
                if(!$tokenExp->isPast()) {
                    auth()->invalidate();
                }
            }
            
            $token = auth()->login($user);
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
            'expires_in' => auth()->factory()->getTTL()
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
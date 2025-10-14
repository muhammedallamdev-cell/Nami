<?php

namespace App\Services;
use Illuminate\Support\Facades\Hash;
use App\Interface\Admin\Auth\AuthAdminInterface;
use App\Models\Admin\Admin;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function __construct(protected AuthAdminInterface $repo) {}

    public function login(array $data)
    {
        $admin = $this->repo->findByEmail($data['email']);

        if (! $admin || ! Hash::check($data['password'], $admin->password)) {
            return response()->json([
                'code' => 401,
                'status' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }
        $admin->tokens()->delete();

        $apiToken = $admin->createToken('admin-token')->plainTextToken;


        return [
            'admin' => $admin, 
            'token' => $apiToken, 
        ];
    }
    public function setToken(array $data)
    {
        $token = $data['token'] ?? null;

        if (! $token) {
            return response()->json(['status' => false, 'message' => 'Token is required'], 400);
        }

        $pat = PersonalAccessToken::findToken($token);

        if (! $pat) {
            return response()->json(['status' => false, 'message' => 'Invalid token'], 401);
        }

        $admin = $pat->tokenable;
        if (! $admin instanceof Admin) {
            return response()->json(['status' => false, 'message' => 'Invalid token owner'], 401);
        }

        $minutes = 60 ;
        $cookie = cookie('admin_token', $token, $minutes, '/', null, false, true, false, 'Lax');

        return response()->json(['status' => true, 'message' => 'Token set'])->withCookie($cookie);
    }

    public function logout()
    {
        $admin = Auth::guard('admin')->user();
        if ($admin) {
            $admin->tokens()->delete();
        }

        $cookie = cookie()->forget('admin_token');
        return $cookie;
    }
}

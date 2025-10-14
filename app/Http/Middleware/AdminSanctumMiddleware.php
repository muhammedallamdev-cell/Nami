<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AdminSanctumMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
  public function handle(Request $request, Closure $next)
    {
        // 1) read from Bearer header
        $bearer = $request->bearerToken();

        // 2) or read from cookie
        $cookieToken = $request->cookie('admin_token');

        $token = $bearer ?: $cookieToken;

        if (! $token) {
            // لو كان AJAX أو طلب JSON ارجع 401، وإلا عدل إعادة التوجيه لصفحة تسجيل الدخول
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return redirect()->route('admin.auth.login.form');
        }

        $pat = PersonalAccessToken::findToken($token);

        if (! $pat) {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Invalid token'], 401);
            }
            return redirect()->route('admin.auth.login.form');
        }

        // set tokenable as current user
        $user = $pat->tokenable;
        auth()->setUser($user);

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Helper\ResponseHelper;
use App\Services\AuthService;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{

    public function __construct(protected AuthService $service)
    {
    }

    public function login(LoginRequest $request)
    {
        try {
            $data[] = $this->service->login($request->validated());
            return ResponseHelper::jsonResponseSuccess($data, 'Login successful', 200);
        } catch (\Exception $e) {
            return ResponseHelper::sendResponseError($e->getMessage(), 500, 'Login failed');
        }
    }

    public function setToken(Request $request)
    {
        try {
            return $this->service->setToken($request->all());
        } catch (\Exception $e) {
            return ResponseHelper::sendResponseError($e->getMessage(), 500, 'Setting token failed');
        }
    }

    public function logout()
    {
        try {
            $cookie = $this->service->logout();
            return redirect()->route('admin.auth.login.form')->withCookie($cookie);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Logout failed: ' . $e->getMessage()]);
        }
    }
}

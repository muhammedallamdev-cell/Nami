<?php
namespace App\Repository\Admin\Auth;
use App\Models\Admin\Admin;
use App\Interface\Admin\Auth\AuthAdminInterface;


class AuthAdminRepository implements AuthAdminInterface
{

    public function findByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }
}
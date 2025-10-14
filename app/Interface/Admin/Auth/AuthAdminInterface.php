<?php 

namespace App\Interface\Admin\Auth;

use App\Models\Admin\Admin;

interface AuthAdminInterface
{
    public function findByEmail(string $email): ?Admin;
}

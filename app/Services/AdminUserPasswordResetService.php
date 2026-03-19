<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Password;

class AdminUserPasswordResetService
{
    public function send(User $user): string
    {
        return Password::broker('users')->sendResetLink([
            'email' => $user->email,
        ]);
    }
}

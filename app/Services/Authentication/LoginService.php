<?php

namespace App\Services\Authentication;

use App\Models\Users\User;
use Illuminate\Support\Facades\Hash;

class LoginService
{
    public function checkLoggingUser (
        string $email,
        string $password): array|string
    {
        $user = User::query()->where('email',$email)->first();
        if(!$user || !Hash::check($password,$user['password'])){
            abort(401, 'wrong password');
        }
        $data ['token'] = $user->createToken($user->name.'-AuthToken')->plainTextToken;
        $data ['user'] = $user;
        return $data;
    }
}

<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\Users\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    protected function requestToken(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        $user = User::query()->where('email', $request['email'])->first();
        if( !$user || !Hash::check($request['password'], $user->password)){
            return \response()->json('invalid password');
        }
        return response()->json($user);
    }

    protected function requestTokenGoogle(Request $request): JsonResponse
    {
        $user = Socialite::driver('google')->stateless()->userFromToken($request['token']);
        $userFromDb = User::query()->firstOrCreate(
            ['email' => $user->email],
            [
                'email_verified_at' => now(),
                'name' => $user->name,
                'status' => true,
            ]
        );
        return response()->json($user->getUserAndToken($userFromDb, $request['device_name']));
    }

    private function getUserAndToken(User $user, $device_name){
        return [
            'User' => $user,
            'Access-Token' => $user->createToken($device_name)->plainTextToken,
        ];
    }
}

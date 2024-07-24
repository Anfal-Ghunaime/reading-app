<?php

namespace App\Services\Authentication;

use App\Mail\ResetPasswordMail;
use App\Models\Users\ResetVerifyCode;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordService
{
    public function resetPassword(
        string $old_password,
        string $new_password): string
    {
        $user = User::query()->where('id', auth()->user()->id)->first();
        if(!$user || !Hash::check($old_password,$user['password'])){
            abort(401, 'wrong password');
        }
        $user->update([
            'password' => $new_password
        ]);
        return 'password updated successfully';
    }

    public function sendForgotPasswordMail(
        string $email): string
    {
        $service = new CreateSendCode();
        $code = ResetVerifyCode::query()->where('email', $email)
            ->where('type', 'reset')
            ->first();
        if(!$code){
            $service->createAndSendCode($email, 'reset');
            return 'we have sent you a reset code, check your email!';
        }
        $code->delete();
        $service->createAndSendCode($email, 'reset');
        return 'we have resent you a reset code, check your email!';
    }

    public function checkCode(
        int $code,
        string $email): string
    {
        $reset = ResetVerifyCode::query()->where('email', $email)
            ->where('type', 'reset')->first();
        if(!$reset || !Hash::check($code,$reset['code'])){
            abort(401, 'wrong code!');
        } else if (Carbon::now()->isAfter($reset->expires_at)){
            $reset->delete();
            abort(410, 'this code is not validate anymore');
        }
        $reset->delete();
        return 'you can now reset your password';
    }

    public function newPassword(
        string $new_password,
        string $email): string
    {
        $user = User::query()->where('email', $email)->first();
        $user->update([
            'password' => $new_password
        ]);
        return 'password updated successfully';
    }
}

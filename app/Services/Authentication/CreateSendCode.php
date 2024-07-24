<?php

namespace App\Services\Authentication;

use App\Mail\ResetPasswordMail;
use App\Mail\VerifyEmail;
use App\Models\Users\ResetVerifyCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class CreateSendCode
{
    public function createAndSendCode($email, $type): string
    {
        $code = mt_rand(10000, 99999);
        if($type == 'verify'){
            Mail::to($email)->send(new VerifyEmail($code));
        } elseif ($type == 'reset'){
            Mail::to($email)->send(new ResetPasswordMail($code));
        }
        ResetVerifyCode::query()->create([
            'email' => $email,
            'code' => $code,
            'type' => $type,
            'expires_at' => Carbon::now()->addHour(),
        ]);
        return 'ok';
    }
}

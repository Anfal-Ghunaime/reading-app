<?php

namespace App\Services\Authentication;

use App\Models\Thoughts\Quotebook;
use App\Models\Users\Profile;
use App\Models\Users\ResetVerifyCode;
use App\Models\Users\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterService
{
    public function sendCode(
        string $email): string
    {
        $service = new CreateSendCode();
        $code = ResetVerifyCode::query()->where('email', $email)
            ->where('type', 'verify')
            ->first();
        if(!$code){
            $service->createAndSendCode($email, 'verify');
            return 'we have sent you a verification code, check your email!';
        }
        $code->delete();
        $service->createAndSendCode($email, 'verify');
        return 'we have resent you a verification code, check your email!';
    }

    public function checkCode(
        int $code,
        string $email): string
    {
        $verify = ResetVerifyCode::query()->where('email', $email)
            ->where('type', 'verify')->first();
        if(!$verify || !Hash::check($code,$verify['code'])){
            abort(401, 'wrong code!');
        } else if (Carbon::now()->isAfter($verify->expires_at)){
            $verify->delete();
            abort(410, 'this code is not validate anymore');
        }
        $verify->update(['verified' => true]);
        return 'you can now register to the app';
    }

    public function storeNewUser(
        string $name,
        string $email,
        string $password,
        string $role = 'user'): string
    {
//        $verify = ResetVerifyCode::query()->where('email', $email)
//            ->where('type', 'verify')->first();
//        if ($verify && $verify->verified){
//            $verify->delete();
            $user = $this->storeUser($name,$email,$password,$role);
            Quotebook::query()->create([
                'user_id' => $user->id,
                'name' => 'general',
                'image_name' => 'general_image.png',
                'year' => Carbon::now()->year,
            ]);
            return 'you have registered successfully';
//        }
//        abort(403, 'this email is not verified!');
    }

    public function storeUser(
        string $name,
        string $email,
        string $password,
        string $role): Model|Builder
    {
        $user = User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'role' => $role,
            'email_verified_at' => now(),
        ]);
        Profile::query()->create([
            'user_id' => $user->id
        ]);
        return $user;
    }
}

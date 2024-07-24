<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\CredentialsValidation\CodeRequest;
use App\Http\Requests\CredentialsValidation\NewPasswordRequest;
use App\Http\Requests\CredentialsValidation\PasswordRequest;
use App\Http\Requests\CredentialsValidation\ResetEmailRequest;
use App\Services\Authentication\PasswordService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    //reset the password by entering the old and new one
    public function resetPassword(PasswordRequest $passwordRequest,
                                  NewPasswordRequest $newPasswordRequest,
                                  PasswordService $service): JsonResponse
    {
        return response()->json($service->resetPassword($passwordRequest->password,
            $newPasswordRequest->new_password));
    }


    //forgot password! :

    //send forgot password code
    public function sendForgotPasswordCode(ResetEmailRequest $request, PasswordService $service): JsonResponse
    {
        return response()->json($service->sendForgotPasswordMail($request->email));
    }

    //check if the code is valid
    public function checkForgotPasswordCode(ResetEmailRequest $emailRequest,
                                            CodeRequest $codeRequest,
                                            PasswordService $service): JsonResponse
    {
        return response()->json($service->checkCode($codeRequest->code, $emailRequest->email));
    }

    //now the user can enter new password
    public function newPassword(ResetEmailRequest $emailRequest,
                                NewPasswordRequest $passwordRequest,
                                PasswordService $service): JsonResponse
    {
        return response()->json($service->newPassword($passwordRequest->new_password, $emailRequest->email));
    }
}

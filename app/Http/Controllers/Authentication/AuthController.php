<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\CredentialsValidation\CodeRequest;
use App\Http\Requests\CredentialsValidation\LoginRequest;
use App\Http\Requests\CredentialsValidation\RegisterRequest;
use App\Http\Requests\CredentialsValidation\VerifyEmailRequest;
use App\Services\Authentication\LoginService;
use App\Services\Authentication\RegisterService;
use http\Env\Response;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    //send verification code when the user enters his email
    public function sendVerifyCode(VerifyEmailRequest $request, RegisterService $service): JsonResponse
    {
        return response()->json($service->sendCode($request->email));
    }

    //check the verification code that the user had entered
    public function checkVerifyCode(CodeRequest $codeRequest, VerifyEmailRequest $emailRequest, RegisterService $service): JsonResponse
    {
        return response()->json($service->checkCode($codeRequest->code, $emailRequest->email));
    }

    //register the user after the verification
    public function register(RegisterRequest $request, VerifyEmailRequest $emailRequest, RegisterService $service): JsonResponse
    {
        return response()->json($service->storeNewUser($request->name,$emailRequest->email,$request->password));
    }

    //login
    public function login (LoginRequest $request, LoginService $service): JsonResponse
    {
        $response = $service->checkLoggingUser($request->email,$request->password);
        if($response == 'wrong password'){
            return response()->json($response, 401);
        }
        return response()->json($response);
    }

    //logout
    public function logout (): JsonResponse
    {
        auth()->user()->tokens()->delete();
        return response()->json('logged out successfully');
    }
}

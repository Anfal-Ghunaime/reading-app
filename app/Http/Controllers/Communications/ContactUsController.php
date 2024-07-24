<?php

namespace App\Http\Controllers\Communications;

use App\Actions\ContactUs\ContactUsAction;
use App\Actions\ContactUs\ReplyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommunicationsValidation\MessageRequest;
use Illuminate\Http\JsonResponse;

class ContactUsController extends Controller
{
    public function contact_us(MessageRequest $request, ContactUsAction $action): JsonResponse
    {
        return response()->json($action->contactUs($request->message));
    }

    public function reply($contact_id, MessageRequest $request, ReplyAction $action): JsonResponse
    {
        return response()->json($action->reply($contact_id, $request->message));
    }
}

<?php

namespace App\Http\Controllers\Communications;

use App\Actions\Reviews\AddFeedbackAction;
use App\Actions\Reviews\CheckIfHasLikeAction;
use App\Actions\Reviews\EditDeleteFeedbackAction;
use App\Actions\Reviews\LikesAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\CommunicationsValidation\FeedbackRequest;
use App\Models\UserCafe\Favourite;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function feedback($book_id, FeedbackRequest $request, AddFeedbackAction $action): JsonResponse
    {
        return response()->json($action->addFeedback($book_id, $request->feedback));
    }

    public function editOrDeleteFeedback($feedback_id, $what_to_do, FeedbackRequest $request,
                                 EditDeleteFeedbackAction $action): JsonResponse
    {
        return response()->json($action->editOrDeleteFeedback($feedback_id,$what_to_do,$request->feedback));
    }

    public function like($what_to_do, $feedback_id, LikesAction $action): JsonResponse
    {
        return response()->json($action->like($feedback_id,$what_to_do));
    }

    public function checkIfHasLike($feedback_id, CheckIfHasLikeAction $action): JsonResponse
    {
        return response()->json($action->checkIfHasLike($feedback_id));
    }
}

<?php

namespace App\Http\Controllers\Users;

use App\Actions\Users\AddToReadHistoryAction;
use App\Actions\Users\MyReadHistoryListAction;
use App\Actions\Users\MyReadListAction;
use App\Actions\Users\ProgressAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCafeValidation\ProgressRequest;
use App\Http\Requests\UserCafeValidation\ReadHistoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function progress($book_id, ProgressRequest $request, ProgressAction $action): JsonResponse
    {
        return response()->json($action->progress($book_id,
            $request->current_page, $request->start_time, $request->end_time));
    }

    public function myRL(MyReadListAction $action): JsonResponse
    {
        return response()->json($action->myRL());
    }

    public function addToHistory($book_id, ReadHistoryRequest $request,
                                 AddToReadHistoryAction $action): JsonResponse
    {
        return response()->json($action->addToReadHistory($book_id,
            $request->total_read_time, $request->read_date));
    }

    public function myRH(MyReadHistoryListAction $action): JsonResponse
    {
        return response()->json($action->MyRH());
    }
}

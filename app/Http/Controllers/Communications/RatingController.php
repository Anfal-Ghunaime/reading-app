<?php

namespace App\Http\Controllers\Communications;

use App\Actions\Reviews\RateAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function rate($book_id, $stars, RateAction $action): JsonResponse
    {
        return response()->json($action->rate($book_id,$stars));
    }
}

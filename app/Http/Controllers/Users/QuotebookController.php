<?php

namespace App\Http\Controllers\Users;

use App\Actions\Quotebooks\addQuoteToQuotebookAction;
use App\Actions\Quotebooks\deleteQuotebookAction;
use App\Actions\Quotebooks\getQuotebookQuotesAction;
use App\Actions\Quotebooks\newQuotebookAction;
use App\Actions\Quotebooks\removeFromQuotebookAction;
use App\Actions\Quotebooks\updateQuotebookAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuotesValidation\DeleteArrayRequest;
use App\Http\Requests\QuotesValidation\QuotebookDataRequest;
use App\Models\Thoughts\Quotebook;
use Illuminate\Http\JsonResponse;

class QuotebookController extends Controller
{
    public function newQuotebook(QuotebookDataRequest $request, newQuotebookAction $action): JsonResponse
    {
        return response()->json($action->newQuotebook($request->name,$request->bio,$request->image_name));
    }

    public function addToQuotebook($quote_id, $quotebook_id,
                                   addQuoteToQuotebookAction $action): JsonResponse
    {
        return response()->json($action->addQuote($quote_id, $quotebook_id));
    }

    public function deleteQuotebook($what_to_do , $quotebook_id,
                                    deleteQuotebookAction $action): JsonResponse
    {
        return response()->json($action->deleteQuotebook($quotebook_id, $what_to_do));
    }

    public function quotebookQuotes($quotebook_id, getQuotebookQuotesAction $action){
        return response()->json($action->quotebookQuotes($quotebook_id));
    }

    public function myQuotebooks(){
        return Quotebook::query()->where('user_id', auth()->user()->id)->get();
    }

    public function removeFromQb($quotebook_id ,
                                 DeleteArrayRequest $request ,
                                 removeFromQuotebookAction $action)
    {
        return response()->json($action->removeFromQb($quotebook_id , $request->ids));
    }

    public function updateQb($quotebook_id,
                             QuotebookDataRequest $request ,
                             updateQuotebookAction $action)
    {
        return response()->json($action->updateQb($request->name, $request->bio,
            $request->image_name,$quotebook_id));
    }
}

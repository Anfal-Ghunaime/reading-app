<?php

namespace App\Http\Controllers\Users;

use App\Actions\Books\DeleteBookAction;
use App\Actions\Quotes\AddOrRemoveQuoteFromFavAction;
use App\Actions\Quotes\AddQuoteAction;
use App\Actions\Quotes\DeleteQuoteAction;
use App\Actions\Quotes\MyQuotesAction;
use App\Actions\Quotes\UpdateQuoteAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuotesValidation\QuoteDataRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuotesController extends Controller
{
    public function addQuote(QuoteDataRequest $request,AddQuoteAction $action): JsonResponse
    {
        return response()->json($action->addQuote($request->quote, $request->source_id,
            $request->book_name, $request->author,
            $request->page_num, $request->my_thoughts, $request->image));
    }

    public function favOrNot($quote_id, AddOrRemoveQuoteFromFavAction $action): JsonResponse
    {
        return response()->json($action->favOrNot($quote_id));
    }

    public function deleteQuote($quote_id, DeleteQuoteAction $action): JsonResponse
    {
        return response()->json($action->deleteQuote($quote_id));
    }

    public function myQuotesList(MyQuotesAction $action): JsonResponse
    {
        return response()->json($action->myQL());
    }

    public function updateQuote($quote_id,QuoteDataRequest $request ,UpdateQuoteAction $action): JsonResponse
    {
        return response()->json($action->updateQuote($quote_id,$request->quote,
            $request->source_id, $request->book_name, $request->author,
            $request->page_num, $request->my_thoughts, $request->image));
    }
}

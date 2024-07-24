<?php

namespace App\Http\Controllers\Users;

use App\Actions\Users\AddOrRemoveFromReadLaterAction;
use App\Actions\Users\MyReadLaterListAction;
use App\Http\Controllers\Cafes\BookController;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ReadLaterResource;
use App\Models\Cafes\Book;
use App\Models\UserCafe\ReadLater;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReadLaterController extends Controller
{
    public function readLater($book_id, $priority, AddOrRemoveFromReadLaterAction $action): JsonResponse
    {
        return response()->json($action->readLater($book_id, $priority));
    }

    public function myReadLater($order, MyReadLaterListAction $action): JsonResponse
    {
        return response()->json($action->myRLL($order));
    }
}

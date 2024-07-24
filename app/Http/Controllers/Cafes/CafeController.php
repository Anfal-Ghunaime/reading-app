<?php

namespace App\Http\Controllers\Cafes;

use App\Http\Controllers\Controller;
use App\Models\Cafes\Cafe;
use App\Models\Cafes\Shelf;
use Illuminate\Http\JsonResponse;

class CafeController extends Controller
{
    //cafe list
    public function listAllCafes(): JsonResponse
    {
        $cafes = Cafe::all();
        foreach ($cafes as $cafe){
            $cafe['image'] = asset($cafe['image']);
        }
        return response()->json($cafes);
    }

    //cafe shelves
    public function cafeShelves($cafe_id): JsonResponse
    {
        return response()->json(Shelf::query()->where('cafe_id', $cafe_id)->get());
    }

    //all shelves list
    public function listAllShelves(): JsonResponse
    {
        $shelves = Shelf::all();
        foreach ($shelves as $shelf){
            $shelf['image'] = asset($shelf['image']);
        }
        return response()->json($shelves);
    }
}

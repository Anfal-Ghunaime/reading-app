<?php

namespace App\Http\Controllers\Users;

use App\Actions\Profiles\CreateProfileAction;
use App\Actions\Profiles\UpdateProfileAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\BooksValidation\GenreRequest;
use App\Http\Requests\ProfileValidation\ProfileDataRequest;
use App\Http\Resources\Users\UserProfileResource;
use App\Models\Users\Profile;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    public function updateProfile(ProfileDataRequest $dataRequest,
                                  GenreRequest $genreRequest,
                                  UpdateProfileAction $action): JsonResponse
    {
        return response()->json($action->updateProfile($dataRequest->name,
            $genreRequest->genre,$dataRequest->profile_photo,$dataRequest->bio));
    }

    //get user profile info by token
    public function getProfile(): array
    {
        $profile = Profile::with('users', 'shelves')
            ->where('user_id', auth()->user()->id)->first();
        return (new UserProfileResource($profile))->resolve();
    }
}

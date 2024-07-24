<?php

namespace App\Actions\Profiles;

use App\Http\Resources\Users\UserProfileResource;
use App\Models\Cafes\Shelf;
use App\Models\Users\Profile;
use App\Models\Users\User;
use App\Services\FilesHandling\FileSaveService;
use Illuminate\Support\Facades\DB;

class UpdateProfileAction
{
    public function updateProfile(
        $name,
        $genres,
        $profile_photo,
        $bio): array
    {
        $profile = Profile::query()->where('user_id', auth()->user()->id)->first();
        if(!$profile){
            abort(404, 'profile not exist');
        }
        if($profile_photo != null){
            $save_service = new FileSaveService();
            $profile_photo = $save_service->fileSave($profile_photo,'profiles');
            $profile->update([
                'profile_photo' => $profile_photo
            ]);
        }
        if ($name != null){
            $user = User::query()->where('id', $profile['user_id'])->first();
            $user->update([
                'name' => $name,
            ]);
        }
        if ($genres != null){
            DB::table('with_shelves')->where('relatable_id', $profile->id)
                ->where('relatable_type', get_class($profile))->delete();
            foreach ($genres as $genre){
                $shelf = Shelf::query()->where('genre', $genre)->first();
                if ($shelf){
                    $profile->shelves()->attach($shelf['id']);
                }
            }
        }
        if ($bio != null){
            $profile->update([
                'bio' => $bio
            ]);
        }
        return (new UserProfileResource($profile))->resolve();
    }
}

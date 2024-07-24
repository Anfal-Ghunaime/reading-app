<?php

namespace App\Actions\AdminsManagement;

use App\Models\Users\User;

class DeleteAdminAction
{
    public function removeAdmin($admin_id): string
    {
        $user = User::query()->where('id', $admin_id)->first();
        if($user && $user->role == 'admin'){
            $user->delete();
            return 'admin deleted successfully';
        }
        return 'admin not found';
    }
}

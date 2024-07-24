<?php

namespace App\Actions\AdminsManagement;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Collection;

class GetAdminsListAction
{
    public function getAdmins(): Collection|array
    {
        return User::query()->where('role', 'admin')->get();
    }
}

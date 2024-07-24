<?php

namespace Database\Seeders;

use App\Models\Users\Profile;
use App\Models\Users\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->create([
            'name' => 'Master Admin',
            'email' => 'masteradmin@gmail.com',
            'password' => 'masteradminpassword',
            'role' => 'master_admin'
        ]);
        Profile::query()->create([
            'user_id' => 1,
            'profile_photo' => 'profiles/AdminProfilePic.png',
            'bio' => 'master_admin',
        ]);
    }
}

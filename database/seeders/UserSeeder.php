<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('slug','admin')->first();
        // Create admin
        User::updateOrCreate([
            'role_id' => $adminRole->id,
            'name' => 'Chef',
            'slug' => 'chef',
            'phone' => '01736666999',
            'otp'=>'01234',
            'email' => 'admin@mail.com',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => Hash::make('password'),
            // 'image' => '/images/avatar.png',
            'status' => true
        ]);

        // Create user
        $userRole = Role::where('slug','user')->first();
        User::updateOrCreate([
            'role_id' => $userRole->id,
            'name' => 'User',
            'slug' => 'user',
            'phone' => '01619474545',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'otp'=>'12345',
            'email' => 'user@mail.com',
            'password' => Hash::make('password'),
            'status' => true
        ]);

    }
}

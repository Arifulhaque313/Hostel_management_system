<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

use Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
    }
}

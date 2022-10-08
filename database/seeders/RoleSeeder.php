<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_permissions = Permission::get();
        Role::updateOrCreate(['name' => 'Admin', 'slug' => 'admin', 'deletable' => false])
            ->permissions()
            ->sync($admin_permissions->pluck('id'));

        Role::updateOrCreate(['name' => 'User', 'slug' => 'user', 'deletable' => true]);
        Role::updateOrCreate(['name' => 'Merchant', 'slug' => 'merchant', 'deletable' => true]);
    }
}

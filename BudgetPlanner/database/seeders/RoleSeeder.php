<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create(['name' => 'admin', 'label' => 'Administrator', 'description' => 'System administrator']);
        Role::create(['name' => 'user', 'label' => 'User', 'description' => 'Regular user']);
    }
}

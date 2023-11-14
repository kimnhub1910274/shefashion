<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::truncate();

        Roles::create(['role_name' => 'admin']);
        Roles::create(['role_name' => 'admin2']);
        Roles::create(['role_name' => 'admin3']);

    }
}

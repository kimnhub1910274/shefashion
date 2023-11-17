<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Roles;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        $adminRoles = Roles::where('role_name', 'admin')->first();
        $editorRoles = Roles::where('role_name', 'editor')->first();
        $censorRoles = Roles::where('role_name', 'censor')->first();

        $admin = Admin::create([
            'admin_name' => 'Admin',
            'admin_email' => 'Admin@gmail.com',
            'admin_phone' => '078654234',
            'admin_password' => md5('123456')
        ]);

        $editor = Admin::create([
            'admin_name' => 'Admin2',
            'admin_email' => 'Admin2@gmail.com',
            'admin_phone' => '0764574352',
            'admin_password' => md5('123456')
        ]);

        $censor = Admin::create([
            'admin_name' => 'Admin3',
            'admin_email' => 'Admin3@gmail.com',
            'admin_phone' => '097362536',
            'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $editor->roles()->attach($editorRoles);
        $censor->roles()->attach($censorRoles);


    }
}

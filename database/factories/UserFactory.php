<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Admin;
use App\Models\Roles;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker){
    return [
        'admin_name' => faker()->name(),
        'admin_email' => faker()->unique()->safeEmail(),
        'admin_phone' => '078654234',
        'admin_password' => 'e10adc3949ba59abbe56e057f20f883e', // password
    ];
});
$factory->afterCreating(Admin::class, function($admin, $faker){
    $roles = Roles::where('role_name', 'user')->get();
    $admin->roles()->sync($roles->pluck('role_id')->toArray());
});

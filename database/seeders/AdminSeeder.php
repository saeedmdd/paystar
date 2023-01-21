<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            "name" => "saeed",
            "email" => "saeed.madadi7@gmail.com",
            "phone_number" => "09126827403",
            "password" => 123456
        ]);
        $role = Role::findByName("Super-Admin");
        $user->assignRole($role);
    }
}

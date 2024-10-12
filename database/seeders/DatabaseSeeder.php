<?php

namespace Database\Seeders;

use App\RoleEnum;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        $users = User::factory(10)->create();
        foreach ($users as $user) {
            $user->assignRole(RoleEnum::USER);
        }


        User::factory()->create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => 'secret'
        ])->syncRoles([RoleEnum::ADMIN]);
    }
}

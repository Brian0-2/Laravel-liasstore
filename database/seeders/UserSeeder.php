<?php

namespace Database\Seeders;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class UserSeeder extends Seeder
{
    public function run(): void
    {

        $users = User::factory()->count(10)->create();

        //Assing roles
        foreach ($users as $user) {
            $user->assignRole('customer');
        }
    }
}

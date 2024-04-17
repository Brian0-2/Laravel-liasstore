<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProviderSeeder;
use Database\Seeders\SubcategoriesSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            RoleSeeder::class,
            ProviderSeeder::class,
            CategorySeeder::class,
            SubcategoriesSeeder::class,
            SizeSeeder::class,
            // ClothesSeeder::class,
        ]);
    }
}

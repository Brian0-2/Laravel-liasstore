<?php

namespace Database\Seeders;

use App\Models\Clothes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClothesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clothes::factory() -> count(500) -> create();
    }
}

<?php

namespace Database\Seeders;

use App\Models\Clothe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClotheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Clothe::factory() -> count(10) -> create();
    }
}

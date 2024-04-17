<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create([
            'name' => 'CH',
            'description' => 'chica'
        ]);

        Size::create([
            'name' => 'M',
            'description' => 'mediana'
        ]);

        Size::create([
            'name' => 'G',
            'description' => 'grande'
        ]);

        Size::create([
            'name' => 'XL',
            'description' => 'extra grande'
        ]);

        Size::create([
            'name' => 'XXL',
            'description' => 'extra'
        ]);

        Size::create([
            'name' => 'XXXL',
            'description' => 'plus'
        ]);
    }
}

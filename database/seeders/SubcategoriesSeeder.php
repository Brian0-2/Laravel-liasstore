<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubcategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //!Men
        SubCategory::create([
            'name' => 'playeras',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'camisas',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'sudaderas y sueteres',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'chamarras',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'jeans',
            'category_id' => 1,
        ]);

        //!Women
        SubCategory::create([
            'name' => 'Tops y Bodies',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'playeras',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'Vestidos',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'Lenceria',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'jeans',
            'category_id' => 2,
        ]);

        //!Kids
        SubCategory::create([
            'name' => 'Shorts',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'camisas',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'sudaderas y sueteres',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'chamarras',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'jeans',
            'category_id' => 3,
        ]);

        //!News
        SubCategory::create([
            'name' => 'especial',
            'category_id' => 4,
        ]);
    }
}

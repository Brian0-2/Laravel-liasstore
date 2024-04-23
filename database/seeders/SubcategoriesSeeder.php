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
            'file_url' => 'playeraHombre',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'camisas',
            'file_url' => 'camisaHombre',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'sudaderas y sueteres',
            'file_url' => 'sudaderaSueterHombre',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'chamarras',
            'file_url' => 'chamarraHombre',
            'category_id' => 1,
        ]);

        SubCategory::create([
            'name' => 'jeans',
            'file_url' => 'jeanHombre',
            'category_id' => 1,
        ]);

        //!Women
        SubCategory::create([
            'name' => 'Tops y Bodies',
            'file_url' => 'TopbodieMujer',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'playeras',
            'file_url' => 'playeraMujer',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'Vestidos',
            'file_url' => 'vestidoMujer',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'Lenceria',
            'file_url' => 'lenceriaMujer',
            'category_id' => 2,
        ]);

        SubCategory::create([
            'name' => 'jeans',
            'file_url' => 'jeanMujer',
            'category_id' => 2,
        ]);

        //!Kids
        SubCategory::create([
            'name' => 'Shorts',
            'file_url' => 'shortNiño',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'camisas',
            'file_url' => 'camisaNiño',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'sudaderas y sueteres',
            'file_url' => 'sudaderaNiño',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'chamarras',
            'file_url' => 'chamarraNiño',
            'category_id' => 3,
        ]);

        SubCategory::create([
            'name' => 'jeans',
            'file_url' => 'jeanNiño',
            'category_id' => 3,
        ]);

        //!News
        SubCategory::create([
            'name' => 'especial',
            'file_url' => 'articuloEspecial',
            'category_id' => 4,
        ]);
    }
}

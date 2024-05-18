<?php

namespace Database\Seeders;

use App\Models\Photo;
use App\Models\Clothe;
use Illuminate\Support\Str;
use App\Models\ClothesSizes;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClotheSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $clothes = Clothe::factory() -> count(10) -> create();

       foreach($clothes as $clothe){
        ClothesSizes::create([
            'clothe_id' => $clothe -> id,
            'size_id' => fake()->numberBetween(1, 5)
        ]);
       }
    }
}

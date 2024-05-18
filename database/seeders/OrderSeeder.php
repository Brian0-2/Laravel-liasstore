<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderClothes;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orders = Order::factory()->count(10)->create();

        foreach($orders as $order){
            OrderClothes::create([
                'order_id' => $order -> id,
                'clothe_id' => fake()->numberBetween(1, 10),
                'size_id' => fake()->numberBetween(1, 5),
                'amount_total'=> fake()->numberBetween(1, 2000)
            ]);
        }

    }
}

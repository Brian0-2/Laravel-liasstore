<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProviderFactory extends Factory
{
    public function definition(): array
    {
        return [
            //
            'name' => fake() -> name(),
            'store_name' => fake() -> name(),
            'nickname' => fake() -> name(),
            'address' => fake() -> streetAddress(),
            'postal_code' => fake() -> randomNumber(5,true),
            'location' => fake() -> locale(),
            'municipality' => fake() -> city() ,
            'state' => fake() -> state() ,
            'phone_number' => fake() -> unique() ->phoneNumber(),
        ];
    }
}

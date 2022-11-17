<?php

namespace Database\Factories;

use App\Models\Category_Minuman;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Minuman>
 */
class MinumanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = $this->faker;
        $class = 'FakerRestaurant\Provider\id_ID\Restaurant';
        $faker->addProvider(new $class($faker));
        return [
            'nama' => $faker->beverageName(),
            'harga' => round( $this->faker->numberBetween(5000,20000),-3),
            'id_category_minuman' => $this->faker->randomElement(Category_Minuman::all()->pluck('id_category_minuman'))
        ];
    }
}

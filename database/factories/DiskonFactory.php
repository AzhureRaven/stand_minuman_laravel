<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diskon>
 */
class DiskonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nama' => Str::title('Diskon '.$this->faker->words(1,true)),
            'potongan' => round($this->faker->numberBetween(10,50),-1)
        ];
    }
}

<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    public function definition(): array
    {
        $address = ['Yangon','Mandalay','Pyay','Bago','PyinOoLwin','Taunggyi','Innlay'];
        return [
            'title' => $this->faker->sentence(6),
            'description' => $this->faker->text(200),
            'price' => rand(2000,9000),
            'address' => $address[array_rand($address)],
            'rating' => rand(0,5)



        ];
    }
}

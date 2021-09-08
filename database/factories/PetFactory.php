<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

class PetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'age' => '4 meses',
            'category' => 'Cachorro',
            'breed' => $this->faker->word(),
            'owner_name' => $this->faker->name(),
            'owner_phone' => $this->faker->phoneNumber(),
        ];
    }
}

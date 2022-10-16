<?php

namespace Database\Factories;

use App\Models\Employees;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employees>
 */
class srFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employees::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'designation' => $this->faker->randomElement(['Back-End Designer','Digital Marketar','Laravel Developer','Front-End Designer']),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->numerify('###########'),
        ];
    }
}

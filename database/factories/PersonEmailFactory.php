<?php

namespace Database\Factories;

use App\Models\PersonEmail;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonEmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonEmail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' =>  $this->faker->unique()->email,
        ];
    }
}

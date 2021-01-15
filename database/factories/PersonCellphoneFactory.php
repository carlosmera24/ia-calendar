<?php

namespace Database\Factories;

use App\Models\PersonCellphone;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonCellphoneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PersonCellphone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cellphone_number'  =>  $this->faker->unique()->e164PhoneNumber
        ];
    }
}

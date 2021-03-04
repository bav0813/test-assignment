<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class BusinessFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Business::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' => $this->faker->unique()->company,
            'price' => $this->faker->numberBetween(10000,10000000),
            'city' => $this->faker->city,
            'created_at'=> $this->faker->dateTime,
            'updated_at'=> Carbon::now(),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\TechnologyStack;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnologyStackFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TechnologyStack::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word."-technology"
        ];
    }
}

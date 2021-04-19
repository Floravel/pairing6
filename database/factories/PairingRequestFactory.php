<?php

namespace Database\Factories;

use App\Models\PairingRequest;
use App\Models\TechnologyStack;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PairingRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PairingRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fakePairingRequest = [
            'user_id' => User::factory()->create()->id,
            'title' => $this->faker->sentence(5, 7),
            'presentation' => $this->faker->sentence(8, 20)
        ];

        return $fakePairingRequest;

    }
}

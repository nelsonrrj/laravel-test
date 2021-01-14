<?php

namespace Database\Factories;

use App\Models\Application;
use App\Models\Phase;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phases = Phase::all();
        return [
            'name' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'phase_id' => $phases->isEmpty() ? Phase::factory()->create() : $phases->random()->id
        ];
    }
}

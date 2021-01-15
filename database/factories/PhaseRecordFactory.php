<?php

namespace Database\Factories;

use App\Models\Phase;
use App\Models\PhaseRecord;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhaseRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PhaseRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $phases = Phase::all();
        return [
            'phase_id' => $phases->isEmpty() ? Phase::factory()->create() : $phases->random()->id,
            'application_count' => rand(0, 100),
            'created_at' => $this->faker->dateTimeThisMonth
        ];
    }
}

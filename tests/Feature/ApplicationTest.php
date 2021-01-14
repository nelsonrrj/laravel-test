<?php

namespace Tests\Feature;

use App\Models\Phase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationsTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_returns_the_application_on_successfully_creating_a_new_application()
    {
        $phase = Phase::factory()->create();

        $data = [
            'name' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'phase_id' => $phase['id']
        ];
        $this->post(route('applications.store'), $data)
            ->assertStatus(201)
            ->assertJsonFragment($data);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_on_creating_a_new_application()
    {
        $phase = Phase::factory()->create();

        $data = [
            'name' => '',
            'company' => $this->faker->company,
            'phase_id' => $phase['id']
        ];

        $this->post(route('applications.store'), $data)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name field is required.']
                ]
            ]);
    }
}

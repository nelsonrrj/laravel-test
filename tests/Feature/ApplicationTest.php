<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\Phase;
use App\Models\User;
use Database\Factories\PhaseFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApplicationsTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
    }

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

    /** @test */
    public function it_returns_updated_application_on_updating()
    {
        $application = Application::factory()->create();
        $newPhase = Phase::factory()->create();
        $data = [
            'name' => $this->faker->jobTitle,
            'company' => $this->faker->company,
            'phase_id' => $newPhase['id']
        ];
        $this->put(route('applications.update', ['id' => $application['id']]), $data)
            ->assertStatus(200)
            ->assertJsonFragment($data);
    }

    /** @test */
    public function it_returns_the_existing_phases()
    {
        Phase::factory()->times(2)->create();
        $this->get(route('phases.index'))
            ->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }

    /** @test */
    public function it_returns_success_on_successfully_delete_phase()
    {
        $phase = Phase::factory()->create();
        $this->delete(route('phases.delete', ['id' => $phase['id']]))
            ->assertStatus(200);
    }
}

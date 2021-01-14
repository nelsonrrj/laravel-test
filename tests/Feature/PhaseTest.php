<?php

namespace Tests\Feature;

use App\Models\Phase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PhaseTest extends TestCase
{
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
    }

    /** @test */
    public function it_returns_the_application_on_successfully_creating_a_new_phase()
    {
        $data = [
            'name' => $this->faker->unique()->colorName
        ];

        $this->post(route('phases.store'), $data)
            ->assertStatus(201)
            ->assertJsonFragment($data);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_on_creating_a_new_phase()
    {
        $this->post(route('phases.store'), [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name field is required.']
                ]
            ]);
    }

    /** @test */
    public function it_returns_updated_phase_on_updating()
    {
        $phase = Phase::factory()->create();
        $data = [
            'name' => $this->faker->unique()->colorName
        ];

        $this->put(route('phases.update', ['id' => $phase['id']]), $data)
            ->assertStatus(200)
            ->assertJsonFragment($data);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_on_updating()
    {
        $phase = Phase::factory()->create();
        $this->put(route('phases.update', ['id' => $phase['id']]), [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name field is required.']
                ]
            ]);
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
            ->dump()
            ->assertStatus(200);
    }
}

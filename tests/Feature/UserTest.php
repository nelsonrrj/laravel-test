<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_returns_the_user_on_successfully_creating_a_new_user()
    {
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' => $this->faker->password(6)
        ];
        $this->post(route('users.store'), $data)
            ->assertStatus(201)
            ->assertJsonFragment([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_on_creating_a_new_user()
    {
        $data = [
            'name' => '',
            'email' => '',
            'password' => ''
        ];
        $this->post(route('users.store'), $data)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.']
                ]
            ]);
    }

    /** @test */
    public function it_returns_updated_user_on_updating()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email
        ];

        $this->put(route('users.update', ['id' => $user['id']]), $data)
            ->assertStatus(200)
            ->assertJsonFragment([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_on_updating()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $data = [
            'email' => 'invalid email',
        ];

        $this->put(route('users.update', ['id' => $user['id']]), $data)
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email must be a valid email address.']
                ]
            ]);
    }
}

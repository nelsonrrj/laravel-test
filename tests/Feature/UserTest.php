<?php

namespace Tests\Feature;

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
    public function it_returns_appropieate_field_validation_errors_on_creating_a_new_user()
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

}

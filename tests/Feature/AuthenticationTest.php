<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{

    /** @test */
    public function it_returns_user_data_and_access_token()
    {
        $user = User::factory()->create();

        $data = [
            'email' => $user->email,
            'password' => 'password'
        ];

        $this->post(route('auth.login'), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                "user" => [
                    "id",
                    "name",
                    "email",
                    "email_verified_at",
                    "created_at",
                    "updated_at"
                ],
                "access_token"
            ]);
    }

    /** @test */
    public function it_returns_appropriate_field_validation_errors_on_invalid_login ()
    {
        $this->post(route('auth.login'), [])
            ->assertStatus(422)
            ->assertJson([
                'errors' => [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.']
                ]
            ]);
    }
}

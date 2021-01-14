<?php

namespace Tests\Feature;

use App\Mail\UserWelcomeEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserTest extends TestCase
{
    use WithFaker;

    /** @test */
    public function it_returns_the_user_on_successfully_creating_a_new_user()
    {
        Mail::fake();
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->email,
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
            'email' => $this->faker->unique()->email
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

    /** @test */
    public function it_should_be_sent_a_welcome_email_when_user_is_created()
    {
        Mail::fake();
        Mail::assertNothingSent();
        $data = [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' => $this->faker->password(6)
        ];
        $this->post(route('users.store'), $data)
            ->assertStatus(201);
        Mail::assertQueued(UserWelcomeEmail::class, function ($mail) use ($data) {
            return $mail->hasTo($data['email']);
        });
    }
}

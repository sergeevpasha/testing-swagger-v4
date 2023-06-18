<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * @return array
     */
    public static function successfulUsers(): array
    {
        return [
            [2, 'name1', 'email1@test.com', 'password123123', 'password123123'],
        ];
    }

    /**
     * @return array
     */
    public static function failingUsers(): array
    {
        return [
            ['', 'notEmail', '123', '123'],
            ['', 'notEmail', '123123123', '321321321'],
        ];
    }

    public function testHomePageRedirects()
    {
        $response = $this->get('/home');
        $response->assertStatus(302);
        $response->assertRedirect('login');
    }

    public function testHomePageLetAuthUserAccess()
    {
        $user     = User::factory()->create();
        $response = $this->actingAs($user)->get('/home');
        $response->assertOk();
    }

    /**
     * @dataProvider successfulUsers
     *
     * @param mixed $id
     * @param mixed $name
     * @param mixed $email
     * @param mixed $password
     * @param mixed $passwordConfirmation
     */
    public function testUserRegisterSuccessfully(mixed $id, mixed $name, mixed $email, mixed $password, mixed $passwordConfirmation): void
    {
        $response = $this->post('/register', [
            'name'                  => $name,
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $passwordConfirmation
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/home');

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'name'  => $name,
        ]);
    }

    /**
     * @dataProvider failingUsers
     *
     * @param mixed $name
     * @param mixed $email
     * @param mixed $password
     * @param mixed $passwordConfirmation
     */
    public function testUserFailToRegister(mixed $name, mixed $email, mixed $password, mixed $passwordConfirmation): void
    {
        $response = $this->post('/register', [
            'name'                  => $name,
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $passwordConfirmation
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }

    public function testUserLoginSuccessfully(): void
    {
        $response = $this->post('/login', [
            'email' => $this->adminUser->email,
            'password' => 'password123'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/home');
    }
}

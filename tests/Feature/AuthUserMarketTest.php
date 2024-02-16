<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserMarketTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * Такие тесты выполняют различные сценарии
     *
     */
    public function test_Auth(): void
    {

        $password = '12345';
        $user = User::factory()->create(['password' => bcrypt($password)]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);
        $this->assertAuthenticated();
        $response->assertStatus(302);

        $response = $this->get('/testing_course/shop');
        $response->assertStatus(200);

        $response = $this->post('logout');
        $response->assertStatus(302);

        $response = $this->get('/testing_course/shop');
        $response->assertStatus(302);

    }
}

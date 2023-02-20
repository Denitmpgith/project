<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $response = $this->post('/signin', [
            'username' => 'user',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
        $response->assertSee('Welcome, user');
    }
}

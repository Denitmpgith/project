<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouterTest extends TestCase
{
    /**
     * @dataProvider routeProvider
     */
    public function testRoutes($url, $view)
    {
        $response = $this->get($url);
        $response->assertStatus(200);
        $response->assertViewIs($view);
    }

    public function routeProvider()
    {
        return [
            ['/', 'welcome'],
            ['/user', 'user.index'],
            ['/dashboard', 'post.index'],
            ['/signup', 'verify.signup.index'],
            ['/signin', 'verify.signin.index'],
        ];
    }


    public function testFallbackRoute()
    {
        $response = $this->get('/invalid-route');
        $response->assertRedirect('/');
    }
}

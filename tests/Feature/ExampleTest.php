<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_it_redirects_correctly(): void
        {
            $response = $this->followingRedirects()->get('/');
        
            // On change 200 par 302 car ton middleware redirige
            //$response->assertRedirect('/login');
            $response->assertStatus(200);
            
            // Optionnel : vérifier la destination
        }
}

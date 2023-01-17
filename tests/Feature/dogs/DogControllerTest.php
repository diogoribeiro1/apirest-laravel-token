<?php

namespace Tests\dogs;

use App\Models\Dog;
use Illuminate\Foundation\Auth\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DogController extends TestCase
{
    use DatabaseMigrations;

    public function test_get_all_dogs()
    {
        Dog::factory(5)->create();
        $response = $this->get('/api/dogs');

        $response->assertStatus(200);
    }

    public function test_save_a_dogs()
    {
        $user = User::factory(1)->create();
        $dog = ['name' => 'rex', 'raca' => 'puddle'];
        $response = $this->post('/api/dogs', $dog);

        $response->assertStatus(201);
    }
}
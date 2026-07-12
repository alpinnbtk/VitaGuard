<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_database_can_be_migrated_and_seeded()
    {
        $this->artisan('db:seed');

        $this->assertDatabaseHas('users', [
            'username' => 'admin',
        ]);
        $this->assertDatabaseHas('doctors', [
            'name' => 'Dr. Ahmad Hidayat',
        ]);
        $this->assertDatabaseHas('doctor_schedules', [
            'doctor_id' => 1,
        ]);
    }
}

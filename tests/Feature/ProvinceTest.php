<?php

namespace Tests\Feature;

use App\Models\Province;
use Tests\TestCase;

class ProvinceTest extends TestCase
{
    public function test_get_provinces(): void
    {
        $response = $this->get('/provinces');

        $response->assertStatus(200);
    }

    public function test_failed_create_province(): void
    {
        $response = $this->post('/provinces');

        $response->assertStatus(422);
    }

    public function test_successful_create_province(): void
    {
        $response = $this->post('/provinces', [
            'name' => 'Jawa Barat',
        ]);

        $response->assertStatus(201);
    }

    public function test_failed_update_province(): void
    {
        Province::factory()->create();

        $response = $this->put('/provinces/1');

        $response->assertStatus(422);
    }

    public function test_successful_update_province(): void
    {
        Province::factory()->create();

        $response = $this->put('/provinces/1', [
            'name' => 'Jawa Tengah',
        ]);

        $response->assertStatus(200);
    }

    public function test_successful_delete_province(): void
    {
        Province::factory()->create();

        $response = $this->delete('/provinces/1');

        $response->assertStatus(200);
    }
}

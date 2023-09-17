<?php

namespace Tests\Feature;

use App\Models\Province;
use App\Models\Regency;
use Tests\TestCase;

class RegencyTest extends TestCase
{
    public function test_get_regencies(): void
    {
        $response = $this->get('/regencies');

        $response->assertStatus(200);
    }

    public function test_failed_create_regency(): void
    {
        $response = $this->post('/regencies');

        $response->assertStatus(422);
    }

    public function test_successful_create_regency(): void
    {
        $provinceId = Province::factory()->create()->id;

        $response = $this->post('/regencies', [
            'name' => 'Kota Bandung',
            'province_id' => $provinceId,
        ]);

        $response->assertStatus(201);
    }

    public function test_failed_update_regency(): void
    {
        Regency::factory()->state([
            'province_id' => Province::factory()->create()->id,
        ])->create();

        $response = $this->put('/regencies/1');

        $response->assertStatus(422);
    }

    public function test_successful_update_regency(): void
    {
        $provinceId = Province::factory()->create()->id;

        Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create();

        $response = $this->put('/regencies/1', [
            'name' => 'Kota Bandung',
            'province_id' => $provinceId,
        ]);

        $response->assertStatus(200);
    }

    public function test_successful_delete_regency(): void
    {
        $provinceId = Province::factory()->create()->id;

        Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create();

        $response = $this->delete('/regencies/1');

        $response->assertStatus(200);
    }
}

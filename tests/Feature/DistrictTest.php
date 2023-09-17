<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use Tests\TestCase;

class DistrictTest extends TestCase
{
    public function test_get_districts(): void
    {
        $response = $this->get('/districts');

        $response->assertStatus(200);
    }

    public function test_failed_create_district(): void
    {
        $response = $this->post('/districts');

        $response->assertStatus(422);
    }

    public function test_successful_create_district(): void
    {
        $provinceId = Province::factory()->create()->id;

        $regencyId = Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create()->id;

        $response = $this->post('/districts', [
            'name' => 'Bandung Wetan',
            'regency_id' => $regencyId,
        ]);

        $response->assertStatus(201);
    }

    public function test_failed_update_district(): void
    {
        $provinceId = Province::factory()->create()->id;

        $regencyId = Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create()->id;

        District::factory()->state([
            'regency_id' => $regencyId,
        ])->create();

        $response = $this->put('/districts/1');

        $response->assertStatus(422);
    }

    public function test_successful_update_district(): void
    {
        $provinceId = Province::factory()->create()->id;

        $regencyId = Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create()->id;

        District::factory()->state([
            'regency_id' => $regencyId,
        ])->create();

        $response = $this->put('/districts/1', [
            'name' => 'Bandung Wetan',
            'regency_id' => $regencyId,
        ]);

        $response->assertStatus(200);
    }

    public function test_successful_delete_district(): void
    {
        $provinceId = Province::factory()->create()->id;

        $regencyId = Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create()->id;

        District::factory()->state([
            'regency_id' => $regencyId,
        ])->create();

        $response = $this->delete('/districts/1');

        $response->assertStatus(200);
    }
}

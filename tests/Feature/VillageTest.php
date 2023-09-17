<?php

namespace Tests\Feature;

use App\Models\District;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Tests\TestCase;

class VillageTest extends TestCase
{
    public function test_get_villages(): void
    {
        $response = $this->get('/villages');

        $response->assertStatus(200);
    }

    public function test_failed_create_village(): void
    {
        $response = $this->post('/villages');

        $response->assertStatus(422);
    }

    public function test_successful_create_village(): void
    {
        $provinceId = Province::factory()->create()->id;

        $regencyId = Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create()->id;

        $districtId = District::factory()->state([
            'regency_id' => $regencyId,
        ])->create()->id;

        $response = $this->post('/villages', [
            'name' => 'Taman Sari',
            'district_id' => $districtId,
        ]);

        $response->assertStatus(201);
    }

    public function test_failed_update_village(): void
    {
        $provinceId = Province::factory()->create()->id;

        $regencyId = Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create()->id;

        $districtId = District::factory()->state([
            'regency_id' => $regencyId,
        ])->create()->id;

        Village::factory()->state([
            'district_id' => $districtId,
        ])->create();

        $response = $this->put('/villages/1');

        $response->assertStatus(422);
    }

    public function test_successful_update_village(): void
    {
        $provinceId = Province::factory()->create()->id;

        $regencyId = Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create()->id;

        $districtId = District::factory()->state([
            'regency_id' => $regencyId,
        ])->create()->id;

        Village::factory()->state([
            'district_id' => $districtId,
        ])->create();

        $response = $this->put('/villages/1', [
            'name' => 'Cemara',
            'district_id' => $districtId,
        ]);

        $response->assertStatus(200);
    }

    public function test_successful_delete_village(): void
    {
        $provinceId = Province::factory()->create()->id;

        $regencyId = Regency::factory()->state([
            'province_id' => $provinceId,
        ])->create()->id;

        $districtId = District::factory()->state([
            'regency_id' => $regencyId,
        ])->create()->id;

        Village::factory()->state([
            'district_id' => $districtId,
        ])->create();

        $response = $this->delete('/villages/1');

        $response->assertStatus(200);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Village;
use Illuminate\Database\Seeder;

class VillageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $villages = read_csv(__DIR__ . '/csv/villages.csv');

        foreach ($villages as $village) {

            Village::create(['district_id' => $village[1], 'name' => $village[2]]);
        }
    }
}

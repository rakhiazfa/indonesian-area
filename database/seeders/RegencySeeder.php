<?php

namespace Database\Seeders;

use App\Models\Regency;
use Illuminate\Database\Seeder;

class RegencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regencies = read_csv(__DIR__ . '/csv/regencies.csv');

        foreach ($regencies as $regency) {

            Regency::create(['id' => $regency[0], 'province_id' => $regency[1], 'name' => $regency[2]]);
        }
    }
}

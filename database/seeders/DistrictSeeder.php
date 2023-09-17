<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $districts = read_csv(__DIR__ . '/csv/districts.csv');

        foreach ($districts as $district) {

            District::create(['id' => $district[0], 'regency_id' => $district[1], 'name' => $district[2]]);
        }
    }
}

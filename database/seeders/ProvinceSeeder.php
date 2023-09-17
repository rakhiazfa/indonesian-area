<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinces = read_csv(__DIR__ . '/csv/provinces.csv');

        foreach ($provinces as $province) {

            Province::create(['id' => $province[0], 'name' => $province[1]]);
        }
    }
}

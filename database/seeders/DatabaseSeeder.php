<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // Specify the path to your JSON file
        $jsonFilePath = base_path("database/data/seed.json");

        // Read and decode the JSON data
        $data = json_decode(file_get_contents($jsonFilePath), true);

        foreach ($data as $key => $value) {
            Package::create($value);
        }
    }
}

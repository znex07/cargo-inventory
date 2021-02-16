<?php

namespace Database\Seeders;

use App\Models\Cargo;
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
        Cargo::create([
            'name'           => 'RICE CARGO',
            'cargo_code'        => 'RICE001',
            'cargo_status'          => 'In transit',
            'cargo_description'          => 'rice cargos',
            'official_address'       => 'Bulacan',
            'contact_person' => '02121255',
        ]);
    }
}

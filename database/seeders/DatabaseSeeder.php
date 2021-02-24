<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Cargo::factory()->count(50)->make();
        $faker = Faker::create();
        foreach (range(1,1000) as $value) {
            DB::table('cargos')->insert([
                'name' => $faker->name,
                'cargo_code'  => $faker->name,
                'cargo_status'  => $faker->name,
                'cargo_description'  => $faker->name,
                'official_address'  => $faker->name,
                'contact_person' => $faker->name
            ]);
        }
        User::create([
            'name' => 'admin',
            'address' => Str::random(20),
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

    }
}

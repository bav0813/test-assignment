<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('businesses')->insert([
            'name' => 'Microsoft Inc',
            'price' => 10000000,
            'city' => 'Kyiv',
        ]);

        DB::table('businesses')->insert([
            'name' => 'Google Inc',
            'price' => 50000,
            'city' => 'Edmonton',
        ]);

        DB::table('businesses')->insert([
            'name' => 'Apple Inc',
            'price' => 800000,
            'city' => 'New York',
        ]);
    }
}

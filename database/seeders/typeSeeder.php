<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as fakerFactory;
use Illuminate\Support\Facades\DB;

class typeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = fakerFactory::create();

        $limit = 5;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('type')->insert([
                        'tenLoai' => $faker->name,                      
            ]);
        }
    }
}

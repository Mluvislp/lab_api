<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as fakerFactory;
use Illuminate\Support\Facades\DB;
class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = fakerFactory::create();

        $limit = 10;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('products')->insert([
                        'tenSanPham' => $faker->name,
                        'gia' => $faker->numberBetween(1000,10000),
                        'anHien' => $faker->numberBetween(0,1),
            ]);
        }
    }
}

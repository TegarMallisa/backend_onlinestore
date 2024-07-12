<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker =\Faker\Factory::create('id_ID');
        for ($i = 0; $i < 10; $i++) {
            Product::create([
                'nama' => $faker->sentence,
                'deskripsi' => $faker->paragraph,
                'harga' => $faker->numberBetween(10000, 100000),
                'stok' => $faker->numberBetween(1, 100)
            ]);
        }
    }
}

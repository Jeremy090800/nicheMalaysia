<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

//Import Seller model
use App\Models\Sellers;

class SellersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Create seller only if it doesn't exist
        Sellers::create([
            'seller_id' => '123',
            'password' => '123',
        ]);

    }
}

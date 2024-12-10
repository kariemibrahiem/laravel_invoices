<?php

namespace Database\Seeders;
use App\Models\Product;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            "product_name"=>"section_name",
            "description"=>"the desc of section",
            "section_id"=>1
        ]);
    }
}

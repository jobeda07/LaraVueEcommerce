<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Product::create([
            'name' => 'product 1',
            'slug' => Str::slug('product 1'),
            'price' => 78.69,
            'quantity' =>78,
            'category_id'=> 1,
            'brand_id'=>1,
            'description'=>'Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make'
        ]);
         Product::create([
            'name' => 'product 2',
            'slug' => Str::slug('product 2'),
            'price' => 78.69,
            'quantity' =>78,
            'category_id'=> 1,
            'brand_id'=>1,
            'description'=>'Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make'
        ]);
         Product::create([
            'name' => 'product 2',
            'slug' => Str::slug('product 2'),
            'price' => 78.69,
            'quantity' =>78,
            'category_id'=> 1,
            'brand_id'=>1,
            'description'=>'Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make'
        ]);
    }
}

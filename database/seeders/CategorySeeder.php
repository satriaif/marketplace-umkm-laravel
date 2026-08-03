<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
    ['category_name'=>'Mouse'],
    ['category_name'=>'Keyboard'],
    ['category_name'=>'Headset'],
    ['category_name'=>'Speaker'],
    ['category_name'=>'Monitor'],
    ['category_name'=>'SSD'],
    ['category_name'=>'Flashdisk'],
    ['category_name'=>'Webcam'],
]);
    }
}
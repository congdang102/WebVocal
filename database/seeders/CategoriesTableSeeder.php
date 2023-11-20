<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
     /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sử dụng factory để tạo 10 bản ghi dữ liệu giả cho bảng "Categories"
        \App\Models\Category::factory(10)->create();

    }
}

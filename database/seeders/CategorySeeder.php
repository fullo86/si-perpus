<?php

namespace Database\Seeders;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $category = [
            ['category_name' => 'Comic'],
            ['category_name' => 'Novel'],
            ['category_name' => 'Fiction'],
            ['category_name' => 'History'],
            ['category_name' => 'Economic'],
        ];

        foreach ($category as $value) {
            Category::insert([
                'category_name' => $value['category_name'],
                'created_at'    => Carbon::now(),
                'updated_at'    => Carbon::now()
            ]);
        }
    }        
}

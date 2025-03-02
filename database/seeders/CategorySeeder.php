<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category  =  Category::create([
            'name'  => 'otomabil',
        ]);
        

        $category->childiren()->create([
            'name'  => 'auid'
        ]);
        $category->childiren()->create([
            'name'  => 'Toyota'
        ]);
    }
}

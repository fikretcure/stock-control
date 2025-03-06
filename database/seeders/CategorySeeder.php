<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Services\Elastic\CategoryElastic;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category  =  Category::create([
            'name'  => 'Binek Arac',
        ]);


        $category->childiren()->create([
            'name'  => 'Auid'
        ]);
        $category->childiren()->create([
            'name'  => 'Toyota'
        ]);

        $category->childiren()->create([
            'name'  => 'Bmw'
        ]);



        $category  =  Category::create([
            'name'  => 'Kitap',
        ]);


        $category->childiren()->create([
            'name'  => 'Roman'
        ]);
        $category->childiren()->create([
            'name'  => 'Kisisel Gelisim'
        ]);

        $category->childiren()->create([
            'name'  => 'Cocuk Hikaye'
        ]);
        $category->childiren()->create([
            'name'  => 'Gerilim'
        ]);

        Category::query()->get()->each(function ($category) {
            new CategoryElastic()->store($category);
        });
    }
}

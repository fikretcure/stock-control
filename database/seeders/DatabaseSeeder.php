<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Services\Elastic\CategoryElastic;
use App\Services\Elastic\ProductElastic;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Redis;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        if(env('APP_ENV') != 'local') {
            Redis::connection()->flushdb();
        }



            try {
                new ProductElastic()->deleteIndex();
                new CategoryElastic()->deleteIndex();
            } catch (\Exception $e) {
            }

            new ProductElastic()->createIndex();
            new CategoryElastic()->createIndex();


        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}

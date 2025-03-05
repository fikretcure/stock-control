<?php

namespace Database\Seeders;

use App\Models\Supplier;
use App\Services\Elastic\SupplierElastic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create([
            'name' => 'Ozdisan'
        ]);

        Supplier::create([
            'name' => 'Direnc Net'
        ]);

        Supplier::query()->get()->each(function ($category) {
            new SupplierElastic()->store($category);
        });
    }
}

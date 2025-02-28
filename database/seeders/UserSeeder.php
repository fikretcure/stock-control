<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Uygulama',
            'surname' => 'Yoneticisi',
            'email' => 'career@fikretcure.dev',
        ]);

        User::factory(100)->create();
    }
}

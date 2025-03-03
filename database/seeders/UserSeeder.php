<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\RedisService;
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

        User::factory(10)->create();

        User::query()->get(['id','name','surname','email','password'])->makeVisible(['password'])->each(function ($user) {
            new RedisService()->set($user->email, collect($user)->except(['email']));
        });
    }
}

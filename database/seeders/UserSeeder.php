<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Shwe Zin',
            'email' => 'shwezin@gmail.com',
            'role' => "admin",
            'password'=>Hash::make('shwezin123'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@gmail.com',
            'role' => "admin",
            'password'=>Hash::make('admin123'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Editor',
            'email' => 'editor@gmail.com',
            'role' => "editor",
            'password'=>Hash::make('editor123'),
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test Author',
            'email' => 'author@gmail.com',
            'role' => "author",
            'password'=>Hash::make('author123'),
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'is_admin'=>'1',
            'password' => Hash::make('admin123'),
        ]);

        \App\Models\User::factory()->create([
            'name'=>'Pegawai',
            'email'=>'pegawai@gmail.com',
            'is_admin'=>'0',
            'password' => Hash::make('pegawai123'),
        ]);

        \App\Models\User::factory(5)->create();
        
    }
}

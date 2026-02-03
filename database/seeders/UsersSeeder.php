<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

            \App\Models\User::create([
                'name'=>'Admin',
                'email'=>'admin@example.com',
                'password'=>bcrypt('hime1234'),
                'is_admin'=>1,
            ]);

            \App\Models\User::create([
                'name'=>'Member',
                'email'=>'member@example.com', 
                'password'=>bcrypt('mem12345'),
                'is_admin'=>0,
            ]);
    }
}
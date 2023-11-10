<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Hash;
use DB;
use Illuminate\Support\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'test1',
                'email' => 'test1@test.com',
                'phone' => '080-xxxx-xxxx',
                'password' => Hash::make('password123'),
                'is_admin' => 1,
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}

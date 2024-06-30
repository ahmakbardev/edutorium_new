<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Test User',
                'email' => 'testuser@example.com',
                'password' => Hash::make('password'), // Ganti dengan password yang diinginkan
                'pic' => 'path/to/profile_pic.jpg', // Ganti dengan path gambar profil yang diinginkan
                'bio' => 'This is a test user bio.',
                'phone' => '1234567890',
                'sekolah' => 'Test School',
                'kelas' => '12',
                'jurusan' => 'Science',
                'email_verified_at' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}

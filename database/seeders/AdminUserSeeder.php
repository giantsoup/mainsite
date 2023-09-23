<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Taylor Oyer'
            , 'email' => 'tayloroyer@mac.com'
            , 'email_verified_at' => now()
            , 'password' => bcrypt('crimson12')
        ]);
    }
}

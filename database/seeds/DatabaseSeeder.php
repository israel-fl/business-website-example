<?php

use Illuminate\Database\Seeder;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UserTableSeeder');

        $this->command->info('User table seeded!');
    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'  => 'Admin',
            'email' => env('ADMIN_USER', 'admin@datarhino.ml'),
            'password' => env('ADMIN_PASS', 'admin'),
            'level' => 2,
            'verified' => 'true'
            ]);
    }
}

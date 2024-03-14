<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        App\Models\User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'test@mail.com',
            'username' => 'admin',
            'email_verified_at' => null,
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
            'role'  => 2, //administrator
        ]);
    }
}

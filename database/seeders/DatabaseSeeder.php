<?php

use App\Models\User;
use Database\Seeders\DepartmentSeeder;
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
        if(User::where('username','administrator'))
        {
            User::updateOrCreate(
                ['name' => 'Admin'],
                ['email' => 'test@mail.com'],
                ['username' => 'administrator'],
                ['role'  => 2], //administrator
                ['password' => \Illuminate\Support\Facades\Hash::make('123456')],
            );
        }

        $this->call([
            DepartmentSeeder::class
        ]);
    }
}

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
        App\Models\User::find(1)->delete();

	    App\Models\User::updateOrCreate([
            'id'    => 1,
		    'name' => 'Admin',
		    'email' => 'test@mail.com',
            'username' => 'administrator',
            'role'  => 2, //administrator
		    'password' => \Illuminate\Support\Facades\Hash::make('123456'),
	    ]);
    }
}

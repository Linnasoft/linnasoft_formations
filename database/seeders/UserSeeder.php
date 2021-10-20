<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB; 

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
	        [
	            'id' => 1,
	            'firstname' => 'Foune',
	            'lastname' => 'Bengaly',
	            'email' => 'bengalyfoune@yahoo.fr',
	            'password' => Hash::make('linnasoft_main_admin'),
	            'email_verified_at' => NULL,
	            'remember_token' => NULL,
	            'created_at' => NULL,
	            'updated_at' => NULL
            ],
            [
	            'id' => 2,
	            'firstname' => 'Tiècoura',
	            'lastname' => 'Bengaly',
	            'email' => 'bengalythico@gmail.com',
	            'password' => Hash::make('linnasoft_admin_2'),
	            'email_verified_at' => NULL,
	            'remember_token' => NULL,
	            'created_at' => NULL,
	            'updated_at' => NULL
	        ]
	    ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin_users = [
        	[
        		'name' => 'Test Admin',
	            'email' => 'admin@test.com',	
	            'mobile' => '9028187696',	
	            'role_id' => 1,	
	            'password' => Hash::make('admin@123'),
        	]    
        ];

        foreach ($admin_users as $user) {
        	User::create($user);
        }
        
    }
}

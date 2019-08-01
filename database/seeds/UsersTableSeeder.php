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
        		'name' => 'Ajit Singh',
	            'email' => 'ajit@vivekanandtraders.com',	
	            'password' => Hash::make('ajit@123'),
        	],
			[
        		'name' => 'R D Singh',
	            'email' => 'rd@vivekanandtraders.com',	
	            'password' => Hash::make('rd@123'),
        	],
        	[
        		'name' => 'Rakesh Singh',
	            'email' => 'rakesh@gmail.com',	
	            'password' => Hash::make('rakesh@123'),
        	]            
        ];

        foreach ($admin_users as $user) {
        	User::create($user);
        }
        
    }
}

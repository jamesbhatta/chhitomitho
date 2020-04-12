<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
    		'name' => 'Admin',
    		'email' => 'jmsbhatta@gmail.com',
    		'password' => bcrypt('adminpass'),
    		'role' => 'admin',
    	]);
    }
}
